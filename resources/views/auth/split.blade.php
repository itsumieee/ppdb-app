<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PPDB | SMK ICB Cinta Teknika</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #312e81 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .auth-wrapper {
            max-width: 1200px;
            width: 100%;
            display: flex;
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.45);
            min-height: 580px;
            background: #0f172a;
        }
        .brand-panel {
            width: 45%;
            flex-shrink: 0;
            padding: 2.5rem;
            background: linear-gradient(145deg, #1e40af 0%, #1e3a8a 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .brand-panel::before {
            content: '';
            position: absolute;
            width: 320px; height: 320px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            top: -100px; right: -100px;
        }
        .brand-panel::after {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            bottom: -70px; left: -50px;
        }
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            color: #bfdbfe;
            position: relative; z-index: 1;
        }
        .brand-body { position: relative; z-index: 1; }
        .logo {
            font-size: 2.5rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 2rem 0 1rem;
            line-height: 1.2;
        }
        .tagline { font-size: 0.9rem; color: #bfdbfe; margin-bottom: 2rem; }
        .feature-list { list-style: none; margin: 1.5rem 0; }
        .feature-list li {
            margin: 0.75rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }
        .feature-list i { width: 1.25rem; color: #fbbf24; }
        .copyright { font-size: 0.7rem; color: #93c5fd; position: relative; z-index: 1; }
        .form-section {
            flex: 1;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .flip-scene {
            width: 100%;
            max-width: 460px;
            perspective: 1200px;
        }
        .flip-card {
            width: 100%;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.7s cubic-bezier(0.4, 0.2, 0.2, 1);
        }
        .flip-card.is-flipped {
            transform: rotateY(180deg);
        }
        .flip-face {
            width: 100%;
            backface-visibility: hidden;
            background: #ffffff;
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.12);
        }
        .flip-face--front {
            /* login */
        }
        .flip-face--back {
            position: absolute;
            top: 0;
            left: 0;
            transform: rotateY(180deg);
        }
        .form-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.2rem;
        }
        .form-subtitle {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 1.5rem;
        }
        .input-group { margin-bottom: 1rem; }
        .input-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.35rem;
        }
        .input-group input, .input-group select {
            width: 100%;
            padding: 0.68rem 1rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input-group input:focus, .input-group select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.1);
            background: #fff;
        }
        .btn-primary {
            width: 100%;
            background: #2563eb;
            color: white;
            padding: 0.72rem;
            border: none;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-bottom: 0.9rem;
            box-shadow: 0 4px 14px rgba(37,99,235,0.3);
        }
        .btn-primary:hover { background: #1d4ed8; }
        .divider {
            display: flex;
            align-items: center;
            color: #94a3b8;
            font-size: 0.78rem;
            margin: 0.8rem 0;
        }
        .divider::before, .divider::after { content: ''; flex: 1; border-bottom: 1px solid #e2e8f0; }
        .divider span { margin: 0 0.6rem; }
        .btn-google {
            width: 100%;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.65rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
            margin-bottom: 1.2rem;
        }
        .switch-text {
            text-align: center;
            font-size: 0.83rem;
            color: #64748b;
        }
        .switch-text a {
            color: #2563eb;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 0.65rem;
            border-radius: 0.65rem;
            font-size: 0.82rem;
            margin-bottom: 1rem;
        }
        @media (max-width: 768px) {
            .auth-wrapper { flex-direction: column; }
            .brand-panel { width: 100%; }
            .flip-scene { perspective: none; }
            .flip-card { transform: none !important; }
            .flip-face--back {
                position: relative;
                transform: none;
                display: none;
            }
            .flip-face--back.show-mobile { display: block; }
            .flip-face--front.hide-mobile { display: none; }
        }
    </style>
</head>
<body>
<div class="auth-wrapper">
    <!-- LEFT PANEL (BRAND) STATIS -->
    <div class="brand-panel">
        <div>
            <div class="top-nav"><span>PPDB 2025/2026</span><span>Informasi</span></div>
        </div>
        <div class="brand-body">
            <div class="logo">SMK ICB<br>Cinta Teknika</div>
            <div class="tagline">Membentuk Generasi Unggul, Kreatif, dan Berkarakter</div>
            <ul class="feature-list">
                <li><i class="fas fa-check-circle"></i> Pendaftaran online mudah</li>
                <li><i class="fas fa-check-circle"></i> Informasi real-time</li>
                <li><i class="fas fa-check-circle"></i> Proses seleksi transparan</li>
                <li><i class="fas fa-check-circle"></i> 5 Jurusan Unggulan</li>
            </ul>
        </div>
        <div class="copyright">© {{ date('Y') }} SMK ICB Cinta Teknika. All rights reserved.</div>
    </div>

    <!-- RIGHT PANEL: FLIP CARD -->
    <div class="form-section">
        <div class="flip-scene">
            <div class="flip-card" id="flipCard">
                <!-- FRONT: LOGIN DENGAN NIK -->
                <div class="flip-face flip-face--front" id="faceFront">
                    @if(session('error'))
                        <div class="alert-error">{{ session('error') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert-error">{{ $errors->first() }}</div>
                    @endif
                    <div class="form-title">Selamat Datang!</div>
                    <div class="form-subtitle">Silakan login ke akun PPDB Anda</div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group">
                            <label>NIK (16 digit)</label>
                            <input type="text" name="nik" value="{{ old('nik') }}" required autofocus placeholder="Nomor Induk Kependudukan">
                        </div>
                        <div class="input-group">
                            <label>Password</label>
                            <input type="password" name="password" required placeholder="••••••••">
                        </div>
                        <div class="forgot-link">
                            <a href="{{ route('password.request') }}">Lupa password?</a>
                        </div>
                        <button type="submit" class="btn-primary">Login</button>
                        <div class="divider"><span>atau</span></div>
                        <button type="button" class="btn-google" onclick="alert('Fitur segera hadir')">
                            <i class="fab fa-google" style="color:#ea4335"></i> Login dengan Google
                        </button>
                        <div class="switch-text">
                            Belum punya akun? <a onclick="doFlip()">Daftar</a>
                        </div>
                    </form>
                </div>

                <!-- BACK: FORM PENDAFTARAN LENGKAP (sekaligus buat akun) -->
                <div class="flip-face flip-face--back" id="faceBack">
                    @if($errors->any())
                        <div class="alert-error">{{ $errors->first() }}</div>
                    @endif
                    <div class="form-title">Pendaftaran Siswa Baru</div>
                    <div class="form-subtitle">Isi data diri untuk membuat akun</div>
                    <form method="POST" action="{{ route('student.register.store') }}">
                        @csrf
                        <div class="input-group">
                            <label>Nama Lengkap *</label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}" required>
                        </div>
                        <div class="input-group">
                            <label>NIK (16 digit) *</label>
                            <input type="text" name="nik" value="{{ old('nik') }}" maxlength="16" required>
                        </div>
                        <div class="input-group">
                            <label>Tempat Lahir *</label>
                            <input type="text" name="place_of_birth" value="{{ old('place_of_birth') }}" required>
                        </div>
                        <div class="input-group">
                            <label>Tanggal Lahir *</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                        </div>
                        <div class="input-group">
                            <label>Jenis Kelamin *</label>
                            <select name="gender" required>
                                <option value="">Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Agama *</label>
                            <select name="religion" required>
                                <option value="">Pilih</option>
                                <option>Islam</option><option>Kristen</option><option>Katolik</option><option>Hindu</option><option>Buddha</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Alamat Lengkap *</label>
                            <textarea name="address" rows="2" style="width:100%; border:1.5px solid #e2e8f0; border-radius:0.75rem; padding:0.68rem; font-family:inherit;" required>{{ old('address') }}</textarea>
                        </div>
                        <div class="input-group">
                            <label>No HP *</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required>
                        </div>
                        <div class="input-group">
                            <label>Asal Sekolah *</label>
                            <input type="text" name="previous_school" value="{{ old('previous_school') }}" required>
                        </div>
                        <div class="input-group">
                            <label>Jurusan Pilihan *</label>
                            <select name="major_choice" required>
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach(\App\Models\Jurusan::where('is_active', true)->get() as $j)
                                    <option value="{{ $j->kode }}">{{ $j->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Password *</label>
                            <input type="password" name="password" required placeholder="Minimal 8 karakter">
                        </div>
                        <div class="input-group">
                            <label>Konfirmasi Password *</label>
                            <input type="password" name="password_confirmation" required placeholder="Ulangi password">
                        </div>
                        <button type="submit" class="btn-primary">Daftar Sekarang</button>
                        <div class="switch-text">
                            Sudah punya akun? <a onclick="doFlip()">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const card = document.getElementById('flipCard');
    const front = document.getElementById('faceFront');
    const back = document.getElementById('faceBack');
    let flipped = false;
    let busy = false;

    function syncHeight() {
        const activeFace = flipped ? back : front;
        card.style.height = activeFace.offsetHeight + 'px';
    }

    function doFlip() {
        if (busy) return;
        busy = true;
        flipped = !flipped;
        card.classList.toggle('is-flipped', flipped);
        setTimeout(() => syncHeight(), 350);
        setTimeout(() => { busy = false; }, 750);
    }

    window.addEventListener('load', () => {
        syncHeight();
        // Auto flip jika error validasi dari backend pada form register
        @if($errors->any() && ($errors->has('full_name') || $errors->has('nik')))
            flipped = true;
            card.classList.add('is-flipped');
            syncHeight();
        @endif
    });
    window.addEventListener('resize', syncHeight);

    // Fallback mobile
    if (window.innerWidth <= 768) {
        document.querySelectorAll('[onclick="doFlip()"]').forEach(el => {
            el.onclick = () => {
                flipped = !flipped;
                front.classList.toggle('hide-mobile', flipped);
                back.classList.toggle('show-mobile', flipped);
            };
        });
    }
</script>
</body>
</html>