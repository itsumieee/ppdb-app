@extends('layouts.admin')

@section('title', 'Edit Profil Sekolah')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 max-w-5xl w-full transition-all duration-300 hover:shadow-3d transform hover:-translate-y-1">
        <!-- Header dengan ikon gradien -->
        <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                <i class="fas fa-school text-white text-sm"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Profil Sekolah</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded-lg mb-4 shadow-sm">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.profil_sekolah.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Informasi Dasar -->
            <div class="bg-gray-50/50 rounded-xl p-5 shadow-inner">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-building text-blue-500"></i> Informasi Dasar
                </h3>
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Sekolah <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_sekolah" value="{{ $profil['nama_sekolah'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ $profil['email'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kontak (Telepon) <span class="text-red-500">*</span></label>
                        <input type="text" name="kontak" value="{{ $profil['kontak'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">WhatsApp</label>
                        <input type="text" name="whatsapp" value="{{ $profil['whatsapp'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                        <textarea name="alamat" rows="2" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>{{ $profil['alamat'] ?? '' }}</textarea>
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
                        <input type="text" name="instagram" value="{{ $profil['instagram'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" placeholder="username">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Facebook</label>
                        <input type="text" name="facebook" value="{{ $profil['facebook'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" placeholder="username">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">YouTube</label>
                        <input type="text" name="youtube" value="{{ $profil['youtube'] ?? '' }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" placeholder="channel ID">
                    </div>
                </div>
            </div>

            <!-- Konten Profil -->
            <div class="bg-gray-50/50 rounded-xl p-5 shadow-inner">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-file-alt text-blue-500"></i> Konten Profil
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sejarah Sekolah</label>
                        <textarea name="sejarah" rows="4" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">{{ $profil['sejarah'] ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Visi & Misi</label>
                        <textarea name="visi_misi" rows="5" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">{{ $profil['visi_misi'] ?? '' }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Pisahkan visi dan misi dengan baris baru atau gunakan format HTML.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sambutan Kepala Sekolah</label>
                        <textarea name="sambutan_kepsek" rows="4" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">{{ $profil['sambutan_kepsek'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Logo & Favicon -->
            <div class="bg-gray-50/50 rounded-xl p-5 shadow-inner">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-image text-blue-500"></i> Logo & Favicon
                </h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Logo Sekolah</label>
                        @if(isset($profil['logo']) && $profil['logo'])
                            <div class="mb-3 p-2 bg-white rounded-xl inline-block shadow-sm">
                                <img src="{{ Storage::url($profil['logo']) }}" class="h-20 w-auto object-contain">
                            </div>
                        @endif
                        <input type="file" name="logo" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" accept="image/*">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Favicon (Ikon Tab)</label>
                        @if(isset($profil['favicon']) && $profil['favicon'])
                            <div class="mb-3 p-2 bg-white rounded-xl inline-block shadow-sm">
                                <img src="{{ Storage::url($profil['favicon']) }}" class="h-8 w-8 object-contain">
                            </div>
                        @endif
                        <input type="file" name="favicon" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" accept="image/x-icon,image/png,image/jpg">
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl text-sm font-medium transition shadow-md">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105">
                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection