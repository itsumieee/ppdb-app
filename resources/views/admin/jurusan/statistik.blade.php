@extends('layouts.admin')

@section('title', 'Statistik Pendaftar per Jurusan')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Statistik Pendaftar per Jurusan</h2>
            <p class="text-gray-500 text-sm mt-1">Persentase peminat berdasarkan kuota yang tersedia</p>
        </div>
        <div class="text-sm text-gray-400 bg-gray-100 px-4 py-2 rounded-full inline-flex items-center gap-2 shadow-inner">
            <i class="fas fa-chart-line text-blue-500"></i> <span>Total pendaftar: {{ $statistik->sum('registrations_count') }}</span>
        </div>
    </div>

    <!-- Grid Cards dengan efek 3D -->
    <div class="grid md:grid-cols-2 gap-6">
        @foreach($statistik as $s)
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-5 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 transform group">
            <!-- Header card -->
            <div class="flex justify-between items-start mb-3">
                <div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-md">
                            <i class="fas fa-graduation-cap text-white text-xs"></i>
                        </div>
                        <h3 class="font-bold text-xl text-gray-800">{{ $s->nama }}</h3>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Kode: {{ $s->kode }}</p>
                </div>
                <div class="bg-gray-100 rounded-full px-3 py-1 shadow-inner">
                    <span class="text-sm font-semibold text-gray-700">{{ $s->registrations_count }} / {{ $s->kuota }}</span>
                </div>
            </div>

            <!-- Progress Bar 3D -->
            <div class="mt-4">
                @php $percent = ($s->kuota > 0) ? ($s->registrations_count / $s->kuota) * 100 : 0; @endphp
                <div class="flex justify-between text-xs text-gray-500 mb-1">
                    <span>Persentase peminat</span>
                    <span class="font-medium text-blue-600">{{ round($percent) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden shadow-inner">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-3 rounded-full transition-all duration-700 ease-out shadow-md" style="width: {{ min($percent,100) }}%"></div>
                </div>
            </div>

            <!-- Info tambahan -->
            <div class="mt-4 flex justify-between items-center text-xs text-gray-500 border-t border-gray-100 pt-3">
                <span><i class="fas fa-users text-blue-400 mr-1"></i> Peminat: {{ $s->registrations_count }} siswa</span>
                <span><i class="fas fa-ticket-alt text-blue-400 mr-1"></i> Sisa kuota: {{ max($s->kuota - $s->registrations_count, 0) }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Catatan jika tidak ada data -->
    @if($statistik->isEmpty())
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
        <i class="fas fa-chart-simple text-5xl text-gray-300 mb-3 block"></i>
        <p class="text-gray-400">Belum ada data jurusan atau pendaftar.</p>
    </div>
    @endif
</div>
@endsection