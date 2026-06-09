<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan PPDB</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background-color: #e0e0e0; }
        .header { text-align: center; margin-bottom: 20px; }
        @media print {
            .no-print { display: none; }
            button { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 8px 16px; background: #2563eb; color: white; border: none; border-radius: 8px;">Cetak / Print</button>
        <button onclick="window.close()" style="padding: 8px 16px; background: #6b7280; margin-left: 10px;">Tutup</button>
    </div>

    <div class="header">
        <h2>Laporan PPDB SMK ICB Cinta Teknika</h2>
        <p>Tanggal Cetak: {{ date('d/m/Y H:i') }}</p>
        <p>Filter: 
            {{ request('jurusan') ? "Jurusan: ".request('jurusan') : "Semua Jurusan" }} | 
            {{ request('status') ? "Status: ".request('status') : "Semua Status" }}
        </p>
    </div>
    <table>
        <thead><tr><th>No Pendaftaran</th><th>Nama</th><th>NIK</th><th>Jurusan</th><th>Status</th><th>Tgl Daftar</th></tr></thead>
        <tbody>
            @foreach($pendaftar as $p)
            <tr><td>{{ $p->registration_number }}</td><td>{{ $p->full_name }}</td><td>{{ $p->nik }}</td><td>{{ $p->major_choice }}</td><td>{{ ucfirst($p->status) }}</td><td>{{ $p->created_at->format('d/m/Y') }}</td></tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>