@extends('layouts.admin')

@section('title', 'Galeri Sekolah')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Galeri Foto</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola foto kegiatan dan fasilitas sekolah</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 inline-flex items-center gap-2">
            <i class="fas fa-plus-circle"></i> Tambah Foto
        </a>
    </div>

    <!-- Filter Album (3D card) -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-5 transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-0.5">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-semibold text-gray-700 mb-1"><i class="fas fa-filter text-blue-500 mr-1"></i> Filter Album</label>
                <select name="album" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                    <option value="">Semua Album</option>
                    @foreach($albums as $album)
                        <option value="{{ $album }}" {{ request('album') == $album ? 'selected' : '' }}>{{ $album }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 inline-flex items-center gap-2">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-md inline-flex items-center gap-2 ml-2">
                    <i class="fas fa-undo-alt"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Grid Galeri dengan efek 3D -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($galeri as $g)
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 group">
            <!-- Gambar dengan overlay hover -->
            <div class="relative overflow-hidden h-48">
                <img src="{{ Storage::url($g->gambar) }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center gap-3">
                    <a href="{{ route('admin.galeri.edit', $g) }}" class="bg-yellow-500 text-white p-2 rounded-full hover:bg-yellow-600 transition transform hover:scale-110">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.galeri.destroy', $g) }}" method="POST" class="inline" onsubmit="return confirm('Hapus foto ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition transform hover:scale-110">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="p-3">
                <p class="font-semibold text-gray-800 text-sm truncate">{{ $g->judul }}</p>
                @if($g->album)
                    <span class="text-xs text-gray-500 inline-flex items-center gap-1 mt-1"><i class="fas fa-folder-open text-blue-400"></i> {{ $g->album }}</span>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 text-gray-400 bg-white rounded-2xl shadow-md">
            <i class="fas fa-images text-6xl mb-4 block opacity-50"></i>
            <p class="text-lg">Belum ada foto di galeri</p>
            <a href="{{ route('admin.galeri.create') }}" class="text-blue-600 mt-3 inline-block font-medium hover:underline">Upload foto pertama →</a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6 px-4 py-3 bg-white rounded-xl shadow-sm border border-gray-100">
        {{ $galeri->appends(request()->query())->links() }}
    </div>
</div>
@endsection