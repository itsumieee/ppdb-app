<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\VerifikasiBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VerifikasiController extends Controller
{
    // Menampilkan daftar pendaftar yang belum diverifikasi berkasnya
    public function index(Request $request)
    {
        $query = Registration::with('user')
            ->where('berkas_verified', false)
            ->orWhereNull('berkas_verified');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('registration_number', 'like', '%' . $request->search . '%');
            });
        }

        $pendaftar = $query->latest()->paginate(15);
        return view('admin.verifikasi.index', compact('pendaftar'));
    }

    // Menampilkan detail berkas untuk verifikasi
    public function show(Registration $registration)
    {
        return view('admin.verifikasi.show', compact('registration'));
    }

    // Proses verifikasi berkas (diterima)
    public function verify(Request $request, Registration $registration)
    {
        $request->validate([
            'catatan' => 'nullable|string'
        ]);

        // Update status verifikasi
        $registration->update([
            'berkas_verified' => true,
            'catatan_verifikasi' => $request->catatan
        ]);

        // Simpan riwayat verifikasi
        \App\Models\VerifikasiBerkas::create([
            'registration_id' => $registration->id,
            'admin_id' => Auth::id(),
            'status' => 'verified',
            'catatan' => $request->catatan
        ]);

        return redirect()->route('admin.verifikasi.index')
            ->with('success', 'Berkas berhasil diverifikasi.');
    }

    // Proses tolak berkas
    public function reject(Request $request, Registration $registration)
    {
        $request->validate([
            'catatan' => 'required|string|min:5'
        ]);

        $registration->update([
            'berkas_verified' => false,
            'catatan_verifikasi' => $request->catatan
        ]);

        VerifikasiBerkas::create([
            'registration_id' => $registration->id,
            'admin_id' => Auth::id(),
            'status' => 'rejected',
            'catatan' => $request->catatan
        ]);

        return redirect()->route('admin.verifikasi.index')
            ->with('error', 'Berkas ditolak. Catatan sudah dikirim ke siswa.');
    }

    // Riwayat verifikasi berkas
    public function riwayat(Registration $registration)
    {
        $riwayat = VerifikasiBerkas::where('registration_id', $registration->id)
            ->with('admin')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.verifikasi.riwayat', compact('registration', 'riwayat'));
    }
}