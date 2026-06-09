<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
        }
        .content {
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 12px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 12px;
        }
        .label {
            width: 40%;
        }
        .value {
            width: 60%;
            text-align: right;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-top: 40px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        .status-box {
            background-color: #f0f0f0;
            padding: 15px;
            margin: 20px 0;
            border-left: 4px solid #007bff;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BUKTI PENDAFTARAN PPDB</h1>
        <p>SMK ICB Cinta Teknika Tahun Ajaran 2025/2026</p>
    </div>

    <div class="content">
        <div class="section">
            <div class="row">
                <div class="label">Nomor Pendaftaran:</div>
                <div class="value"><strong>{{ $registration->registration_number }}</strong></div>
            </div>
            <div class="row">
                <div class="label">Nama Lengkap:</div>
                <div class="value">{{ $registration->full_name }}</div>
            </div>
            <div class="row">
                <div class="label">NISN:</div>
                <div class="value">{{ $registration->nisn }}</div>
            </div>
            <div class="row">
                <div class="label">NIK:</div>
                <div class="value">{{ $registration->nik }}</div>
            </div>
        </div>

        <div class="section">
            <div class="row">
                <div class="label">Tempat Lahir:</div>
                <div class="value">{{ $registration->place_of_birth }}</div>
            </div>
            <div class="row">
                <div class="label">Tanggal Lahir:</div>
                <div class="value">{{ \Carbon\Carbon::parse($registration->date_of_birth)->format('d/m/Y') }}</div>
            </div>
            <div class="row">
                <div class="label">Jenis Kelamin:</div>
                <div class="value">{{ $registration->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
            </div>
            <div class="row">
                <div class="label">Agama:</div>
                <div class="value">{{ $registration->religion }}</div>
            </div>
        </div>

        <div class="section">
            <div class="row">
                <div class="label">Alamat:</div>
                <div class="value">{{ $registration->address }}</div>
            </div>
            <div class="row">
                <div class="label">No. Telepon:</div>
                <div class="value">{{ $registration->phone }}</div>
            </div>
            <div class="row">
                <div class="label">Asal Sekolah:</div>
                <div class="value">{{ $registration->previous_school }}</div>
            </div>
            <div class="row">
                <div class="label">Jurusan Pilihan:</div>
                <div class="value"><strong>{{ $registration->major_choice }}</strong></div>
            </div>
        </div>

        <div class="status-box">
            <strong>Status Pendaftaran:</strong>
            @if($registration->status == 'pending')
                Menunggu Verifikasi
            @elseif($registration->status == 'approved')
                Diterima
            @else
                Ditolak
            @endif
            @if($registration->admin_note)
                <br><br><strong>Catatan:</strong> {{ $registration->admin_note }}
            @endif
        </div>
    </div>

    <div class="footer">
        <p>Bukti Pendaftaran ini dicetak pada: {{ now()->format('d F Y H:i') }}</p>
        <p>Harap simpan bukti ini untuk keperluan administrasi</p>
    </div>
</body>
</html>
