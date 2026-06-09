@extends('layouts.admin')

@section('title', 'Akun Saya')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="max-w-4xl w-full space-y-8">
        <!-- Header -->
        <div class="flex items-center gap-3 border-b border-gray-200 pb-4">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                <i class="fas fa-user-circle text-white text-lg"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Akun Saya</h2>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded-xl shadow-sm flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Card Edit Profil (3D) -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex items-center gap-2 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-edit text-white text-xs"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Edit Profil</h3>
            </div>
            <form action="{{ route('admin.akun.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <div class="grid md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 flex items-center gap-2">
                        <i class="fas fa-save"></i> Simpan Profil
                    </button>
                </div>
            </form>
        </div>

        <!-- Card Ganti Password (3D) -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            <div class="flex items-center gap-2 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-red-400 to-red-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-lock text-white text-xs"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800">Ganti Password</h3>
            </div>
            <form action="{{ route('admin.akun.password') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Password Saat Ini</label>
                    <input type="password" name="current_password" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
                    @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Password Baru</label>
                    <input type="password" name="password" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-blue-400 transition shadow-sm" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 py-2.5 rounded-xl text-sm font-medium shadow-md transition transform hover:scale-105 flex items-center gap-2">
                        <i class="fas fa-key"></i> Ganti Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection