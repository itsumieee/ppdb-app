@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 max-w-3xl w-full transition-all duration-300 hover:shadow-3d transform hover:-translate-y-1">
        <!-- Header dengan ikon gradien -->
        <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                <i class="fas fa-bullhorn text-white text-sm"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Tambah Pengumuman Baru</h2>
        </div>

        <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul <span class="text-red-500">*</span></label>
                <input type="text" name="judul" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Isi Pengumuman <span class="text-red-500">*</span></label>
                <textarea name="isi" rows="6" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required placeholder="Tulis detail pengumuman di sini..."></textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar (opsional)</label>
                <input type="file" name="gambar" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" accept="image/*">
                <p class="text-xs text-gray-400 mt-1">Format JPG, PNG, maks 2MB</p>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_published" id="is_published" value="1" class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_published" class="text-sm font-medium text-gray-700">Publikasikan sekarang</label>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.pengumuman.index') }}" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl text-sm font-medium transition shadow-md">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105">Simpan & Publikasikan</button>
            </div>
        </form>
    </div>
</div>
@endsection