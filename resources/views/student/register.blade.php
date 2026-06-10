@extends('layouts.app')

@section('title', 'Formulir Pendaftaran')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-2xl font-bold mb-6">Formulir Pendaftaran PPDB</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ auth()->check() ? route('student.store.register') : route('student.register.store') }}" method="POST">
            @csrf
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Nama Lengkap</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">NISN</label>
                    <input type="text" name="nisn" value="{{ old('nisn') }}" class="w-full border rounded-lg px-3 py-2" maxlength="10" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" class="w-full border rounded-lg px-3 py-2" maxlength="16" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Tempat Lahir</label>
                    <input type="text" name="place_of_birth" value="{{ old('place_of_birth') }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Jenis Kelamin</label>
                    <select name="gender" class="w-full border rounded-lg px-3 py-2" required>
                        <option value="">Pilih</option>
                        <option value="L" {{ old('gender')=='L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('gender')=='P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Agama</label>
                    <select name="religion" class="w-full border rounded-lg px-3 py-2" required>
                        <option value="">Pilih</option>
                        <option>Islam</option><option>Kristen</option><option>Katolik</option><option>Hindu</option><option>Buddha</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium">Alamat</label>
                    <textarea name="address" rows="2" class="w-full border rounded-lg px-3 py-2" required>{{ old('address') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">No HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Asal Sekolah</label>
                    <input type="text" name="previous_school" value="{{ old('previous_school') }}" class="w-full border rounded-lg px-3 py-2" required>
                </div>
                <div>
                     <label class="block text-sm font-medium">Jurusan Pilihan</label>
                     <select name="major_choice" class="w-full border rounded-lg px-3 py-2" required>
                         <option value="">-- Pilih Jurusan --</option>
                         @foreach($jurusan as $j)
                             <option value="{{ $j->kode }}" {{ old('major_choice') == $j->kode ? 'selected' : '' }}>{{ $j->nama }}</option>
                         @endforeach
                     </select>
                 </div>
                 @if(!auth()->check())
                 <div>
                     <label class="block text-sm font-medium">Password *</label>
                     <input type="password" name="password" class="w-full border rounded-lg px-3 py-2" minlength="8" required>
                     <small class="text-gray-500">Minimal 8 karakter</small>
                 </div>
                 <div>
                     <label class="block text-sm font-medium">Konfirmasi Password *</label>
                     <input type="password" name="password_confirmation" class="w-full border rounded-lg px-3 py-2" minlength="8" required>
                 </div>
                 @endif
            </div>
            <div class="mt-6 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Simpan & Lanjut Upload</button>
            </div>
        </form>
    </div>
</div>
@endsection