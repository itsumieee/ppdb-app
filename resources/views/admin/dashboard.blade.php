@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Welcome Banner (3D) -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white shadow-2xl transition-all duration-300 hover:shadow-3d hover:scale-[1.01]">
        <div class="relative z-10">
            <h1 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-blue-100 mt-1">Pantau perkembangan PPDB SMK ICB Cinta Teknika di sini.</p>
        </div>
        <div class="absolute top-0 right-0 opacity-10">
            <i class="fas fa-chalkboard-user text-8xl"></i>
        </div>
    </div>

    <!-- Stat Cards (3D Hover) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl shadow-lg border-l-4 border-blue-500 p-5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div><p class="text-gray-500 text-sm">Total Pendaftar</p><p class="text-3xl font-bold text-gray-800">{{ $totalPendaftar ?? 0 }}</p></div>
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center shadow-inner"><i class="fas fa-user-graduate text-blue-600 text-lg"></i></div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg border-l-4 border-green-500 p-5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div><p class="text-gray-500 text-sm">Diterima</p><p class="text-3xl font-bold text-green-600">{{ $totalDiterima ?? 0 }}</p></div>
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center shadow-inner"><i class="fas fa-check-circle text-green-600 text-lg"></i></div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg border-l-4 border-red-500 p-5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div><p class="text-gray-500 text-sm">Ditolak</p><p class="text-3xl font-bold text-red-600">{{ $totalDitolak ?? 0 }}</p></div>
                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center shadow-inner"><i class="fas fa-times-circle text-red-600 text-lg"></i></div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg border-l-4 border-purple-500 p-5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div><p class="text-gray-500 text-sm">Total Jurusan</p><p class="text-3xl font-bold text-purple-600">{{ $totalJurusan ?? 0 }}</p></div>
                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center shadow-inner"><i class="fas fa-book-open text-purple-600 text-lg"></i></div>
            </div>
        </div>
    </div>

    <!-- Grafik & Ringkasan (3D) -->
    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Grafik Pendaftaran -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl border border-gray-100 p-5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-0.5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-800">Grafik Pendaftaran {{ date('Y') }}</h3>
                <div class="flex gap-3 text-xs"><span class="flex items-center"><span class="w-3 h-3 bg-blue-500 rounded-full mr-1"></span>Total</span><span class="flex items-center"><span class="w-3 h-3 bg-green-500 rounded-full mr-1"></span>Diterima</span><span class="flex items-center"><span class="w-3 h-3 bg-red-500 rounded-full mr-1"></span>Ditolak</span></div>
            </div>
            <canvas id="dashboardChart" height="240"></canvas>
        </div>

        <!-- Pendaftar per Jurusan (Progress Bar 3D) -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-0.5">
            <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2"><i class="fas fa-chart-pie text-blue-500"></i> Pendaftar per Jurusan</h3>
            <div class="space-y-3">
                @forelse($jurusanStats ?? [] as $j)
                <div>
                    <div class="flex justify-between text-sm">
                        <span class="font-medium text-gray-700">{{ $j->nama }}</span>
                        <span class="text-gray-500">{{ $j->total }} / {{ $j->kuota }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1 shadow-inner">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2.5 rounded-full transition-all duration-700" style="width: {{ min(($j->total/$j->kuota)*100,100) }}%"></div>
                    </div>
                </div>
                @empty <p class="text-gray-400 text-center py-4">Belum ada data jurusan</p> @endforelse
            </div>
        </div>
    </div>

    <!-- Pendaftar Terbaru (Tabel 3D) -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <div class="px-6 pt-5 pb-3 flex flex-wrap justify-between items-center border-b border-gray-100">
            <h3 class="font-bold text-gray-800 flex items-center gap-2"><i class="fas fa-list-ul text-blue-500"></i> Pendaftar Terbaru</h3>
            <a href="{{ route('admin.pendaftar.index') }}" class="text-sm text-blue-600 hover:underline transition">Lihat semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">No Pendaftaran</th>
                        <th class="px-6 py-3 text-left font-semibold">Nama</th>
                        <th class="px-6 py-3 text-left font-semibold">Jurusan</th>
                        <th class="px-6 py-3 text-left font-semibold">Status</th>
                        <th class="px-6 py-3 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pendaftarTerbaru ?? [] as $p)
                    <tr class="hover:bg-blue-50/30 transition transform hover:scale-[1.01] hover:shadow-inner">
                        <td class="px-6 py-3 font-mono text-gray-700">{{ $p->registration_number }}</td>
                        <td class="px-6 py-3 font-medium text-gray-800">{{ $p->full_name }}</td>
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
                        <td class="px-6 py-3 text-center">
                            <a href="{{ route('admin.pendaftar.show', $p) }}" class="text-blue-600 hover:text-blue-800 transition transform hover:scale-110 inline-block" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400"><i class="fas fa-inbox text-4xl mb-2 block"></i>Belum ada pendaftar</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@php
    $labels = $months ?? ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
    $totalData = $counts ?? array_fill(0,12,0);
    $approvedData = $approvedCounts ?? array_fill(0,12,0);
    $rejectedData = $rejectedCounts ?? array_fill(0,12,0);
@endphp

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Chart(document.getElementById('dashboardChart'), {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [
                    { label: 'Total', data: @json($totalData), borderColor: '#3b82f6', backgroundColor: 'rgba(59,130,246,0.05)', tension: 0.3, fill: true, borderWidth: 2, pointRadius: 3 },
                    { label: 'Diterima', data: @json($approvedData), borderColor: '#10b981', backgroundColor: 'rgba(16,185,129,0.05)', tension: 0.3, fill: true, borderWidth: 2, pointRadius: 3 },
                    { label: 'Ditolak', data: @json($rejectedData), borderColor: '#ef4444', backgroundColor: 'rgba(239,68,68,0.05)', tension: 0.3, fill: true, borderWidth: 2, pointRadius: 3 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 10 } } },
                scales: { y: { beginAtZero: true, grid: { color: '#e5e7eb' }, title: { display: true, text: 'Jumlah Pendaftar' } }, x: { grid: { display: false }, title: { display: true, text: 'Bulan' } } }
            }
        });
    });
</script>
@endpush
@endsection