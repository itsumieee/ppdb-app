<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function create(Registration $registration)
    {
        if ($registration->user_id !== Auth::id()) {
            abort(403);
        }

        // Hapus SEMUA transaksi lama untuk pendaftaran ini (pending, expired, apapun)
        Payment::where('registration_id', $registration->id)->delete();

        // Buat transaksi baru
        $orderId = 'PPDB-' . $registration->id . '-' . time();
        $grossAmount = 250000;

        $transaction = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => [
                [
                    'id' => 'REG-' . $registration->id,
                    'price' => $grossAmount,
                    'quantity' => 1,
                    'name' => 'Biaya Pendaftaran PPDB - ' . $registration->full_name,
                ]
            ],
            'customer_details' => [
                'first_name' => $registration->full_name,
                'email' => Auth::user()->email,
                'phone' => $registration->phone,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($transaction);
            $payment = Payment::create([
                'user_id' => Auth::id(),
                'registration_id' => $registration->id,
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
                'transaction_status' => 'pending',
                'snap_token' => $snapToken,
            ]);

            // Tampilkan halaman pembayaran yang langsung memanggil snap
            return view('student.payment', compact('payment', 'snapToken'));

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }

    public function status(Payment $payment)
    {
        // Check if payment belongs to authenticated user
        if ($payment->user_id !== Auth::id()) {
            abort(403);
        }

        // Update status dari Midtrans secara real-time
        try {
            // Ambil status order dari Midtrans
            $midtransStatus = Transaction::status($payment->order_id);
            $transactionStatus = $midtransStatus->transaction_status;

            // Update database sesuai status terbaru
            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                $payment->transaction_status = 'success';
            } elseif ($transactionStatus == 'pending') {
                $payment->transaction_status = 'pending';
            } elseif ($transactionStatus == 'expire') {
                $payment->transaction_status = 'expired';
            } else {
                $payment->transaction_status = 'failure';
            }

            // Simpan detail tambahan
            $payment->payment_type = $midtransStatus->payment_type ?? $payment->payment_type;
            $payment->fraud_status = $midtransStatus->fraud_status ?? $payment->fraud_status;
            $payment->payment_details = json_encode($midtransStatus);
            $payment->save();

            // Jika pembayaran sukses, update status pendaftaran menjadi 'approved'
            if ($payment->transaction_status == 'success') {
                $registration = $payment->registration;
                if ($registration && $registration->status == 'pending') {
                    $registration->status = 'approved';
                    $registration->save();
                }
            }
        } catch (\Exception $e) {
            // Log error, tetapi tetap tampilkan halaman dengan data yang ada
            Log::error('Midtrans status check failed: ' . $e->getMessage());
        }

        return view('student.payment-status', compact('payment'));
    }
}