@extends('layouts.admin')

@section('title', 'Edit Foto Galeri')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 max-w-2xl w-full transition-all duration-300 hover:shadow-3d transform hover:-translate-y-1">
        <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center shadow-md">
                <i class="fas fa-edit text-white text-sm"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Foto: {{ $galeri->judul }}</h2>
        </div>

        <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Foto <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ $galeri->judul }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar Saat Ini</label>
                <div class="p-2 bg-gray-100 rounded-xl inline-block shadow-inner">
                    <img src="{{ Storage::url($galeri->gambar) }}" class="h-24 w-auto object-cover rounded-lg shadow-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Ganti Gambar (opsional)</label>
                <input type="file" name="gambar" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" accept="image/*">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Album (opsional)</label>
                <input type="text" name="album" value="{{ $galeri->album }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.galeri.index') }}" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl text-sm font-medium transition shadow-md">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105">
                    <i class="fas fa-save mr-1"></i> Update Foto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection