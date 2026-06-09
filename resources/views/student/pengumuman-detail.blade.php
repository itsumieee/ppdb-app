@extends('layouts.app')

@section('title', $pengumuman->judul)

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow p-8">
            <div class="mb-6 pb-6 border-b">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $pengumuman->judul }}</h1>
                <p class="text-gray-500 text-sm">
                    Dipublikasikan pada {{ $pengumuman->created_at->format('d F Y H:i') }}
                </p>
            </div>

            <div class="prose prose-sm max-w-none mb-8">
                {!! nl2br(e($pengumuman->isi)) !!}
            </div>

            <div class="flex gap-4">
                <a href="{{ route('student.pengumuman') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                    ← Kembali ke Pengumuman
                </a>
                <a href="{{ route('student.beranda') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition font-semibold">
                    Ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
