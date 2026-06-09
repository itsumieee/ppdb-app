<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PPDB | SMK ICB Cinta Teknika</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800;14..32,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background-color: #f8fafc; }
        .card-modern {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.1);
        }
        .btn-gradient {
            background: linear-gradient(105deg, #3b82f6 0%, #2563eb 100%);
            box-shadow: 0 8px 20px -6px #3b82f650;
        }
        .btn-gradient:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 25px -8px #3b82f680;
        }
        .text-gradient-primary {
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .tab-light {
            border-bottom: 3px solid transparent;
            transition: 0.2s;
        }
        .tab-light.active {
            border-bottom-color: #3b82f6;
            color: #3b82f6;
        }
        .hero-bg {
            background: linear-gradient(135deg, #eff6ff 0%, #ffffff 50%, #f0f9ff 100%);
        }
    </style>
</head>
<body class="antialiased">

    <!-- ========== NAVBAR LIGHT ========== -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fas fa-laptop-code text-white text-sm"></i>
                    </div>
                    <span class="font-extrabold text-gray-800 text-lg">SMK ICB<span class="text-blue-600"> Cinta Teknika</span></span>
                </div>
                <div class="hidden md:flex space-x-8 text-gray-700 font-medium">
                    <a href="#home" class="hover:text-blue-600 transition">Beranda</a>
                    <a href="#profil" class="hover:text-blue-600 transition">Profil</a>
                    <a href="#jurusan" class="hover:text-blue-600 transition">Jurusan</a>
                    <a href="#alur" class="hover:text-blue-600 transition">Alur</a>
                    <a href="#info" class="hover:text-blue-600 transition">Info & Jadwal</a>
                    <a href="#kontak" class="hover:text-blue-600 transition">Kontak</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow-md">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow-md">Daftar</a>
                    @endauth
                </div>
                <div class="md:hidden">
                    <button id="mobileMenuBtn" class="text-gray-700 text-2xl"><i class="fas fa-bars"></i></button>
                </div>
            </div>
        </div>
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t py-3 px-4 space-y-2 shadow-lg">
            <a href="#home" class="block py-2 text-gray-700 hover:text-blue-600">Beranda</a>
            <a href="#profil" class="block py-2 text-gray-700 hover:text-blue-600">Profil</a>
            <a href="#jurusan" class="block py-2 text-gray-700 hover:text-blue-600">Jurusan</a>
            <a href="#alur" class="block py-2 text-gray-700 hover:text-blue-600">Alur</a>
            <a href="#info" class="block py-2 text-gray-700 hover:text-blue-600">Info & Jadwal</a>
            <a href="#kontak" class="block py-2 text-gray-700 hover:text-blue-600">Kontak</a>
        </div>
    </nav>

    <!-- ========== HERO SECTION - CERAH & MODERN ========== -->
    <section id="home" class="hero-bg py-20 md:py-28 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/diagmonds-light.png')] opacity-30"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="text-blue-600 font-semibold text-sm tracking-wider uppercase bg-blue-100 px-3 py-1 rounded-full inline-block">PPDB 2025/2026</span>
                    <h1 class="text-5xl md:text-7xl font-black mt-4 leading-tight">
                        <span class="text-gray-800">Selamat Datang di</span><br>
                        <span class="text-gradient-primary">SMK ICB Cinta Teknika</span>
                    </h1>
                    <p class="text-gray-600 text-lg mt-4 max-w-lg">Membentuk generasi unggul, kreatif, dan berkarakter di era digital.</p>
                    <div class="flex flex-wrap gap-4 mt-8">
                        <a href="{{ route('register') }}" class="btn-gradient px-6 py-3 rounded-full font-bold text-white flex items-center gap-2"><i class="fas fa-arrow-right"></i> Daftar Sekarang</a>
                        <a href="#alur" class="border border-blue-300 px-6 py-3 rounded-full font-semibold text-blue-600 hover:bg-blue-50 transition">Lihat Panduan <i class="fas fa-play ml-1 text-xs"></i></a>
                    </div>
                    <div class="mt-8 flex gap-6">
                        <div><span class="text-2xl font-bold text-blue-600">1.250+</span><p class="text-gray-500 text-sm">Siswa</p></div>
                        <div><span class="text-2xl font-bold text-blue-600">5</span><p class="text-gray-500 text-sm">Jurusan</p></div>
                        <div><span class="text-2xl font-bold text-blue-600">3.200+</span><p class="text-gray-500 text-sm">Alumni</p></div>
                    </div>
                </div>
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://picsum.photos/id/48/600/400" alt="Hero" class="w-full h-auto object-cover">
                    </div>
                    <div class="absolute -bottom-5 -left-5 bg-white rounded-xl shadow-lg p-3 border border-gray-100">
                        <i class="fas fa-quote-left text-blue-400 text-xl"></i>
                        <p class="text-sm font-medium max-w-xs">Akreditasi A (Unggul)</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Wave decoration -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden">
            <svg viewBox="0 0 1200 120" class="relative block w-full h-10 md:h-16" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <!-- ========== TAB NAVIGASI ========== -->
    <div class="sticky top-16 bg-white border-b border-gray-200 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex space-x-6 md:space-x-12 overflow-x-auto py-3 text-sm font-semibold">
                <a href="#profil" class="tab-light active text-blue-600">Profil Sekolah</a>
                <a href="#jurusan" class="tab-light text-gray-600 hover:text-blue-600">Jurusan</a>
                <a href="#alur" class="tab-light text-gray-600 hover:text-blue-600">Alur Pendaftaran</a>
                <a href="#info" class="tab-light text-gray-600 hover:text-blue-600">Info & Jadwal</a>
                <a href="#galeri" class="tab-light text-gray-600 hover:text-blue-600">Galeri</a>
            </div>
        </div>
    </div>

    <!-- ========== PROFIL SEKOLAH ========== -->
    <section id="profil" class="py-20 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-blue-600 font-bold uppercase text-sm bg-blue-100 px-3 py-1 rounded-full">About Us</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-800 mt-4">SMK ICB Cinta Teknika</h2>
            </div>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="order-2 md:order-1">
                    <p class="text-gray-600 leading-relaxed text-lg">Berdiri sejak 2010, SMK ICB Cinta Teknika berkomitmen menjadi pusat pendidikan vokasi terdepan di Indonesia. Dengan kurikulum berbasis industri 4.0, kami melahirkan lulusan yang siap kerja, technopreneur, dan berdaya saing global.</p>
                    <div class="mt-6 space-y-3">
                        <div class="flex items-center gap-3"><i class="fas fa-check-circle text-blue-500 text-xl"></i><span>Akreditasi A (Unggul) – BAN SM</span></div>
                        <div class="flex items-center gap-3"><i class="fas fa-check-circle text-blue-500 text-xl"></i><span>Kerjasama dengan 50+ DU/DI nasional & internasional</span></div>
                        <div class="flex items-center gap-3"><i class="fas fa-check-circle text-blue-500 text-xl"></i><span>85+ guru profesional & bersertifikasi</span></div>
                        <div class="flex items-center gap-3"><i class="fas fa-check-circle text-blue-500 text-xl"></i><span>Fasilitas laboratorium modern & teaching factory</span></div>
                    </div>
                </div>
                <div class="order-1 md:order-2">
                    <div class="card-modern p-1">
                        <img src="https://picsum.photos/id/20/600/400" alt="Profil" class="rounded-xl w-full">
                    </div>
                </div>
            </div>
            <!-- Visi Misi -->
            <div class="grid md:grid-cols-2 gap-8 mt-16">
                <div class="bg-blue-50 rounded-2xl p-6">
                    <i class="fas fa-bullseye text-blue-600 text-3xl mb-3"></i>
                    <h3 class="text-xl font-bold">Visi</h3>
                    <p class="text-gray-700 mt-2">"Menjadi sekolah vokasi berstandar internasional yang menghasilkan lulusan technopreneur."</p>
                </div>
                <div class="bg-cyan-50 rounded-2xl p-6">
                    <i class="fas fa-list-check text-cyan-600 text-3xl mb-3"></i>
                    <h3 class="text-xl font-bold">Misi</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-1 mt-2">
                        <li>Mengimplementasikan teaching factory berbasis industri 4.0</li>
                        <li>Mengembangkan karakter disiplin, inovatif, dan kolaboratif</li>
                        <li>Memperluas kerjasama dengan DUDI nasional & internasional</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== JURUSAN ========== -->
    <section id="jurusan" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-blue-600 font-bold uppercase text-sm bg-blue-100 px-3 py-1 rounded-full">Kompetensi Keahlian</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-800 mt-4">Pilih Jurusan Favoritmu</h2>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card-modern overflow-hidden">
                    <img src="https://picsum.photos/id/0/400/250" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-bold">TKJ</h3>
                        <p class="text-gray-500 text-sm">Teknik Komputer & Jaringan</p>
                        <p class="text-gray-600 mt-2 text-sm">Membangun infrastruktur jaringan, administrasi server, keamanan siber.</p>
                    </div>
                </div>
                <div class="card-modern overflow-hidden">
                    <img src="https://picsum.photos/id/0/401/250" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-bold">RPL</h3>
                        <p class="text-gray-500 text-sm">Rekayasa Perangkat Lunak</p>
                        <p class="text-gray-600 mt-2 text-sm">Pengembangan web, mobile, AI, dan game berbasis industri.</p>
                    </div>
                </div>
                <div class="card-modern overflow-hidden">
                    <img src="https://picsum.photos/id/0/402/250" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-bold">Multimedia</h3>
                        <p class="text-gray-500 text-sm">Desain Grafis & Animasi</p>
                        <p class="text-gray-600 mt-2 text-sm">Motion graphic, editing video, fotografi, produksi konten kreatif.</p>
                    </div>
                </div>
                <div class="card-modern overflow-hidden">
                    <img src="https://picsum.photos/id/0/403/250" class="w-full h-48 object-cover">
                    <div class="p-5">
                        <h3 class="text-xl font-bold">TKR</h3>
                        <p class="text-gray-500 text-sm">Teknik Kendaraan Ringan</p>
                        <p class="text-gray-600 mt-2 text-sm">Perawatan mesin, sistem kelistrikan, diagnosa kendaraan modern.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== ALUR PENDAFTARAN ========== -->
    <section id="alur" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-blue-600 font-bold uppercase text-sm bg-blue-100 px-3 py-1 rounded-full">Panduan</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-800 mt-4">Alur Pendaftaran</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl font-black mb-4">01</div>
                    <h3 class="text-xl font-bold">Buat Akun</h3>
                    <p class="text-gray-600 mt-2">Registrasi dengan email dan password.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center text-xl font-black mb-4">02</div>
                    <h3 class="text-xl font-bold">Isi Formulir</h3>
                    <p class="text-gray-600 mt-2">Lengkapi data pribadi & pilih jurusan.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl font-black mb-4">03</div>
                    <h3 class="text-xl font-bold">Upload Berkas</h3>
                    <p class="text-gray-600 mt-2">Ijazah, rapor, KK, pas foto.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-xl font-black mb-4">04</div>
                    <h3 class="text-xl font-bold">Verifikasi & Seleksi</h3>
                    <p class="text-gray-600 mt-2">Admin verifikasi, lalu tes online.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-xl font-black mb-4">05</div>
                    <h3 class="text-xl font-bold">Pengumuman</h3>
                    <p class="text-gray-600 mt-2">Hasil kelulusan via website & email.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl font-black mb-4">06</div>
                    <h3 class="text-xl font-bold">Daftar Ulang</h3>
                    <p class="text-gray-600 mt-2">Lengkapi administrasi & menjadi siswa baru.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== INFO & JADWAL ========== -->
    <section id="info" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <h3 class="text-2xl font-bold flex items-center gap-2"><i class="fas fa-bullhorn text-blue-500"></i> Pengumuman Terbaru</h3>
                    <div class="mt-6 space-y-4">
                        <div class="border-l-4 border-blue-500 pl-4"><p class="font-semibold">Pendaftaran Gelombang 1 Dibuka!</p><p class="text-gray-500 text-sm">1 April - 30 Juni 2025</p></div>
                        <div class="border-l-4 border-yellow-500 pl-4"><p class="font-semibold">Jadwal Tes Online Gelombang 2</p><p class="text-gray-500 text-sm">5 - 10 Juli 2025</p></div>
                        <div class="border-l-4 border-green-500 pl-4"><p class="font-semibold">Pengumuman Hasil Seleksi</p><p class="text-gray-500 text-sm">15 Juli 2025</p></div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <h3 class="text-2xl font-bold flex items-center gap-2"><i class="fas fa-calendar-alt text-blue-500"></i> Jadwal PPDB 2025/2026</h3>
                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full text-sm">
                            <thead class="border-b"><tr><th class="text-left py-2">Kegiatan</th><th class="text-left py-2">Tanggal</th></tr></thead>
                            <tbody>
                                <tr class="border-b"><td class="py-2">Pendaftaran Online</td><td>1 April - 30 Juni 2025</td></tr>
                                <tr class="border-b"><td class="py-2">Verifikasi Berkas</td><td>1 April - 30 Juni 2025</td></tr>
                                <tr class="border-b"><td class="py-2">Seleksi (Tes)</td><td>1 - 10 Juli 2025</td></tr>
                                <tr class="border-b"><td class="py-2">Pengumuman Kelulusan</td><td>15 Juli 2025</td></tr>
                                <tr><td class="py-2">Daftar Ulang</td><td>16 - 20 Juli 2025</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== GALERI ========== -->
    <section id="galeri" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-blue-600 font-bold uppercase text-sm bg-blue-100 px-3 py-1 rounded-full">Momen Terbaik</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-800 mt-4">Galeri Sekolah</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <img src="https://picsum.photos/id/20/400/300" class="rounded-xl w-full h-40 object-cover shadow hover:scale-105 transition">
                <img src="https://picsum.photos/id/26/400/300" class="rounded-xl w-full h-40 object-cover shadow hover:scale-105 transition">
                <img src="https://picsum.photos/id/30/400/300" class="rounded-xl w-full h-40 object-cover shadow hover:scale-105 transition">
                <img src="https://picsum.photos/id/42/400/300" class="rounded-xl w-full h-40 object-cover shadow hover:scale-105 transition">
                <img src="https://picsum.photos/id/48/400/300" class="rounded-xl w-full h-40 object-cover shadow hover:scale-105 transition">
                <img src="https://picsum.photos/id/57/400/300" class="rounded-xl w-full h-40 object-cover shadow hover:scale-105 transition">
                <img src="https://picsum.photos/id/62/400/300" class="rounded-xl w-full h-40 object-cover shadow hover:scale-105 transition">
                <img src="https://picsum.photos/id/91/400/300" class="rounded-xl w-full h-40 object-cover shadow hover:scale-105 transition">
            </div>
        </div>
    </section>

    <!-- ========== KONTAK & LOKASI ========== -->
    <section id="kontak" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Kontak & Lokasi</h3>
                    <div class="mt-6 space-y-4 text-gray-700">
                        <div class="flex items-center gap-3"><i class="fas fa-map-marker-alt text-blue-500 w-6"></i> Jl. Pendidikan No.123, Cinta Teknika, Bandung, Jawa Barat 40287</div>
                        <div class="flex items-center gap-3"><i class="fab fa-whatsapp text-green-500 w-6"></i> +62 812-3456-7890 (Admin PPDB)</div>
                        <div class="flex items-center gap-3"><i class="fas fa-envelope text-blue-500 w-6"></i> ppdb@smkicb.sch.id</div>
                        <div class="flex items-center gap-3"><i class="fas fa-globe text-blue-500 w-6"></i> www.smkicb.sch.id</div>
                    </div>
                    <div class="mt-8 p-4 bg-blue-50 rounded-xl">
                        <p class="font-semibold">Jam Operasional PPDB</p>
                        <p class="text-sm">Senin - Jumat: 08.00 - 16.00 WIB</p>
                        <p class="text-sm">Sabtu: 08.00 - 12.00 WIB</p>
                    </div>
                </div>
                <div class="rounded-xl overflow-hidden h-64 shadow-md">
                    <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.294146260049!2d107.609811!3d-6.9174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7d3e5b4e3e7%3A0x5f7a4e3d2c1b8a9f!2sBandung!5e0!3m2!1sen!2sid!4v1650000000000!5m2!1sen!2sid" allowfullscreen loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="bg-white border-t border-gray-200 py-10">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            <div class="flex justify-center space-x-6 mb-4">
                <a href="#" class="hover:text-blue-600"><i class="fab fa-instagram text-xl"></i></a>
                <a href="#" class="hover:text-blue-600"><i class="fab fa-facebook text-xl"></i></a>
                <a href="#" class="hover:text-blue-600"><i class="fab fa-youtube text-xl"></i></a>
                <a href="#" class="hover:text-blue-600"><i class="fab fa-tiktok text-xl"></i></a>
            </div>
            <p>© {{ date('Y') }} PPDB SMK ICB Cinta Teknika. All Rights Reserved.</p>
            <p class="text-xs mt-1">#FutureReady #VokasiHebat</p>
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        if(menuBtn) menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    </script>
</body>
</html>