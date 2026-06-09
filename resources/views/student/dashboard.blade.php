@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-500 pl-3 mb-6">
            Dashboard Siswa
        </h2>
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($registration)
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                            <h3 class="text-2xl font-bold mb-4">Status Pendaftaran Anda</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p><strong>Nomor Pendaftaran:</strong> {{ $registration->registration_number }}</p>
                                    <p><strong>Nama Lengkap:</strong> {{ $registration->full_name }}</p>
                                    <p><strong>Jurusan Pilihan:</strong> {{ $registration->major_choice }}</p>
                                </div>
                                <div>
                                    <p><strong>Status:</strong>
                                        @if($registration->status == 'pending')
                                            <span class="bg-yellow-500 text-white px-2 py-1 rounded">Menunggu Verifikasi</span>
                                        @elseif($registration->status == 'approved')
                                            <span class="bg-green-500 text-white px-2 py-1 rounded">Diterima</span>
                                        @else
                                            <span class="bg-red-500 text-white px-2 py-1 rounded">Ditolak</span>
                                        @endif
                                    </p>
                                    @if($registration->admin_note)
                                        <p><strong>Catatan Admin:</strong> {{ $registration->admin_note }}</p>
                                    @endif
                                    <p><strong>Tanggal Daftar:</strong> {{ $registration->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow p-6 text-center">
                            <h3 class="text-xl font-semibold mb-4">Anda belum melakukan pendaftaran</h3>
                            <a href="{{ route('student.register') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Daftar Sekarang
                            </a>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection