@extends('layouts.admin')

@section('title', 'Manajemen Pengumuman')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Manajemen Pengumuman</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola pengumuman untuk siswa dan publik</p>
        </div>
        <a href="{{ route('admin.pengumuman.create') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 inline-flex items-center gap-2">
            <i class="fas fa-plus-circle"></i> Tambah Pengumuman
        </a>
    </div>

    <!-- Tabel dengan efek 3D -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($pengumuman as $p)
                    <tr class="group transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-white hover:shadow-inner transform hover:scale-[1.01]">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $p->judul }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $p->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4">
                            @if($p->is_published)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 shadow-sm">
                                    <i class="fas fa-globe"></i> Dipublikasi
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500 shadow-sm">
                                    <i class="fas fa-pen-fancy"></i> Draft
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <form action="{{ route('admin.pengumuman.publish', $p) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="text-blue-500 hover:text-blue-700 transition transform hover:scale-110" title="{{ $p->is_published ? 'Sembunyikan' : 'Publikasikan' }}">
                                        <i class="fas {{ $p->is_published ? 'fa-eye-slash' : 'fa-eye' }} text-lg"></i>
                                    </button>
                                </form>
                                <a href="{{ route('admin.pengumuman.edit', $p) }}" class="text-yellow-500 hover:text-yellow-700 transition transform hover:scale-110" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <form action="{{ route('admin.pengumuman.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus pengumuman ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition transform hover:scale-110" title="Hapus">
                                        <i class="fas fa-trash-alt text-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                            <i class="fas fa-bullhorn text-5xl mb-3 block"></i>
                            Belum ada pengumuman. Klik "Tambah Pengumuman" untuk mulai.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination dengan efek inset -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 shadow-inner">
            {{ $pengumuman->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection