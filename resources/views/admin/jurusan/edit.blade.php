@extends('layouts.admin')

@section('title', 'Edit Jurusan')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Edit Jurusan</h2>
        <p class="text-gray-500 text-sm mt-1">Perbarui informasi kompetensi keahlian</p>
    </div>

    <!-- Card Form (dengan efek 3D) -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-1">
        <form action="{{ route('admin.jurusan.update', $jurusan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-5">
                <!-- Kode Jurusan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-code text-blue-500 mr-1"></i> Kode Jurusan *
                    </label>
                    <input type="text" name="kode" value="{{ old('kode', $jurusan->kode) }}" 
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition shadow-sm" 
                           required placeholder="Contoh: RPL">
                    @error('kode') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Nama Jurusan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-graduation-cap text-blue-500 mr-1"></i> Nama Jurusan *
                    </label>
                    <input type="text" name="nama" value="{{ old('nama', $jurusan->nama) }}" 
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition shadow-sm" 
                           required placeholder="Rekayasa Perangkat Lunak">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-align-left text-blue-500 mr-1"></i> Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="4" 
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition shadow-sm">{{ old('deskripsi', $jurusan->deskripsi) }}</textarea>
                </div>

                <!-- Kuota -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-users text-blue-500 mr-1"></i> Kuota *
                    </label>
                    <input type="number" name="kuota" value="{{ old('kuota', $jurusan->kuota) }}" 
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 focus:border-transparent transition shadow-sm" 
                           required min="1">
                </div>

                <!-- Gambar -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        <i class="fas fa-image text-blue-500 mr-1"></i> Gambar (opsional)
                    </label>
                    @if($jurusan->gambar)
                        <div class="mb-3 p-2 bg-gray-50 rounded-xl inline-block shadow-inner">
                            <img src="{{ Storage::url($jurusan->gambar) }}" class="h-20 w-20 object-cover rounded-lg shadow-md">
                        </div>
                        <p class="text-xs text-gray-400 mb-2">Kosongkan jika tidak ingin mengganti</p>
                    @endif
                    <input type="file" name="gambar" class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-400 transition shadow-sm" accept="image/*">
                </div>

                <!-- Status Aktif (Toggle modern) -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl shadow-inner">
                    <span class="text-sm font-semibold text-gray-700"><i class="fas fa-power-off text-blue-500 mr-1"></i> Aktifkan jurusan</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $jurusan->is_active ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.jurusan.index') }}" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl text-sm font-medium transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <i class="fas fa-save"></i> Update Jurusan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection