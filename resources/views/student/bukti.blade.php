@extends('layouts.app')

@section('title', 'Bukti Pendaftaran')

@section('content')
<div class="bg-gradient-to-br from-gray-50 via-white to-blue-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Header 3D -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white shadow-xl transition-all duration-300 hover:shadow-2xl">
            <div class="relative z-10">
                <h2 class="text-2xl md:text-3xl font-bold flex items-center gap-2">
                    <i class="fas fa-file-alt"></i> Bukti Pendaftaran
                </h2>
                <p class="text-blue-100 mt-2">SMK ICB Cinta Teknika – Cetak & simpan bukti pendaftaran Anda</p>
            </div>
            <div class="absolute bottom-0 right-0 opacity-10">
                <i class="fas fa-print text-7xl"></i>
            </div>
        </div>

        @if($registration)
            <!-- Card Bukti 3D -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <!-- Header Bukti -->
                <div class="text-center mb-8 pb-6 border-b border-gray-200">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-md mb-3">
                        <i class="fas fa-certificate text-white text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-extrabold text-gray-800">BUKTI PENDAFTARAN PPDB</h1>
                    <p class="text-gray-600 mt-1">SMK ICB Cinta Teknika – Tahun Ajaran 2025/2026</p>
                </div>

                <!-- Grid Informasi 2 kolom -->
                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">Nomor Pendaftaran</span>
                            <span class="font-mono font-bold text-gray-800 bg-gray-100 px-3 py-1 rounded-lg">{{ $registration->registration_number }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">Nama Lengkap</span>
                            <span class="font-semibold text-gray-800">{{ $registration->full_name }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">NISN</span>
                            <span class="font-semibold text-gray-800">{{ $registration->nisn }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">NIK</span>
                            <span class="font-semibold text-gray-800">{{ $registration->nik }}</span>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">Tempat / Tgl Lahir</span>
                            <span class="font-semibold text-gray-800">{{ $registration->place_of_birth }}, {{ \Carbon\Carbon::parse($registration->date_of_birth)->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">Jenis Kelamin</span>
                            <span class="font-semibold text-gray-800">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">Agama</span>
                            <span class="font-semibold text-gray-800">{{ $registration->religion }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                            <span class="text-gray-500 text-sm">No. Telepon</span>
                            <span class="font-semibold text-gray-800">{{ $registration->phone }}</span>
                        </div>
                    </div>
                </div>

                <!-- Alamat & Asal Sekolah -->
                <div class="space-y-3 mb-8 pb-6 border-b border-gray-200">
                    <div class="flex flex-wrap justify-between">
                        <span class="text-gray-500 text-sm w-32">Alamat</span>
                        <span class="font-semibold text-gray-800 text-right flex-1">{{ $registration->address }}</span>
                    </div>
                    <div class="flex flex-wrap justify-between">
                        <span class="text-gray-500 text-sm w-32">Asal Sekolah</span>
                        <span class="font-semibold text-gray-800 text-right flex-1">{{ $registration->previous_school }}</span>
                    </div>
                    <div class="flex flex-wrap justify-between">
                        <span class="text-gray-500 text-sm w-32">Jurusan Pilihan</span>
                        <span class="font-bold text-indigo-700 text-right flex-1">{{ $registration->major_choice }}</span>
                    </div>
                </div>

                <!-- Status & Catatan -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 mb-8 shadow-inner">
                    <div class="flex flex-wrap justify-between items-center gap-2">
                        <span class="font-semibold text-gray-700">Status Pendaftaran</span>
                        @if($registration->status == 'pending')
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800 shadow-sm"><i class="fas fa-clock"></i> Menunggu Verifikasi</span>
                        @elseif($registration->status == 'approved')
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800 shadow-sm"><i class="fas fa-check-circle"></i> Diterima</span>
                        @else
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800 shadow-sm"><i class="fas fa-times-circle"></i> Ditolak</span>
                        @endif
                    </div>
                    @if($registration->admin_note)
                        <div class="mt-3 text-sm border-t border-blue-200 pt-3">
                            <p class="text-gray-700"><i class="fas fa-comment-dots text-blue-500 mr-1"></i> <strong>Catatan Admin:</strong> {{ $registration->admin_note }}</p>
                        </div>
                    @endif
                </div>

                <!-- Status Pembayaran -->
                @php $payment = \App\Models\Payment::where('registration_id', $registration->id)->first(); @endphp
                @if($payment && $payment->transaction_status == 'success')
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-8 flex items-center gap-3 shadow-sm">
                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                        <div><strong>Pembayaran LUNAS</strong><br><span class="text-sm">Terima kasih, pembayaran Anda telah kami terima.</span></div>
                    </div>
                @elseif($payment && $payment->transaction_status == 'pending')
                    <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg mb-8 flex items-center gap-3 shadow-sm">
                        <i class="fas fa-hourglass-half text-yellow-500 text-xl"></i>
                        <div class="flex-1"><strong>Menunggu Pembayaran</strong><br><span class="text-sm">Segera selesaikan pembayaran Anda.</span></div>
                        <a href="{{ route('student.payment.create', $registration->id) }}" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-4 py-2 rounded-xl text-sm shadow-md transition transform hover:-translate-y-0.5">Lanjutkan</a>
                    </div>
                @else
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-8 flex items-center gap-3 shadow-sm">
                        <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                        <div class="flex-1"><strong>Pendaftaran BELUM LUNAS</strong><br><span class="text-sm">Silakan lakukan pembayaran untuk melanjutkan.</span></div>
                        <a href="{{ route('student.payment.create', $registration->id) }}" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-4 py-2 rounded-xl text-sm shadow-md transition transform hover:-translate-y-0.5">Bayar Sekarang</a>
                    </div>
                @endif

                <!-- Footer Bukti -->
                <div class="text-center text-gray-400 text-xs pt-6 border-t border-gray-100">
                    <p>Bukti Pendaftaran ini dicetak pada: {{ now()->format('d F Y H:i') }}</p>
                    <p class="mt-1">Harap simpan bukti ini untuk keperluan administrasi</p>
                </div>
            </div>

            <!-- Tombol Aksi 3D -->
            <div class="flex flex-wrap gap-4">
                <form action="{{ route('student.bukti.download') }}" method="GET">
                    <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-700 hover:to-emerald-800 text-white px-6 py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-semibold">
                        <i class="fas fa-download"></i> Download PDF
                    </button>
                </form>
                <a href="{{ route('student.status') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-semibold">
                    <i class="fas fa-chart-line"></i> Status Lengkap
                </a>
                <a href="{{ route('student.beranda') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-6 py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-semibold">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        @else
            <!-- Empty State 3D -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-12 text-center transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <i class="fas fa-file-invoice text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Anda belum melakukan pendaftaran</h3>
                <p class="text-gray-500 mb-6">Silakan daftar terlebih dahulu untuk melihat bukti pendaftaran.</p>
                <a href="{{ route('student.register') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-semibold">
                    <i class="fas fa-pen-alt"></i> Mulai Pendaftaran
                </a>
            </div>
        @endif
    </div>
</div>
@endsection