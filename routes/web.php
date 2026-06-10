<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Student\PaymentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendaftarController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\ProfilSekolahController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\AkunController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk pendaftaran publik (tanpa auth)
Route::get('/daftar', [StudentController::class, 'showRegistrationForm'])->name('student.showRegister');
Route::post('/daftar', [StudentController::class, 'storeRegistration'])->name('student.register.store');

// Route untuk semua user yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('student.beranda');
    })->name('dashboard');

    // Profile routes (dari Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk siswa
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    // Beranda & Dashboard
    Route::get('/', [StudentController::class, 'index'])->name('beranda');
    Route::get('/beranda', [StudentController::class, 'index'])->name('beranda');
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    
    // Pendaftaran
    Route::get('/register', [StudentController::class, 'createRegistration'])->name('register');
    Route::post('/register', [StudentController::class, 'storeRegistration'])->name('store.register');
    
    // Upload Berkas
    Route::get('/upload', [StudentController::class, 'uploadIndex'])->name('upload.index');
    Route::post('/upload/{type}', [StudentController::class, 'uploadFile'])->name('upload.file');
    Route::delete('/upload/{type}', [StudentController::class, 'deleteFile'])->name('upload.delete');
    
    // Profil Siswa
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [StudentController::class, 'updatePassword'])->name('profile.password');
    
    // Status
    Route::get('/status', [StudentController::class, 'status'])->name('status');
    
    // Pengumuman
    Route::get('/pengumuman', [StudentController::class, 'pengumuman'])->name('pengumuman');
    Route::get('/pengumuman/{pengumuman}', [StudentController::class, 'showPengumuman'])->name('pengumuman.show');
    
    // Jadwal
    Route::get('/jadwal', [StudentController::class, 'jadwal'])->name('jadwal');
    
    // Bukti Pendaftaran
    Route::get('/bukti', [StudentController::class, 'bukti'])->name('bukti');
    Route::get('/bukti/download', [StudentController::class, 'downloadBukti'])->name('bukti.download');
    
    // Pembayaran
    Route::get('/payment/{registration}/create', [App\Http\Controllers\Student\PaymentController::class, 'create'])->name('payment.create');
    Route::get('/payment/{payment}/status', [App\Http\Controllers\Student\PaymentController::class, 'status'])->name('payment.status');
});

// Admin routes (sudah ada middleware role:admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Pendaftar
    Route::resource('pendaftar', PendaftarController::class);
    Route::patch('pendaftar/{pendaftar}/status', [PendaftarController::class, 'updateStatus'])->name('pendaftar.updateStatus');
    Route::get('pendaftar/{pendaftar}/cetak', [PendaftarController::class, 'cetakFormulir'])->name('pendaftar.cetak');
    
    // Verifikasi Berkas
    Route::get('verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::get('verifikasi/{registration}', [VerifikasiController::class, 'show'])->name('verifikasi.show');
    Route::post('verifikasi/{registration}/verify', [VerifikasiController::class, 'verify'])->name('verifikasi.verify');
    Route::post('verifikasi/{registration}/reject', [VerifikasiController::class, 'reject'])->name('verifikasi.reject');
    Route::get('verifikasi/{registration}/riwayat', [VerifikasiController::class, 'riwayat'])->name('verifikasi.riwayat');
    
    // Jurusan
    Route::resource('jurusan', JurusanController::class);
    Route::patch('jurusan/{jurusan}/kuota', [JurusanController::class, 'updateKuota'])->name('jurusan.kuota');
    Route::get('jurusan-statistik', [JurusanController::class, 'statistik'])->name('jurusan.statistik');
    
    // Pengumuman
    Route::resource('pengumuman', PengumumanController::class);
    Route::patch('pengumuman/{pengumuman}/publish', [PengumumanController::class, 'togglePublish'])->name('pengumuman.publish');
    
    // Jadwal
    Route::resource('jadwal', JadwalController::class);
    
    // Profil Sekolah
    Route::get('profil-sekolah', [ProfilSekolahController::class, 'edit'])->name('profil_sekolah.edit');
    Route::put('profil-sekolah', [ProfilSekolahController::class, 'update'])->name('profil_sekolah.update');
    
    // Galeri
    Route::resource('galeri', GaleriController::class);
    
    // Laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export_pdf');
    Route::get('laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export_excel');
    Route::get('laporan/print', [LaporanController::class, 'print'])->name('laporan.print');
    
    // Pengaturan
    Route::get('pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
    
    // Akun Saya
    Route::get('akun', [AkunController::class, 'edit'])->name('akun.index');
    Route::put('akun', [AkunController::class, 'update'])->name('akun.update');
    Route::put('akun/password', [AkunController::class, 'updatePassword'])->name('akun.password');
});

// Include auth routes dari routes/auth.php
require __DIR__.'/auth.php';

// Override login & register routes untuk menggunakan split view
// Ditempatkan SETELAH require auth.php agar benar-benar override rute bawaan
Route::get('/login', function () {
    return view('auth.split');
})->name('login');

Route::get('/register', function () {
    return redirect()->route('student.showRegister');
})->name('register');