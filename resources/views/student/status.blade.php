@extends('layouts.app')

@section('title', 'Status Pendaftaran')

@section('content')
<div class="bg-gradient-to-br from-gray-50 via-white to-blue-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Header 3D -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white shadow-xl transition-all duration-300 hover:shadow-2xl">
            <div class="relative z-10">
                <h2 class="text-2xl md:text-3xl font-bold flex items-center gap-2">
                    <i class="fas fa-chart-line"></i> Status Pendaftaran Anda
                </h2>
                <p class="text-blue-100 mt-2">SMK ICB Cinta Teknika – Pantau perkembangan pendaftaranmu</p>
            </div>
            <div class="absolute bottom-0 right-0 opacity-10">
                <i class="fas fa-clipboard-list text-7xl"></i>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm flex items-center gap-3">
                <i class="fas fa-check-circle text-green-500"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm flex items-center gap-3">
                <i class="fas fa-exclamation-circle text-red-500"></i> {{ session('error') }}
            </div>
        @endif

        @if($registration)
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Status Pendaftaran Card 3D -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 hover:border-blue-200">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                            <i class="fas fa-id-card text-white text-sm"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Status Pendaftaran</h3>
                    </div>
                    <div class="space-y-4">
                        <div class="flex flex-wrap justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Nomor Pendaftaran:</span>
                            <span class="font-mono font-semibold text-gray-800 bg-gray-100 px-3 py-1 rounded-lg">{{ $registration->registration_number }}</span>
                        </div>
                        <div class="flex flex-wrap justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Nama Lengkap:</span>
                            <span class="font-semibold text-gray-800">{{ $registration->full_name }}</span>
                        </div>
                        <div class="flex flex-wrap justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Jurusan Pilihan:</span>
                            <span class="font-semibold text-gray-800">{{ $registration->major_choice }}</span>
                        </div>
                        <div class="flex flex-wrap justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-600 font-medium">Status:</span>
                            @if($registration->status == 'pending')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800 shadow-sm"><i class="fas fa-clock"></i> Menunggu Verifikasi</span>
                            @elseif($registration->status == 'approved')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800 shadow-sm"><i class="fas fa-check-circle"></i> Diterima</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800 shadow-sm"><i class="fas fa-times-circle"></i> Ditolak</span>
                            @endif
                        </div>
                        @if($registration->admin_note)
                            <div class="mt-3 p-3 bg-blue-50 rounded-xl border-l-4 border-blue-400 shadow-sm">
                                <p class="text-sm font-semibold text-blue-700"><i class="fas fa-comment"></i> Catatan Admin:</p>
                                <p class="text-gray-700 text-sm">{{ $registration->admin_note }}</p>
                            </div>
                        @endif
                        <div class="flex flex-wrap justify-between items-center pt-2">
                            <span class="text-gray-600 font-medium">Tanggal Daftar:</span>
                            <span class="font-semibold text-gray-700">{{ $registration->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Kelengkapan Berkas Card 3D -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 hover:border-blue-200">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-xl flex items-center justify-center shadow-md">
                            <i class="fas fa-folder-open text-white text-sm"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Kelengkapan Berkas</h3>
                    </div>
                    <div class="space-y-3">
                        @php
                            $berkas = [
                                'foto' => 'Foto 4x6',
                                'kk' => 'Kartu Keluarga',
                                'akta' => 'Akta Kelahiran',
                                'rapor' => 'Rapor Terbaru',
                                'surat_lulus' => 'Surat Lulus'
                            ];
                        @endphp
                        @foreach($berkas as $field => $label)
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <div class="flex items-center gap-2">
                                @if($registration->$field)
                                    <i class="fas fa-check-circle text-green-500 text-sm"></i>
                                    <span class="text-green-700">{{ $label }}</span>
                                @else
                                    <i class="fas fa-times-circle text-red-400 text-sm"></i>
                                    <span class="text-red-500">{{ $label }}</span>
                                    <span class="text-xs text-gray-400">(belum upload)</span>
                                @endif
                            </div>
                            @if($registration->$field)
                                <a href="{{ Storage::url($registration->$field) }}" target="_blank" class="text-blue-500 text-xs hover:underline">Lihat</a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6 pt-3">
                        <a href="{{ route('student.upload.index') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-medium text-sm">
                            <i class="fas fa-upload"></i> Upload / Edit Berkas
                        </a>
                    </div>
                </div>
            </div>

            <!-- Status Pembayaran Card 3D -->
            @php
                $payment = App\Models\Payment::where('registration_id', $registration->id)->first();
            @endphp

            @if(!$payment || $payment->transaction_status != 'success')
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 hover:border-yellow-200">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center shadow-md">
                            <i class="fas fa-credit-card text-white text-sm"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Status Pembayaran</h3>
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <p class="text-yellow-800 font-semibold flex items-center gap-2"><i class="fas fa-exclamation-triangle"></i> Pendaftaran Anda belum lunas.</p>
                            <p class="text-sm text-gray-600 mt-1">Silakan lakukan pembayaran untuk melanjutkan proses seleksi.</p>
                        </div>
                        <a href="{{ route('student.payment.create', $registration->id) }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white px-6 py-2.5 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-medium whitespace-nowrap">
                            <i class="fas fa-money-bill-wave"></i> Bayar Sekarang
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-lg border border-green-200 p-6 transition-all duration-300 hover:shadow-2xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                            <i class="fas fa-check-circle text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-green-700">Pembayaran Lunas</h3>
                            <p class="text-gray-600 text-sm">Terima kasih, pembayaran Anda telah kami terima.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tombol Aksi 3D -->
            <div class="flex flex-wrap gap-4 mt-4">
                <a href="{{ route('student.bukti') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-green-700 hover:from-emerald-700 hover:to-green-800 text-white px-6 py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-semibold">
                    <i class="fas fa-file-pdf"></i> Lihat Bukti Pendaftaran
                </a>
                <a href="{{ route('student.beranda') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-6 py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-semibold">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        @else
            <!-- Empty state 3D -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-12 text-center transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Anda belum melakukan pendaftaran</h3>
                <p class="text-gray-500 mb-6">Silakan daftar terlebih dahulu untuk melihat status pendaftaran Anda.</p>
                <a href="{{ route('student.register') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-semibold">
                    <i class="fas fa-pen-alt"></i> Mulai Pendaftaran
                </a>
            </div>
        @endif
    </div>
</div>
@endsection