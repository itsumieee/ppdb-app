@extends('layouts.admin')

@section('title', 'Manajemen Jurusan')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Manajemen Jurusan</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola data jurusan, kuota, dan status</p>
        </div>
        <a href="{{ route('admin.jurusan.create') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 inline-flex items-center gap-2">
            <i class="fas fa-plus-circle"></i> Tambah Jurusan
        </a>
    </div>

    <!-- Card Tabel (3D effect) -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Jurusan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kuota</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Pendaftar</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($jurusan as $j)
                    <tr class="group transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-white hover:shadow-inner transform hover:scale-[1.01]">
                        <td class="px-6 py-4 text-sm font-mono text-gray-700">{{ $j->kode }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $j->nama }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $j->kuota }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 shadow-sm">{{ $j->registrations_count }} pendaftar</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($j->is_active)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 shadow-sm"><i class="fas fa-check-circle"></i> Aktif</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700 shadow-sm"><i class="fas fa-ban"></i> Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('admin.jurusan.edit', $j) }}" class="text-yellow-600 hover:text-yellow-800 transition transform hover:scale-110 inline-block" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <form action="{{ route('admin.jurusan.destroy', $j) }}" method="POST" class="inline" onsubmit="return confirm('Hapus jurusan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition transform hover:scale-110" title="Hapus">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <i class="fas fa-folder-open text-5xl mb-3 block"></i>
                            Belum ada jurusan. Silakan tambah jurusan baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination dengan efek 3D inset -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 shadow-inner">
            {{ $jurusan->links() }}
        </div>
    </div>
</div>
@endsection