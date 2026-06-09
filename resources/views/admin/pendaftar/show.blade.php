@extends('layouts.admin')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="card-modern p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Detail Pendaftar</h2>
        <a href="{{ route('admin.pendaftar.index') }}" class="text-gray-600 hover:text-gray-800"><i class="fas fa-arrow-left mr-1"></i>Kembali</a>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <p><strong>No Pendaftaran:</strong> {{ $pendaftar->registration_number }}</p>
            <p><strong>Nama Lengkap:</strong> {{ $pendaftar->full_name }}</p>
            <p><strong>NIK:</strong> {{ $pendaftar->nik }}</p>
            <p><strong>Tempat, Tgl Lahir:</strong> {{ $pendaftar->place_of_birth }}, {{ \Carbon\Carbon::parse($pendaftar->date_of_birth)->format('d/m/Y') }}</p>
            <p><strong>Alamat:</strong> {{ $pendaftar->address }}</p>
            <p><strong>Asal Sekolah:</strong> {{ $pendaftar->previous_school }}</p>
            <p><strong>Jurusan Pilihan:</strong> {{ $pendaftar->major_choice }}</p>
        </div>
        <div>
            <p><strong>Status:</strong> 
                <span class="px-2 py-1 rounded-full text-xs 
                    @if($pendaftar->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($pendaftar->status == 'approved') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ ucfirst($pendaftar->status) }}
                </span>
            </p>
            <p><strong>Catatan Admin:</strong> {{ $pendaftar->admin_note ?? '-' }}</p>
            <p><strong>Tanggal Daftar:</strong> {{ $pendaftar->created_at->format('d/m/Y H:i') }}</p>
            <hr class="my-3">
            <p class="font-semibold">Berkas:</p>
            @php
                $files = ['ijazah', 'rapor', 'kk', 'foto'];
            @endphp
            @foreach($files as $file)
                @if($pendaftar->$file)
                    <a href="{{ Storage::url($pendaftar->$file) }}" target="_blank" class="text-blue-600 block"><i class="fas fa-file-pdf"></i> Lihat {{ ucfirst($file) }}</a>
                @else
                    <span class="text-gray-400">{{ ucfirst($file) }} belum diupload</span><br>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Update Status -->
    <div class="mt-8 border-t pt-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Update Status Penerimaan</h3>
        <form action="{{ route('admin.pendaftar.updateStatus', $pendaftar) }}" method="POST" class="flex flex-wrap gap-4 items-end">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="border rounded-lg px-3 py-2">
                    <option value="pending" {{ $pendaftar->status == 'pending' ? 'selected' : '' }}>Pending (Belum Diputuskan)</option>
                    <option value="approved" {{ $pendaftar->status == 'approved' ? 'selected' : '' }}>Diterima</option>
                    <option value="rejected" {{ $pendaftar->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700">Catatan (opsional)</label>
                <input type="text" name="admin_note" value="{{ $pendaftar->admin_note }}" class="w-full border rounded-lg px-3 py-2" placeholder="Alasan diterima/ditolak">
            </div>
            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Simpan Status</button>
            </div>
        </form>
    </div>
</div>
@endsection