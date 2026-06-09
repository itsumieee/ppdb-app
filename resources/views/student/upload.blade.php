@extends('layouts.app')

@section('title', 'Upload Berkas Pendaftaran')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-500 pl-3 mb-6">
            Upload Berkas Pendaftaran
        </h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
            <p class="text-blue-800"><strong>Petunjuk:</strong> Upload dokumen dalam format JPG, PNG, atau PDF (max 2MB per file)</p>
        </div>

        @if($registration)
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Foto 4x6 -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Foto 4x6</h3>
                    @if($registration->foto)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $registration->foto) }}" alt="Foto" class="w-full h-auto rounded-lg border">
                        </div>
                        <form action="{{ route('student.upload.delete', 'foto') }}" method="POST" class="mb-4">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                                Hapus Foto
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('student.upload.file', 'foto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" accept=".jpg,.jpeg,.png,.pdf" required class="block w-full mb-3 text-sm text-gray-700 border rounded-lg">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                            {{ $registration->foto ? 'Ganti' : 'Upload' }} Foto
                        </button>
                    </form>
                    @error('file') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Kartu Keluarga -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Kartu Keluarga</h3>
                    @if($registration->kk)
                        <div class="mb-4">
                            <a href="{{ asset('storage/' . $registration->kk) }}" target="_blank" class="text-blue-600 hover:underline">
                                📄 Lihat File
                            </a>
                        </div>
                        <form action="{{ route('student.upload.delete', 'kk') }}" method="POST" class="mb-4">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                                Hapus File
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('student.upload.file', 'kk') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" accept=".jpg,.jpeg,.png,.pdf" required class="block w-full mb-3 text-sm text-gray-700 border rounded-lg">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                            {{ $registration->kk ? 'Ganti' : 'Upload' }} KK
                        </button>
                    </form>
                </div>

                <!-- Akta Kelahiran -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Akta Kelahiran</h3>
                    @if($registration->akta)
                        <div class="mb-4">
                            <a href="{{ asset('storage/' . $registration->akta) }}" target="_blank" class="text-blue-600 hover:underline">
                                📄 Lihat File
                            </a>
                        </div>
                        <form action="{{ route('student.upload.delete', 'akta') }}" method="POST" class="mb-4">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                                Hapus File
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('student.upload.file', 'akta') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" accept=".jpg,.jpeg,.png,.pdf" required class="block w-full mb-3 text-sm text-gray-700 border rounded-lg">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                            {{ $registration->akta ? 'Ganti' : 'Upload' }} Akta
                        </button>
                    </form>
                </div>

                <!-- Rapor -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Rapor Terbaru</h3>
                    @if($registration->rapor)
                        <div class="mb-4">
                            <a href="{{ asset('storage/' . $registration->rapor) }}" target="_blank" class="text-blue-600 hover:underline">
                                📄 Lihat File
                            </a>
                        </div>
                        <form action="{{ route('student.upload.delete', 'rapor') }}" method="POST" class="mb-4">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                                Hapus File
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('student.upload.file', 'rapor') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" accept=".jpg,.jpeg,.png,.pdf" required class="block w-full mb-3 text-sm text-gray-700 border rounded-lg">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                            {{ $registration->rapor ? 'Ganti' : 'Upload' }} Rapor
                        </button>
                    </form>
                </div>

                <!-- Surat Lulus -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Surat Lulus</h3>
                    @if($registration->surat_lulus)
                        <div class="mb-4">
                            <a href="{{ asset('storage/' . $registration->surat_lulus) }}" target="_blank" class="text-blue-600 hover:underline">
                                📄 Lihat File
                            </a>
                        </div>
                        <form action="{{ route('student.upload.delete', 'surat_lulus') }}" method="POST" class="mb-4">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                                Hapus File
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('student.upload.file', 'surat_lulus') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" accept=".jpg,.jpeg,.png,.pdf" required class="block w-full mb-3 text-sm text-gray-700 border rounded-lg">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                            {{ $registration->surat_lulus ? 'Ganti' : 'Upload' }} Surat
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8 flex gap-4">
                <a href="{{ route('student.status') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition font-semibold">
                    ✓ Lihat Status Pendaftaran
                </a>
                <a href="{{ route('student.beranda') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition font-semibold">
                    ← Kembali ke Beranda
                </a>
            </div>
        @else
            <div class="bg-white rounded-xl shadow p-8 text-center">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Silakan daftar terlebih dahulu</h3>
                <p class="text-gray-600 mb-6">Anda perlu melengkapi formulir pendaftaran sebelum dapat upload berkas.</p>
                <a href="{{ route('student.register') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                    📝 Buat Pendaftaran
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
