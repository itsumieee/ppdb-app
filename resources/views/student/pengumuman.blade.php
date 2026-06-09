@extends('layouts.app')

@section('title', 'Pengumuman PPDB')

@section('content')
<div class="bg-gradient-to-br from-gray-50 via-white to-blue-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Header 3D -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white shadow-xl transition-all duration-300 hover:shadow-2xl">
            <div class="relative z-10">
                <h2 class="text-2xl md:text-3xl font-bold flex items-center gap-2">
                    <i class="fas fa-bullhorn"></i> Pengumuman PPDB
                </h2>
                <p class="text-blue-100 mt-2">Informasi terbaru seputar Penerimaan Peserta Didik Baru</p>
            </div>
            <div class="absolute bottom-0 right-0 opacity-10">
                <i class="fas fa-newspaper text-7xl"></i>
            </div>
        </div>

        @if($pengumuman->count() > 0)
            <div class="grid gap-6">
                @foreach($pengumuman as $item)
                    <!-- Card 3D dengan efek hover -->
                    <div class="group bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 hover:border-blue-200">
                        <div class="flex flex-wrap justify-between items-start gap-3 mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                                    <i class="fas fa-file-alt text-white text-sm"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $item->judul }}</h3>
                            </div>
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 shadow-sm">
                                <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($item->published_at ?? $item->created_at)->format('d/m/Y') }}
                            </span>
                        </div>
                        <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">{{ Str::limit($item->isi, 180) }}</p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('student.pengumuman.show', $item->id) }}" class="inline-flex items-center gap-1 text-blue-600 font-semibold hover:text-blue-800 transition">
                                Baca Selengkapnya <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                            <!-- Animasi garis bawah gradien (hover) -->
                            <div class="h-0.5 w-0 group-hover:w-full transition-all duration-500 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination dengan styling modern -->
            <div class="mt-6 flex justify-center">
                <div class="bg-white rounded-xl shadow-md px-4 py-3 inline-block">
                    {{ $pengumuman->links() }}
                </div>
            </div>
        @else
            <!-- Empty state 3D -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-16 text-center transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada pengumuman saat ini.</p>
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