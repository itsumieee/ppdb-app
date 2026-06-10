
---

```markdown
# 📚 PPDB Online – SMK ICB Cinta Teknika

Sistem **Penerimaan Peserta Didik Baru (PPDB)** modern berbasis web untuk SMK ICB Cinta Teknika. Dibangun dengan Laravel 12, Tailwind CSS, dan Midtrans payment gateway. Memberikan pengalaman pendaftaran yang cepat, aman, dan transparan bagi calon siswa serta manajemen efisien bagi admin sekolah.

![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/itsumieee/ppdb-app/laravel.yml?style=for-the-badge&logo=github&label=Build)
![GitHub License](https://img.shields.io/github/license/itsumieee/ppdb-app?style=for-the-badge&logo=opensourceinitiative)
![GitHub Release](https://img.shields.io/github/v/release/itsumieee/ppdb-app?style=for-the-badge&logo=github)
![GitHub Stars](https://img.shields.io/github/stars/itsumieee/ppdb-app?style=for-the-badge&logo=github&color=yellow)
![Laravel](https://img.shields.io/badge/Laravel-12-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.4-06B6D4?style=for-the-badge&logo=tailwindcss)
![Midtrans](https://img.shields.io/badge/Midtrans-Payment-0066FF?style=for-the-badge&logo=visa)

---

## ✨ Fitur Utama

### 👨‍🎓 **Siswa**
- Pendaftaran online dengan formulir multi‑step & validasi real‑time  
- Upload berkas (foto, KK, akta, rapor, surat lulus)  
- Pembayaran online terintegrasi **Midtrans** (QRIS, Virtual Account, dll)  
- Status pendaftaran: pantau berkas, pembayaran, seleksi secara real‑time  
- Cetak bukti pendaftaran (PDF)  
- Notifikasi browser (toast)  
- Dashboard personal: status, jadwal, pengumuman, galeri  

### 👨‍💼 **Admin**
- Dashboard analitik: statistik pendaftar, grafik, daftar terbaru  
- Manajemen pendaftar (CRUD, filter jurusan/status, pencarian)  
- Verifikasi berkas dengan catatan revisi  
- Manajemen jurusan (kuota, aktif/non‑aktif)  
- Manajemen pengumuman & jadwal PPDB  
- Profil sekolah (informasi, logo, media sosial)  
- Galeri foto (upload, album)  
- Laporan: filter & export ke Excel/PDF  
- Pengaturan website (nama sekolah, warna tema, info PPDB, banner)  
- Akun admin (edit profil, ganti password)

---

## 🛠️ Teknologi

| Frontend               | Backend            | Database & Tools      |
|------------------------|--------------------|-----------------------|
| Tailwind CSS           | Laravel 12         | MySQL / MariaDB       |
| Alpine.js              | PHP 8.2            | Laragon / XAMPP       |
| Blade Templates        | Laravel Breeze     | Git & GitHub          |
| Font Awesome           | Midtrans API       | Composer              |
| Chart.js               |                    | VS Code               |

---

## 📋 Prasyarat

- PHP ≥ 8.2  
- Composer  
- Node.js & NPM  
- MySQL / MariaDB  
- Akun Midtrans (sandbox/production)

---

## 🚀 Instalasi & Konfigurasi

```bash
# Clone repositori
git clone https://github.com/itsumieee/ppdb-app.git
cd ppdb-app

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate
```

Sesuaikan file `.env` (database & Midtrans):

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ppdb_db
DB_USERNAME=root
DB_PASSWORD=

MIDTRANS_SERVER_KEY=SB-Mid-server-xxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxx
MIDTRANS_IS_PRODUCTION=false
```

```bash
# Migrasi & seeder
php artisan migrate
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=JurusanSeeder
php artisan db:seed --class=PengaturanSeeder

# Build assets
npm run build

# Storage link untuk upload berkas
php artisan storage:link

# Jalankan server
php artisan serve
```

Akses aplikasi di `http://127.0.0.1:8000`.

---

## 👥 Akun Demo

| Role  | Email / NIK                       | Password    |
|-------|-----------------------------------|-------------|
| Admin | `admin@smkicbcinteknika.sch.id`   | `password123` |
| Siswa | NIK: `1234567890123456`           | `password123` |

> *Pastikan seeder sudah dijalankan sebelum menggunakan akun demo.*

---

## 📂 Struktur Database (Ringkas)

- `users` – akun admin & siswa  
- `registrations` – data pendaftaran siswa  
- `jurusan` – daftar jurusan (kuota, aktif)  
- `pengumuman` – pengumuman yang dipublikasi  
- `jadwal_ppdb` – jadwal kegiatan PPDB  
- `galeri` – foto kegiatan sekolah  
- `payments` – transaksi pembayaran Midtrans  
- `verifikasi_berkas` – riwayat verifikasi dokumen  
- `pengaturan` – konfigurasi website  

Lihat file migration di `database/migrations` untuk detail lengkap.

---

## 🧪 Testing

```bash
php artisan test
```

---

## 🤝 Kontribusi

1. Fork repositori  
2. Buat branch fitur: `git checkout -b fitur-anda`  
3. Commit perubahan: `git commit -m 'menambahkan fitur baru'`  
4. Push ke branch: `git push origin fitur-anda`  
5. Ajukan Pull Request

---

## 📄 Lisensi

Distribusikan di bawah lisensi **MIT**. Lihat file [LICENSE](https://github.com/itsumieee/ppdb-app/blob/main/LICENSE) untuk informasi lebih lanjut.

---

## 📱 Kontak & Media Sosial

<p align="center">
  <a href="https://github.com/itsumieee"><img src="https://img.shields.io/badge/GitHub-itsumieee-181717?style=flat-square&logo=github"></a>
  <a href="mailto:gumicool2@gmail.com"><img src="https://img.shields.io/badge/Email-gumicool2@gmail.com-D14836?style=flat-square&logo=gmail"></a>
  <a href="https://www.linkedin.com/in/zumieee/"><img src="https://img.shields.io/badge/LinkedIn-zumieee-0077B5?style=flat-square&logo=linkedin"></a>
  <a href="https://www.instagram.com/itsumieee/"><img src="https://img.shields.io/badge/Instagram-itsumieee-E4405F?style=flat-square&logo=instagram"></a>
</p>

---

<p align="center">
  Dibuat dengan ❤️ oleh <strong><a href="https://github.com/itsumieee">Muhammad Zumi</a></strong> untuk SMK ICB Cinta Teknika
</p>
```

---

**Cara penggunaan:**  
1. Buka repositori Anda di GitHub.  
2. Klik **Add file** → **Create new file** → beri nama `README.md`.  
3. Copy semua kode di atas dan paste ke dalam editor.  
4. Scroll ke bawah, tulis pesan commit (misal: `docs: add README`), lalu klik **Commit new file**.  
5. Selesai – README akan tampil di halaman utama repository Anda dengan badges dan format yang rapi.  

Jika ingin menambahkan gambar preview (screenshot), masukkan gambar ke folder `public/assets/preview/` lalu ubah path pada bagian **Preview** di README. 🚀
