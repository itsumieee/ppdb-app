@extends('layouts.admin')

@section('title', 'Laporan PPDB')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Laporan & Export Data</h2>
            <p class="text-gray-500 text-sm mt-1">Analisis dan ekspor data pendaftaran PPDB</p>
        </div>
    </div>

    <!-- Statistik Cards (3D efek) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl shadow-lg border-l-4 border-blue-500 p-5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Pendaftar</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalPendaftar ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center shadow-inner">
                    <i class="fas fa-users text-blue-600 text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg border-l-4 border-green-500 p-5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Diterima</p>
                    <p class="text-3xl font-bold text-green-600">{{ $totalDiterima ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center shadow-inner">
                    <i class="fas fa-check-circle text-green-600 text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg border-l-4 border-red-500 p-5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Ditolak</p>
                    <p class="text-3xl font-bold text-red-600">{{ $totalDitolak ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center shadow-inner">
                    <i class="fas fa-times-circle text-red-600 text-lg"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg border-l-4 border-yellow-500 p-5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Pending</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $totalPending ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center shadow-inner">
                    <i class="fas fa-hourglass-half text-yellow-600 text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card 3D -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-0.5">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-sliders-h text-blue-500"></i> Filter Data
        </h3>
        <form method="GET" action="{{ route('admin.laporan.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-5 items-end">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">📚 Jurusan</label>
                <select name="jurusan" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                    <option value="">Semua Jurusan</option>
                    @foreach($jurusanList ?? [] as $j)
                        <option value="{{ $j->kode }}" {{ request('jurusan') == $j->kode ? 'selected' : '' }}>{{ $j->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">📌 Status</label>
                <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Diterima</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">📅 Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">📅 Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 inline-flex items-center gap-2">
                    <i class="fas fa-search"></i> Tampilkan
                </button>
                <a href="{{ route('admin.laporan.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-medium transition shadow-md inline-flex items-center gap-2">
                    <i class="fas fa-undo-alt"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Tombol Export (3D) -->
    <div class="flex flex-wrap gap-4">
        <a href="{{ route('admin.laporan.export_pdf', request()->query()) }}" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 inline-flex items-center gap-2">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <a href="{{ route('admin.laporan.export_excel', request()->query()) }}" class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 inline-flex items-center gap-2">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <a href="{{ route('admin.laporan.print', request()->query()) }}" target="_blank" class="bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 inline-flex items-center gap-2">
            <i class="fas fa-print"></i> Cetak Laporan
        </a>
    </div>

    <!-- Statistik per Jurusan (3D card) -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 transition-all duration-300 hover:shadow-2xl">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-chart-pie text-blue-500"></i> Statistik Pendaftar per Jurusan
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 rounded-xl">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jurusan</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kuota</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Pendaftar</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jurusanStats ?? [] as $js)
                    <tr class="border-t border-gray-100 hover:bg-blue-50/30 transition">
                        <td class="px-5 py-3 font-medium text-gray-800">{{ $js->nama }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $js->kuota }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $js->registrations_count }}</td>
                        <td class="px-5 py-3">
                            @php $percent = ($js->kuota > 0) ? ($js->registrations_count / $js->kuota) * 100 : 0; @endphp
                            <div class="flex items-center gap-3">
                                <div class="flex-1 bg-gray-200 rounded-full h-2.5 shadow-inner">
                                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2.5 rounded-full transition-all" style="width: {{ min($percent,100) }}%"></div>
                                </div>
                                <span class="text-xs font-medium text-gray-700 w-12">{{ round($percent) }}%</span>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="border-t"><td colspan="4" class="px-5 py-8 text-center text-gray-400">Belum ada data jurusan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Data Pendaftar (3D) -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-table-list text-blue-500"></i> Daftar Pendaftar
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">No Pendaftaran</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">NIK</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jurusan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tgl Daftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pendaftar ?? [] as $p)
                    <tr class="hover:bg-blue-50/30 transition transform hover:scale-[1.01] hover:shadow-inner">
                        <td class="px-6 py-3 font-mono text-gray-700">{{ $p->registration_number }}</td>
                        <td class="px-6 py-3 font-medium text-gray-800">{{ $p->full_name }}</td>
                        <td class="px-6 py-3 text-gray-600">{{ $p->nik }}</td>
                        <td class="px-6 py-3 text-gray-600">{{ $p->major_choice }}</td>
                        <td class="px-6 py-3">
                            @if($p->status == 'pending')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"><i class="fas fa-clock"></i> Pending</span>
                            @elseif($p->status == 'approved')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800"><i class="fas fa-check-circle"></i> Diterima</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800"><i class="fas fa-times-circle"></i> Ditolak</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-gray-600">{{ $p->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <i class="fas fa-inbox text-5xl mb-2 block"></i>
                            Tidak ada data pendaftar
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(($pendaftar ?? collect())->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30 shadow-inner">
            {{ ($pendaftar ?? collect())->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection