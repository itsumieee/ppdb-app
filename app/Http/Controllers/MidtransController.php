<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        // Set konfigurasi
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Ambil dan verifikasi notifikasi
        $notification = json_decode($request->getContent(), true);

        $orderId = $notification['order_id'];
        $statusCode = $notification['status_code'];
        $grossAmount = $notification['gross_amount'];
        $serverKey = env('MIDTRANS_SERVER_KEY');

        // Generate signature key untuk verifikasi
        $inputSignature = $notification['signature_key'];
        $signature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($signature != $inputSignature) {
            Log::warning('Invalid signature for order_id: ' . $orderId);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Cari transaksi berdasarkan order_id
        $payment = Payment::where('order_id', $orderId)->first();
        if (!$payment) {
            Log::error('Payment not found for order_id: ' . $orderId);
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Update status transaksi berdasarkan notifikasi
        $transactionStatus = $notification['transaction_status'];
        $fraudStatus = $notification['fraud_status'];

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $payment->transaction_status = 'success';
                $this->updateRegistrationStatus($payment);
            }
        } else if ($transactionStatus == 'settlement') {
            $payment->transaction_status = 'success';
            $this->updateRegistrationStatus($payment);
        } else if ($transactionStatus == 'pending') {
            $payment->transaction_status = 'pending';
        } else if ($transactionStatus == 'deny') {
            $payment->transaction_status = 'failed';
        } else if ($transactionStatus == 'expire') {
            $payment->transaction_status = 'expired';
        } else if ($transactionStatus == 'cancel') {
            $payment->transaction_status = 'canceled';
        }

        $payment->payment_type = $notification['payment_type'] ?? null;
        $payment->fraud_status = $fraudStatus;
        $payment->payment_details = json_encode($notification);
        $payment->save();

        return response()->json(['message' => 'OK']);
    }

    private function updateRegistrationStatus($payment)
    {
        $registration = $payment->registration;
        if ($registration && $registration->status != 'approved') {
            $registration->status = 'approved';
            $registration->save();

            Log::info('Registration status updated to approved for registration_id: ' . $registration->id);
        }
    }
}