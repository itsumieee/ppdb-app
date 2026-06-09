@extends('layouts.app')

@section('title', 'Jadwal PPDB')

@section('content')
<div class="bg-gradient-to-br from-gray-50 via-white to-blue-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Header dengan efek 3D -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white shadow-xl transition-all duration-300 hover:shadow-2xl">
            <div class="relative z-10">
                <h2 class="text-2xl md:text-3xl font-bold flex items-center gap-2">
                    <i class="fas fa-calendar-alt"></i> Jadwal Pendaftaran PPDB
                </h2>
                <p class="text-blue-100 mt-2">SMK ICB Cinta Teknika – Tahun Ajaran 2025/2026</p>
            </div>
            <div class="absolute bottom-0 right-0 opacity-10">
                <i class="fas fa-calendar-week text-7xl"></i>
            </div>
        </div>

        @if($jadwal->count() > 0)
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($jadwal as $item)
                    <!-- Card 3D dengan efek hover -->
                    <div class="group bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 hover:border-blue-200">
                        <!-- Header card -->
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                                    <i class="fas fa-calendar-check text-white text-sm"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $item->nama_kegiatan }}</h3>
                            </div>
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 shadow-sm">
                                <i class="fas fa-check-circle"></i> Aktif
                            </span>
                        </div>

                        <!-- Detail tanggal & durasi -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-2">
                            <div class="bg-gray-50 rounded-xl p-3 text-center shadow-inner">
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Mulai</p>
                                <p class="text-base font-bold text-gray-800">
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 text-center shadow-inner">
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Selesai</p>
                                <p class="text-base font-bold text-gray-800">
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="bg-blue-50 rounded-xl p-3 text-center shadow-inner">
                                <p class="text-xs text-blue-500 uppercase tracking-wide">Durasi</p>
                                <p class="text-base font-bold text-blue-700">
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($item->tanggal_selesai)) + 1 }} hari
                                </p>
                            </div>
                        </div>

                        <!-- Keterangan (jika ada) -->
                        @if($item->keterangan)
                            <div class="mt-4 p-3 bg-gray-50 rounded-xl text-sm text-gray-600 border-l-4 border-blue-400 shadow-sm">
                                <i class="fas fa-info-circle text-blue-500 mr-1"></i> {{ $item->keterangan }}
                            </div>
                        @endif

                        <!-- Animasi hover (garis bawah gradien) -->
                        <div class="mt-4 h-0.5 w-0 group-hover:w-full transition-all duration-500 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full"></div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty state dengan 3D effect -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-12 text-center transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Jadwal PPDB belum tersedia.</p>
                <p class="text-gray-400 text-sm mt-2">Silakan cek kembali nanti.</p>
            </div>
        @endif

        <!-- Tombol kembali (3D style) -->
        <div class="mt-6">
            <a href="{{ route('student.beranda') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-6 py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-semibold">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection