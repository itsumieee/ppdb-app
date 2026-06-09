<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::with('user');
        
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('registration_number', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('jurusan')) {
            $query->where('major_choice', $request->jurusan);
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $pendaftar = $query->latest()->paginate(15);
        $jurusanList = Jurusan::all();
        
        return view('admin.pendaftar.index', compact('pendaftar', 'jurusanList'));
    }

    public function show(Registration $pendaftar)
    {
        return view('admin.pendaftar.show', compact('pendaftar'));
    }

    public function edit(Registration $pendaftar)
    {
        $jurusanList = Jurusan::all();
        return view('admin.pendaftar.edit', compact('pendaftar', 'jurusanList'));
    }

    public function update(Request $request, Registration $pendaftar)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:registrations,nik,' . $pendaftar->id,
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'previous_school' => 'required|string',
            'major_choice' => 'required|string',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $pendaftar->update($request->all());
        return redirect()->route('admin.pendaftar.index')->with('success', 'Data pendaftar berhasil diupdate.');
    }

    public function destroy(Registration $pendaftar)
    {
        // Hapus file berkas jika ada
        if ($pendaftar->ijazah) Storage::delete($pendaftar->ijazah);
        if ($pendaftar->rapor) Storage::delete($pendaftar->rapor);
        if ($pendaftar->kk) Storage::delete($pendaftar->kk);
        if ($pendaftar->foto) Storage::delete($pendaftar->foto);
        
        $pendaftar->delete();
        return redirect()->route('admin.pendaftar.index')->with('success', 'Pendaftar berhasil dihapus.');
    }

    public function updateStatus(Request $request, Registration $pendaftar)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_note' => 'nullable|string'
        ]);

        $pendaftar->update([
            'status' => $request->status,
            'admin_note' => $request->admin_note
        ]);

        return redirect()->back()->with('success', 'Status penerimaan berhasil diperbarui.');
    }

    public function cetakFormulir(Registration $pendaftar)
    {
        // Implementasi PDF nanti (gunakan barryvdh/laravel-dompdf)
        return view('admin.pendaftar.cetak', compact('pendaftar'));
    }
}