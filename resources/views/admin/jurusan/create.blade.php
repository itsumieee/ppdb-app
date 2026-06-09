@extends('layouts.admin')

@section('title', 'Tambah Jurusan')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 max-w-2xl w-full transition-all duration-300 hover:shadow-3d transform hover:-translate-y-1">
        <!-- Header dengan ikon gradien -->
        <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                <i class="fas fa-plus-circle text-white text-sm"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Tambah Jurusan Baru</h2>
        </div>

        <form action="{{ route('admin.jurusan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Jurusan <span class="text-red-500">*</span></label>
                <input type="text" name="kode" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition shadow-sm" required placeholder="Contoh: RPL">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Jurusan <span class="text-red-500">*</span></label>
                <input type="text" name="nama" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required placeholder="Rekayasa Perangkat Lunak">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" placeholder="Deskripsi singkat tentang jurusan ini..."></textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Kuota <span class="text-red-500">*</span></label>
                <input type="number" name="kuota" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required value="100">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar (opsional)</label>
                <input type="file" name="gambar" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" accept="image/*">
                <p class="text-xs text-gray-400 mt-1">Format JPG, PNG, maks 2MB</p>
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_active" class="text-sm font-medium text-gray-700">Aktifkan jurusan</label>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.jurusan.index') }}" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl text-sm font-medium transition shadow-md">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105">Simpan Jurusan</button>
            </div>
        </form>
    </div>
</div>
@endsection