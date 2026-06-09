@extends('layouts.app')

@section('title', 'Beranda PPDB')

@section('content')
<div class="bg-gradient-to-br from-gray-50 via-white to-blue-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <!-- Hero Section dengan 3D Glassmorphism -->
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 via-indigo-700 to-purple-700 p-8 text-white shadow-2xl transition-all duration-500 hover:shadow-3d hover:scale-[1.01]">
            <div class="relative z-10">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-extrabold">Selamat Datang, {{ Auth::user()->name }}! 🎉</h1>
                        <p class="text-blue-100 text-lg mt-2">PPDB SMK ICB Cinta Teknika <br> Tahun Ajaran 2025/2026</p>
                    </div>
                    <div>
                        @php $registrasi = Auth::user()->registration; @endphp
                        @if(!$registrasi)
                            <a href="{{ route('student.register') }}" class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-bold px-6 py-3 rounded-full shadow-lg transition transform hover:scale-105">
                                <i class="fas fa-pen-alt"></i> Mulai Pendaftaran
                            </a>
                        @else
                            <a href="{{ route('student.status') }}" class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-full shadow-lg transition transform hover:scale-105">
                                <i class="fas fa-chart-line"></i> Lihat Status
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-10 -right-10 opacity-10">
                <i class="fas fa-graduation-cap text-9xl"></i>
            </div>
        </div>

        <!-- Informasi PPDB (Card modern) -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 border border-white/30 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex items-center gap-3 border-b border-gray-100 pb-3 mb-3">
                <div class="p-2 bg-blue-100 rounded-xl">
                    <i class="fas fa-bullhorn text-blue-600 text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Informasi PPDB</h2>
            </div>
            <p class="text-gray-600 text-lg leading-relaxed">
                {{ \App\Models\Pengaturan::where('key', 'info_ppdb')->value('value') ?? 'Pendaftaran dibuka 1 April - 30 Juni 2025. Daftar segera!' }}
            </p>
        </div>

        <!-- Grid dua kolom: Profil & Jurusan -->
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Profil Sekolah Card -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <div class="flex items-center gap-3 border-b border-gray-100 pb-3 mb-4">
                    <div class="p-2 bg-indigo-100 rounded-xl">
                        <i class="fas fa-school text-indigo-600 text-lg"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Profil Sekolah</h2>
                </div>
                <div class="space-y-4">
                    <div>
                        <h3 class="font-semibold text-gray-700 flex items-center gap-1"><i class="fas fa-history text-blue-400 text-sm"></i> Sejarah</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $profil['sejarah'] ?? 'SMK ICB Cinta Teknika berdiri sejak 2010, berkomitmen mencetak generasi technopreneur unggul.' }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 flex items-center gap-1"><i class="fas fa-eye text-blue-400 text-sm"></i> Visi & Misi</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $profil['visi_misi'] ?? 'Visi: Menjadi sekolah vokasi berstandar internasional. Misi: Mengembangkan kurikulum industri 4.0, mencetak lulusan siap kerja.' }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 flex items-center gap-1"><i class="fas fa-map-marker-alt text-blue-400 text-sm"></i> Kontak</h3>
                        <p class="text-gray-600 text-sm">{{ $profil['alamat'] ?? 'Jl. Pendidikan No.123, Bandung' }}<br>Telp: {{ $profil['kontak'] ?? '(022) 1234567' }}<br>Email: {{ $profil['email'] ?? 'info@smkicb.sch.id' }}</p>
                    </div>
                </div>
            </div>

            <!-- Jurusan Card dengan grid rapi -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                <div class="flex items-center gap-3 border-b border-gray-100 pb-3 mb-4">
                    <div class="p-2 bg-purple-100 rounded-xl">
                        <i class="fas fa-book-open text-purple-600 text-lg"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Jurusan Tersedia</h2>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($jurusan as $j)
                    <div class="bg-gray-50/80 rounded-xl p-3 text-center border border-gray-100 hover:border-blue-200 hover:shadow-md transition-all duration-200 hover:-translate-y-0.5">
                        <p class="font-bold text-gray-800">{{ $j->nama }}</p>
                        <p class="text-xs text-gray-500 mt-1"><i class="fas fa-users"></i> Kuota: {{ $j->kuota }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Jadwal PPDB Card -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex items-center gap-3 border-b border-gray-100 pb-3 mb-4">
                <div class="p-2 bg-green-100 rounded-xl">
                    <i class="fas fa-calendar-alt text-green-600 text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Jadwal PPDB</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 rounded-xl">
                        <tr><th class="px-5 py-3 text-left font-semibold text-gray-700">Kegiatan</th><th class="px-5 py-3 text-left font-semibold text-gray-700">Tanggal</th></tr>
                    </thead>
                    <tbody>
                        @forelse($jadwal as $j)
                        <tr class="border-b border-gray-100 hover:bg-blue-50/40 transition">
                            <td class="px-5 py-3 font-medium text-gray-700">{{ $j->nama_kegiatan }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ \Carbon\Carbon::parse($j->tanggal_mulai)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($j->tanggal_selesai)->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="px-5 py-6 text-center text-gray-400">Belum ada jadwal</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pengumuman Terbaru Card -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex justify-between items-center flex-wrap mb-4 border-b border-gray-100 pb-3">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-yellow-100 rounded-xl">
                        <i class="fas fa-newspaper text-yellow-600 text-lg"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Pengumuman Terbaru</h2>
                </div>
                <a href="{{ route('student.pengumuman') }}" class="text-blue-600 text-sm font-medium hover:underline flex items-center gap-1">Lihat semua <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="space-y-4">
                @forelse($pengumuman as $p)
                <div class="border-l-4 border-yellow-400 pl-4 hover:bg-gray-50 p-2 rounded-r-xl transition">
                    <p class="font-semibold text-gray-800">{{ $p->judul }}</p>
                    <p class="text-xs text-gray-500 mt-1 flex items-center gap-1"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($p->published_at)->format('d/m/Y') }}</p>
                    <p class="text-gray-600 text-sm mt-1">{{ Str::limit($p->isi, 120) }}</p>
                </div>
                @empty
                <p class="text-gray-400 text-center py-4">Belum ada pengumuman</p>
                @endforelse
            </div>
        </div>

        <!-- Galeri Card -->
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex items-center gap-3 border-b border-gray-100 pb-3 mb-4">
                <div class="p-2 bg-pink-100 rounded-xl">
                    <i class="fas fa-images text-pink-600 text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Galeri Sekolah</h2>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-5">
                @forelse($galeri as $g)
                <div class="rounded-xl overflow-hidden shadow-md transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <img src="{{ Storage::url($g->gambar) }}" class="h-32 w-full object-cover hover:scale-105 transition duration-500">
                </div>
                @empty
                <p class="text-gray-400 col-span-3 text-center py-6">Belum ada foto galeri</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection