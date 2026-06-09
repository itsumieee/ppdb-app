@extends('layouts.admin')

@section('title', 'Verifikasi Berkas - ' . $registration->full_name)

@section('content')
<div class="card-modern p-6 max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Verifikasi Berkas: {{ $registration->full_name }}</h2>
        <a href="{{ route('admin.verifikasi.index') }}" class="text-gray-600 hover:text-gray-800"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
    </div>

    <!-- Informasi Pendaftar -->
    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <div>
            <p><strong>No Pendaftaran:</strong> {{ $registration->registration_number }}</p>
            <p><strong>NIK:</strong> {{ $registration->nik }}</p>
            <p><strong>Jurusan Pilihan:</strong> {{ $registration->major_choice }}</p>
        </div>
        <div>
            <p><strong>Status Verifikasi Berkas:</strong>
                @if($registration->berkas_verified)
                    <span class="text-green-600 font-semibold">Terverifikasi</span>
                @else
                    <span class="text-yellow-600 font-semibold">Belum Verifikasi</span>
                @endif
            </p>
            @if($registration->catatan_verifikasi)
                <p><strong>Catatan Terakhir:</strong> {{ $registration->catatan_verifikasi }}</p>
            @endif
        </div>
    </div>

    <!-- Daftar Berkas -->
    <h3 class="text-lg font-bold mb-3">📎 Berkas yang Diunggah</h3>
    <div class="grid sm:grid-cols-2 gap-4 mb-8">
        @php $files = ['ijazah' => 'Ijazah', 'rapor' => 'Rapor', 'kk' => 'Kartu Keluarga', 'foto' => 'Foto']; @endphp
        @foreach($files as $field => $label)
        <div class="border rounded-lg p-3 bg-gray-50">
            <p class="font-semibold">{{ $label }}</p>
            @if($registration->$field)
                <a href="{{ Storage::url($registration->$field) }}" target="_blank" class="text-blue-600 text-sm"><i class="fas fa-file-pdf mr-1"></i> Lihat Berkas</a>
            @else
                <span class="text-gray-400 text-sm">Belum diunggah</span>
            @endif
        </div>
        @endforeach
    </div>

    <!-- Form Verifikasi -->
    <div class="border-t pt-6">
        <h3 class="text-lg font-bold mb-4">🛡️ Verifikasi Berkas</h3>
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Form Terima -->
            <form action="{{ route('admin.verifikasi.verify', $registration) }}" method="POST" class="bg-green-50 p-4 rounded-xl">
                @csrf
                <h4 class="font-semibold text-green-700 mb-2"><i class="fas fa-check-circle"></i> Terima Berkas</h4>
                <textarea name="catatan" rows="2" class="w-full border rounded-lg px-3 py-2 text-sm" placeholder="Catatan (opsional)"></textarea>
                <button type="submit" class="mt-3 bg-green-600 text-white px-4 py-2 rounded-lg w-full hover:bg-green-700">Verifikasi & Terima</button>
            </form>

            <!-- Form Tolak -->
            <form action="{{ route('admin.verifikasi.reject', $registration) }}" method="POST" class="bg-red-50 p-4 rounded-xl">
                @csrf
                <h4 class="font-semibold text-red-700 mb-2"><i class="fas fa-times-circle"></i> Tolak Berkas</h4>
                <textarea name="catatan" rows="2" class="w-full border rounded-lg px-3 py-2 text-sm" placeholder="Alasan penolakan (wajib)" required></textarea>
                <button type="submit" class="mt-3 bg-red-600 text-white px-4 py-2 rounded-lg w-full hover:bg-red-700">Tolak & Beri Catatan</button>
            </form>
        </div>
    </div>

    <!-- Riwayat Verifikasi -->
    @php
        $riwayat = \App\Models\VerifikasiBerkas::where('registration_id', $registration->id)->with('admin')->latest()->get();
    @endphp
    @if($riwayat->count())
    <div class="border-t mt-6 pt-6">
        <h3 class="text-lg font-bold mb-3">📜 Riwayat Verifikasi</h3>
        <div class="space-y-2">
            @foreach($riwayat as $rv)
            <div class="bg-gray-50 p-3 rounded-lg text-sm">
                <div class="flex justify-between">
                    <span class="font-semibold {{ $rv->status == 'verified' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $rv->status == 'verified' ? '✓ Diverifikasi' : '✗ Ditolak' }}
                    </span>
                    <span class="text-gray-500">{{ $rv->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <p>Oleh: {{ $rv->admin->name }}</p>
                @if($rv->catatan)<p class="text-gray-600 mt-1">Catatan: {{ $rv->catatan }}</p>@endif
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection