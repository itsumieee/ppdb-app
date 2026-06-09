@extends('layouts.admin')

@section('title', 'Verifikasi Berkas')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Verifikasi Berkas</h2>
            <p class="text-gray-500 text-sm mt-1">Periksa dan verifikasi kelengkapan dokumen pendaftar</p>
        </div>
        <div class="text-sm text-gray-400 bg-gray-100 px-4 py-2 rounded-full inline-flex items-center gap-2 shadow-inner">
            <i class="fas fa-shield-alt text-blue-500"></i> <span>Total perlu verifikasi: {{ $pendaftar->total() ?? 0 }}</span>
        </div>
    </div>

    <!-- Filter Card 3D -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-1">
        <form method="GET" action="{{ route('admin.verifikasi.index') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            <div class="md:col-span-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1"><i class="fas fa-search text-blue-500 mr-1"></i> Cari</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama / No Pendaftaran" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm font-semibold text-gray-700 mb-1"><i class="fas fa-filter"></i> Status</label>
                <select name="status_berkas" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 shadow-sm">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status_berkas') == 'pending' ? 'selected' : '' }}>Belum Verifikasi</option>
                    <option value="verified" {{ request('status_berkas') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="rejected" {{ request('status_berkas') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="md:col-span-4 flex gap-3">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 flex items-center gap-2">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <a href="{{ route('admin.verifikasi.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-md flex items-center gap-2">
                    <i class="fas fa-undo-alt"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Tabel 3D -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No Pendaftaran</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jurusan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status Verifikasi</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($pendaftar as $p)
                    <tr class="group transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50 hover:to-white hover:shadow-inner transform hover:scale-[1.01]">
                        <td class="px-6 py-4 text-sm font-mono text-gray-700">{{ $p->registration_number }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $p->full_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $p->major_choice }}</td>
                        <td class="px-6 py-4">
                            @if($p->berkas_verified)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 shadow-sm"><i class="fas fa-check-circle"></i> Terverifikasi</span>
                            @elseif($p->berkas_verified === false && $p->catatan_verifikasi)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 shadow-sm"><i class="fas fa-times-circle"></i> Ditolak</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 shadow-sm"><i class="fas fa-hourglass-half"></i> Belum Verifikasi</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.verifikasi.show', $p) }}" class="inline-flex items-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg text-sm font-medium transition shadow-sm hover:shadow transform hover:-translate-y-0.5">
                                <i class="fas fa-file-alt"></i> Lihat Berkas
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <i class="fas fa-folder-open text-5xl mb-3 block"></i>
                            Tidak ada pendaftar yang perlu diverifikasi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 shadow-inner">
            {{ $pendaftar->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection