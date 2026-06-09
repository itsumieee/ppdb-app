@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="bg-gradient-to-br from-gray-50 via-white to-blue-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Header 3D -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white shadow-xl transition-all duration-300 hover:shadow-2xl">
            <div class="relative z-10">
                <h2 class="text-2xl md:text-3xl font-bold flex items-center gap-2">
                    <i class="fas fa-user-circle"></i> Profil Saya
                </h2>
                <p class="text-blue-100 mt-2">Kelola data akun dan informasi pendaftaran Anda</p>
            </div>
            <div class="absolute bottom-0 right-0 opacity-10">
                <i class="fas fa-id-card text-7xl"></i>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm flex items-center gap-3">
                <i class="fas fa-check-circle text-green-500"></i> {{ session('success') }}
            </div>
        @endif

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Informasi Akun + Ubah Password -->
            <div class="md:col-span-2 space-y-6">
                <!-- Edit Profil Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-3 mb-5">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                            <i class="fas fa-user-edit text-white text-sm"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Informasi Akun</h3>
                    </div>
                    <form action="{{ route('student.profile.update') }}" method="POST" class="space-y-5">
                        @csrf @method('PUT')
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="pt-3">
                            <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-semibold">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Ubah Password Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-3 mb-5">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-pink-600 rounded-xl flex items-center justify-center shadow-md">
                            <i class="fas fa-lock text-white text-sm"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Ubah Password</h3>
                    </div>
                    <form action="{{ route('student.profile.password') }}" method="POST" class="space-y-5">
                        @csrf @method('PUT')
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Password Saat Ini</label>
                            <input type="password" name="current_password" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                            @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Password Baru</label>
                            <input type="password" name="password" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm">
                        </div>
                        <div class="pt-3">
                            <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white px-6 py-2.5 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-semibold">
                                <i class="fas fa-key"></i> Ganti Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Kolom Kanan: Informasi Pendaftaran Card -->
            <div>
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 sticky top-24">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-xl flex items-center justify-center shadow-md">
                            <i class="fas fa-clipboard-list text-white text-sm"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Pendaftaran</h3>
                    </div>
                    @if($registration)
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Status</p>
                                @if($registration->status == 'pending')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800 shadow-sm">
                                        <i class="fas fa-clock"></i> Menunggu Verifikasi
                                    </span>
                                @elseif($registration->status == 'approved')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800 shadow-sm">
                                        <i class="fas fa-check-circle"></i> Diterima
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800 shadow-sm">
                                        <i class="fas fa-times-circle"></i> Ditolak
                                    </span>
                                @endif
                            </div>
                            <div class="border-t border-gray-100 pt-3">
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Nomor Pendaftaran</p>
                                <p class="font-mono text-sm font-semibold text-gray-800 break-all">{{ $registration->registration_number }}</p>
                            </div>
                            <div class="border-t border-gray-100 pt-3">
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Jurusan Pilihan</p>
                                <p class="font-medium text-gray-700">{{ $registration->major_choice }}</p>
                            </div>
                            <div class="border-t border-gray-100 pt-3">
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Tanggal Daftar</p>
                                <p class="text-sm text-gray-600">{{ $registration->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <!-- Tombol aksi cepat -->
                            <div class="pt-4 flex flex-col gap-2">
                                <a href="{{ route('student.status') }}" class="text-center text-sm bg-blue-50 hover:bg-blue-100 text-blue-700 py-2 rounded-lg transition font-medium">
                                    Lihat Status Lengkap →
                                </a>
                                <a href="{{ route('student.upload.index') }}" class="text-center text-sm bg-gray-50 hover:bg-gray-100 text-gray-700 py-2 rounded-lg transition">
                                    Kelola Berkas
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <i class="fas fa-inbox text-4xl text-gray-300 mb-2 block"></i>
                            <p class="text-gray-500 mb-4">Anda belum mendaftar</p>
                            <a href="{{ route('student.register') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-4 py-2 rounded-lg shadow-md transition">
                                <i class="fas fa-pen-alt"></i> Daftar Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tombol kembali ke beranda 3D -->
        <div class="mt-6">
            <a href="{{ route('student.beranda') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-6 py-3 rounded-xl shadow-md transition transform hover:-translate-y-0.5 hover:shadow-lg font-semibold">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection