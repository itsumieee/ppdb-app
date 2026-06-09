<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Payment;
use App\Models\Jurusan;
use App\Models\Pengumuman;
use App\Models\JadwalPPDB;
use App\Models\Galeri;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    // ==================== BERANDA ====================
    public function index()
    {
        $pengumuman = Pengumuman::where('is_published', true)->latest()->take(5)->get();
        $jadwal = JadwalPPDB::orderBy('tanggal_mulai')->get();
        $galeri = Galeri::latest()->take(6)->get();
        $jurusan = Jurusan::where('is_active', true)->get();
        $profil = [];
        $keys = ['nama_sekolah', 'sejarah', 'visi_misi', 'alamat', 'kontak', 'email'];
        foreach ($keys as $key) {
            $profil[$key] = Pengaturan::where('key', $key)->value('value');
        }
        return view('student.beranda', compact('pengumuman', 'jadwal', 'galeri', 'jurusan', 'profil'));
    }

    // ==================== DASHBOARD SISWA ====================
    public function dashboard()
    {
        return redirect()->route('student.beranda');
    }

    // ==================== FORMULIR PENDAFTARAN ====================
    public function createRegistration()
    {
        if (Auth::user()->registration) {
            return redirect()->route('student.dashboard')->with('error', 'Anda sudah mendaftar.');
        }
        $jurusan = Jurusan::where('is_active', true)->get();
        return view('student.register', compact('jurusan'));
    }

    public function storeRegistration(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'nisn' => 'required|string|size:10|unique:registrations,nisn',
            'nik' => 'required|string|size:16|unique:registrations,nik',
            'place_of_birth' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:L,P',
            'religion' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'previous_school' => 'required|string',
            'major_choice' => 'required|exists:jurusan,kode',
        ]);

        $registrationNumber = 'PPDB-' . date('Ymd') . '-' . strtoupper(uniqid());

        $registration = Registration::create([
            'user_id' => Auth::id(),
            'registration_number' => $registrationNumber,
            'full_name' => $request->full_name,
            'nisn' => $request->nisn,
            'nik' => $request->nik,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'address' => $request->address,
            'phone' => $request->phone,
            'previous_school' => $request->previous_school,
            'major_choice' => $request->major_choice,
            'status' => 'pending',
        ]);

        return redirect()->route('student.upload.index')->with('success', 'Data pendaftaran berhasil. Silakan upload berkas.');
    }

    // ==================== UPLOAD BERKAS ====================
    public function uploadIndex()
    {
        $registration = Auth::user()->registration;
        if (!$registration) {
            return redirect()->route('student.register')->with('error', 'Silakan daftar terlebih dahulu.');
        }
        return view('student.upload', compact('registration'));
    }

    public function uploadFile(Request $request, $type)
    {
        $registration = Auth::user()->registration;
        $allowedTypes = ['foto', 'kk', 'akta', 'rapor', 'surat_lulus'];
        if (!in_array($type, $allowedTypes)) {
            return back()->with('error', 'Tipe berkas tidak valid.');
        }

        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $path = $request->file('file')->store('berkas/' . $registration->id, 'public');
        
        // Hapus file lama jika ada
        if ($registration->$type && Storage::disk('public')->exists($registration->$type)) {
            Storage::disk('public')->delete($registration->$type);
        }
        
        $registration->update([$type => $path]);
        
        return back()->with('success', 'Berkas berhasil diunggah.');
    }

    public function deleteFile($type)
    {
        $registration = Auth::user()->registration;
        if ($registration->$type && Storage::disk('public')->exists($registration->$type)) {
            Storage::disk('public')->delete($registration->$type);
            $registration->update([$type => null]);
        }
        return back()->with('success', 'Berkas berhasil dihapus.');
    }

    // ==================== PROFIL SISWA ====================
    public function profile()
    {
        $user = Auth::user();
        $registration = $user->registration;
        $jurusan = Jurusan::where('is_active', true)->get();
        return view('student.profile', compact('user', 'registration', 'jurusan'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        $user->update($request->only('name', 'email'));
        
        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|confirmed|min:8',
        ]);
        Auth::user()->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Password berhasil diubah.');
    }

    // ==================== STATUS PENDAFTARAN ====================
    public function status()
    {
        $registration = Auth::user()->registration;
        if (!$registration) {
            return redirect()->route('student.register')->with('error', 'Anda belum mendaftar.');
        }
        return view('student.status', compact('registration'));
    }

    // ==================== PENGUMUMAN ====================
    public function pengumuman()
    {
        $pengumuman = Pengumuman::where('is_published', true)->latest()->paginate(10);
        return view('student.pengumuman', compact('pengumuman'));
    }

    public function showPengumuman(Pengumuman $pengumuman)
    {
        return view('student.pengumuman-detail', compact('pengumuman'));
    }

    // ==================== JADWAL PPDB ====================
    public function jadwal()
    {
        $jadwal = JadwalPPDB::orderBy('tanggal_mulai')->get();
        return view('student.jadwal', compact('jadwal'));
    }

    // ==================== BUKTI PENDAFTARAN ====================
    public function bukti()
    {
        $registration = Auth::user()->registration;
        if (!$registration) {
            return redirect()->route('student.register')->with('error', 'Anda belum mendaftar.');
        }
        $payment = Payment::where('registration_id', $registration->id)->latest()->first();
        return view('student.bukti', compact('registration', 'payment'));
    }

    public function downloadBukti()
    {
        $registration = Auth::user()->registration;
        $pdf = Pdf::loadView('student.bukti-pdf', compact('registration'));
        return $pdf->download('bukti_pendaftaran_' . $registration->registration_number . '.pdf');
    }
}