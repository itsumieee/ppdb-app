@extends('layouts.admin')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-8 max-w-2xl w-full transition-all duration-300 hover:shadow-3d transform hover:-translate-y-1">
        <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                <i class="fas fa-calendar-plus text-white text-sm"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Tambah Jadwal Baru</h2>
        </div>

        <form action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kegiatan <span class="text-red-500">*</span></label>
                <input type="text" name="nama_kegiatan" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Mulai <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_mulai" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Selesai <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_selesai" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Keterangan</label>
                <textarea name="keterangan" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" placeholder="Deskripsi singkat..."></textarea>
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.jadwal.index') }}" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl text-sm font-medium transition shadow-md">Batal</a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</div>
@endsection