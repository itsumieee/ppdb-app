@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 max-w-5xl w-full transition-all duration-300 hover:shadow-3d transform hover:-translate-y-1">
        <!-- Header -->
        <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                <i class="fas fa-sliders-h text-white text-sm"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Pengaturan Website</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded-lg mb-6 shadow-sm flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Informasi Sekolah -->
            <div class="bg-gray-50/50 rounded-xl p-5 shadow-inner transition-all hover:shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-building text-blue-500"></i> Informasi Sekolah
                </h3>
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Sekolah <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_sekolah" value="{{ $pengaturan['nama_sekolah'] ?? 'SMK ICB Cinta Teknika' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email Sekolah</label>
                        <input type="email" name="email" value="{{ $pengaturan['email'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kontak (Telepon)</label>
                        <input type="text" name="kontak" value="{{ $pengaturan['kontak'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">WhatsApp</label>
                        <input type="text" name="whatsapp" value="{{ $pengaturan['whatsapp'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" rows="2" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">{{ $pengaturan['alamat'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Media Sosial -->
            <div class="bg-gray-50/50 rounded-xl p-5 shadow-inner">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-share-alt text-blue-500"></i> Media Sosial
                </h3>
                <div class="grid md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Instagram</label>
                        <input type="text" name="instagram" value="{{ $pengaturan['instagram'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" placeholder="username">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Facebook</label>
                        <input type="text" name="facebook" value="{{ $pengaturan['facebook'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" placeholder="username">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">YouTube</label>
                        <input type="text" name="youtube" value="{{ $pengaturan['youtube'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" placeholder="channel ID">
                    </div>
                </div>
            </div>

            <!-- Tema & Informasi PPDB -->
            <div class="bg-gray-50/50 rounded-xl p-5 shadow-inner">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-palette text-blue-500"></i> Tema & Informasi PPDB
                </h3>
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Warna Tema</label>
                        <input type="color" name="warna_tema" value="{{ $pengaturan['warna_tema'] ?? '#2563eb' }}" class="w-20 h-10 rounded-lg border border-gray-200 shadow-sm cursor-pointer">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Info PPDB (running text)</label>
                        <input type="text" name="info_ppdb" value="{{ $pengaturan['info_ppdb'] ?? 'Pendaftaran dibuka 1 April - 30 Juni 2025' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                    </div>
                </div>
            </div>

            <!-- Konten Statis -->
            <div class="bg-gray-50/50 rounded-xl p-5 shadow-inner">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-file-alt text-blue-500"></i> Konten Halaman Statis
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sejarah Sekolah</label>
                        <textarea name="sejarah" rows="4" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">{{ $pengaturan['sejarah'] ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Visi & Misi</label>
                        <textarea name="visi_misi" rows="5" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">{{ $pengaturan['visi_misi'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Logo & Banner -->
            <div class="bg-gray-50/50 rounded-xl p-5 shadow-inner">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-image text-blue-500"></i> Logo & Banner
                </h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Logo Sekolah</label>
                        @if(isset($pengaturan['logo']) && $pengaturan['logo'])
                            <div class="mb-3 p-2 bg-white rounded-xl inline-block shadow-sm">
                                <img src="{{ Storage::url($pengaturan['logo']) }}" class="h-16 w-auto object-contain">
                            </div>
                        @endif
                        <input type="file" name="logo" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" accept="image/*">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Favicon (Ikon Tab)</label>
                        @if(isset($pengaturan['favicon']) && $pengaturan['favicon'])
                            <div class="mb-3 p-2 bg-white rounded-xl inline-block shadow-sm">
                                <img src="{{ Storage::url($pengaturan['favicon']) }}" class="h-8 w-8 object-contain">
                            </div>
                        @endif
                        <input type="file" name="favicon" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" accept="image/x-icon,image/png,image/jpg">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Banner Beranda</label>
                        @if(isset($pengaturan['banner_home']) && $pengaturan['banner_home'])
                            <div class="mb-3 p-2 bg-white rounded-xl inline-block shadow-sm">
                                <img src="{{ Storage::url($pengaturan['banner_home']) }}" class="h-16 w-auto object-cover">
                            </div>
                        @endif
                        <input type="file" name="banner_home" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" accept="image/*">
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl text-sm font-medium transition shadow-md">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection