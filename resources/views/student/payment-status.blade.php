@extends('layouts.app')

@section('title', 'Status Pembayaran')

@section('content')
<div class="bg-gradient-to-br from-gray-50 via-white to-blue-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Status Pembayaran</h2>
            </div>
            <div class="p-6 md:p-8">

                @if($payment->transaction_status == 'expired')
                    <div class="bg-red-50 border-l-4 border-red-500 p-5 rounded-xl mb-6">
                        <p class="text-red-700 font-semibold">⏰ Pembayaran Kadaluarsa</p>
                        <p>Waktu pembayaran telah habis. Silakan buat pembayaran baru.</p>
                        <a href="{{ route('student.payment.create', $payment->registration_id) }}" 
                           class="mt-3 inline-block bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                            Buat Pembayaran Baru
                        </a>
                    </div>

                @elseif($payment->transaction_status == 'pending')
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-5 rounded-xl mb-6">
                        <p class="text-yellow-700 font-semibold">⏳ Menunggu Pembayaran</p>
                        <p>Silakan selesaikan pembayaran Anda.</p>
                        <a href="{{ route('student.payment.create', $payment->registration_id) }}" 
                           class="mt-3 inline-block bg-blue-600 text-white px-5 py-2 rounded-lg">
                            Lanjutkan Pembayaran
                        </a>
                    </div>

                @elseif($payment->transaction_status == 'success')
                    <div class="bg-green-50 border-l-4 border-green-500 p-5 rounded-xl mb-6">
                        <p class="text-green-700 font-semibold">✅ Pembayaran Berhasil!</p>
                        <p>Terima kasih, pembayaran Anda telah kami terima.</p>
                    </div>

                @else
                    <div class="bg-red-50 border-l-4 border-red-500 p-5 rounded-xl mb-6">
                        <p class="text-red-700 font-semibold">❌ Pembayaran Gagal</p>
                        <p>Silakan coba lagi.</p>
                        <a href="{{ route('student.payment.create', $payment->registration_id) }}" 
                           class="mt-3 inline-block bg-blue-600 text-white px-5 py-2 rounded-lg">Coba Lagi</a>
                    </div>
                @endif

                <!-- Detail transaksi -->
                <div class="bg-gray-50 rounded-xl p-5 mt-4">
                    <h3 class="font-semibold text-gray-800 mb-3">Detail Transaksi</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Order ID:</span>
                            <span class="font-mono">{{ $payment->order_id }}</span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-600">Jumlah:</span>
                            <span class="font-bold text-green-700">Rp {{ number_format($payment->gross_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            <span class="font-medium">
                                @if($payment->transaction_status == 'success') Sukses
                                @elseif($payment->transaction_status == 'pending') Pending
                                @elseif($payment->transaction_status == 'expired') Kadaluarsa
                                @else Gagal @endif
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-4 mt-6">
                    <a href="{{ route('student.status') }}" class="bg-gray-600 text-white px-5 py-2 rounded-lg">Lihat Status Pendaftaran</a>
                    <a href="{{ route('student.beranda') }}" class="bg-gray-500 text-white px-5 py-2 rounded-lg">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Auto-refresh halaman setiap 3 detik untuk cek status terbaru
    // Hanya untuk status pending (menunggu pembayaran)
    @if($payment->transaction_status == 'pending')
        setTimeout(function() {
            window.location.reload();
        }, 3000);
    @endif
</script>
@endsection