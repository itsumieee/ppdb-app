<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Pendaftaran: {{ $registration->full_name }}
            </h2>
            <a href="{{ route('admin.registrations') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informasi Pendaftar -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3">Data Pribadi</h3>
                            <dl class="grid grid-cols-1 gap-2">
                                <div><dt class="font-medium">No Pendaftaran:</dt><dd>{{ $registration->registration_number }}</dd></div>
                                <div><dt class="font-medium">Nama Lengkap:</dt><dd>{{ $registration->full_name }}</dd></div>
                                <div><dt class="font-medium">NIK:</dt><dd>{{ $registration->nik }}</dd></div>
                                <div><dt class="font-medium">Tempat, Tanggal Lahir:</dt><dd>{{ $registration->place_of_birth }}, {{ \Carbon\Carbon::parse($registration->date_of_birth)->format('d/m/Y') }}</dd></div>
                                <div><dt class="font-medium">Alamat:</dt><dd>{{ $registration->address }}</dd></div>
                                <div><dt class="font-medium">Asal Sekolah:</dt><dd>{{ $registration->previous_school }}</dd></div>
                                <div><dt class="font-medium">Jurusan Pilihan:</dt><dd>{{ $registration->major_choice }}</dd></div>
                                <div><dt class="font-medium">Status:</dt>
                                    <dd>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($registration->status == 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($registration->status == 'approved') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($registration->status) }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Form Update Status -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-3">Update Status Pendaftaran</h3>
                            <form action="{{ route('admin.registration.status', $registration) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="pending" {{ $registration->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $registration->status == 'approved' ? 'selected' : '' }}>Diterima</option>
                                        <option value="rejected" {{ $registration->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="admin_note" class="block text-sm font-medium text-gray-700">Catatan (opsional)</label>
                                    <textarea name="admin_note" id="admin_note" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $registration->admin_note }}</textarea>
                                </div>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>