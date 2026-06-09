@extends('layouts.admin')

@section('title', 'Jadwal PPDB')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Jadwal PPDB</h2>
            <p class="text-gray-500 text-sm mt-1">Kelola agenda kegiatan Penerimaan Peserta Didik Baru</p>
        </div>
        <a href="{{ route('admin.jadwal.create') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 inline-flex items-center gap-2">
            <i class="fas fa-plus-circle"></i> Tambah Jadwal
        </a>
    </div>

    <!-- Tabel dengan efek 3D -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Kegiatan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($jadwal as $j)
                    <tr class="group transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-white hover:shadow-inner transform hover:scale-[1.01]">
                        <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $j->nama_kegiatan }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($j->tanggal_mulai)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($j->tanggal_selesai)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $j->keterangan ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('admin.jadwal.edit', $j) }}" class="text-yellow-500 hover:text-yellow-700 transition transform hover:scale-110" title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>
                                <form action="{{ route('admin.jadwal.destroy', $j) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus jadwal ini?')">
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
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <i class="fas fa-calendar-times text-5xl mb-3 block"></i>
                            Belum ada jadwal PPDB. Klik tombol "Tambah Jadwal".
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination dengan efek inset -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 shadow-inner">
            {{ $jadwal->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection