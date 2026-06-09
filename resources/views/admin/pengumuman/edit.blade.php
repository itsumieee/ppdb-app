@extends('layouts.admin')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="card-modern max-w-3xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Edit Pengumuman: {{ $pengumuman->judul }}</h2>
    <form action="{{ route('admin.pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Judul *</label>
                <input type="text" name="judul" value="{{ $pengumuman->judul }}" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Isi Pengumuman *</label>
                <textarea name="isi" rows="6" class="w-full border rounded-lg px-3 py-2" required>{{ $pengumuman->isi }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Gambar</label>
                @if($pengumuman->gambar)
                    <div class="mb-2">
                        <img src="{{ Storage::url($pengumuman->gambar) }}" class="h-16 w-16 object-cover rounded">
                    </div>
                @endif
                <input type="file" name="gambar" class="w-full border rounded-lg px-3 py-2" accept="image/*">
            </div>
            <div class="flex justify-end gap-2 pt-4">
                <a href="{{ route('admin.pengumuman.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection