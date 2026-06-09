<!DOCTYPE html>
<html>
<head>
    <title>Laporan PPDB</title>
    <style>
        body { font-family: 'Arial', sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan PPDB SMK ICB Cinta Teknika</h2>
        <p>Tanggal Cetak: {{ date('d/m/Y H:i') }}</p>
        <p>Filter: 
            {{ request('jurusan') ? "Jurusan: ".request('jurusan') : "Semua Jurusan" }} | 
            {{ request('status') ? "Status: ".request('status') : "Semua Status" }}
        </p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No Pendaftaran</th><th>Nama</th><th>NIK</th><th>Jurusan</th><th>Status</th><th>Tgl Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pendaftar as $p)
            <tr>
                <td>{{ $p->registration_number }}</td>
                <td>{{ $p->full_name }}</td>
                <td>{{ $p->nik }}</td>
                <td>{{ $p->major_choice }}</td>
                <td>{{ ucfirst($p->status) }}</td>
                <td>{{ $p->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>