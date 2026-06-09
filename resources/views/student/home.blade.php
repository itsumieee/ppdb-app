@extends('layouts.app')

@section('title', 'Beranda - PPDB SMK ICB Cinta Teknika')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero & Info PPDB -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white mb-8">
            <h1 class="text-3xl font-bold">PPDB SMK ICB Cinta Teknika</h1>
            <p class="mt-2">{{ \App\Models\Pengaturan::where('key','info_ppdb')->first()->value ?? 'Pendaftaran dibuka 1 April - 30 Juni 2025' }}</p>
            @guest <a href="{{ route('register') }}" class="mt-4 inline-block bg-yellow-500 px-4 py-2 rounded">Daftar Sekarang</a> @endguest
        </div>

        <!-- Profil Sekolah (ringkasan) -->
        <div class="bg-white rounded-xl shadow p-6 mb-8">
            <h2 class="text-2xl font-bold">Profil Sekolah</h2>
            <p class="mt-2">{{ \App\Models\Pengaturan::where('key','sejarah')->first()->value ?? 'Sejarah sekolah...' }}</p>
        </div>

        <!-- Jurusan -->
        <h2 class="text-2xl font-bold mb-4">Jurusan</h2>
        <div class="grid md:grid-cols-3 gap-4 mb-8">
            @foreach($jurusan as $j)
            <div class="bg-white rounded-xl shadow p-4">{{ $j->nama }}</div>
            @endforeach
        </div>

        <!-- Pengumuman -->
        <h2 class="text-2xl font-bold mb-4">Pengumuman</h2>
        <div class="space-y-2 mb-8">
            @foreach($pengumuman as $p)
            <div class="bg-white p-4 rounded shadow"><a href="{{ route('student.announcement.detail', $p->id) }}" class="font-semibold">{{ $p->judul }}</a> - {{ $p->created_at->format('d/m/Y') }}</div>
            @endforeach
        </div>

        <!-- Galeri -->
        <h2 class="text-2xl font-bold mb-4">Galeri</h2>
        <div class="grid grid-cols-3 gap-2 mb-8">
            @foreach($galeri as $g)
            <img src="{{ Storage::url($g->gambar) }}" class="rounded-lg h-32 w-full object-cover">
            @endforeach
        </div>

        <!-- Jadwal -->
        <h2 class="text-2xl font-bold mb-4">Jadwal PPDB</h2>
        <div class="bg-white rounded-xl shadow overflow-hidden mb-8">
            <table class="min-w-full">...</table>
        </div>
    </div>
</div>
@endsection