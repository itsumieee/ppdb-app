<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        $jurusan = [
            ['kode' => 'RPL', 'nama' => 'Rekayasa Perangkat Lunak', 'kuota' => 120],
            ['kode' => 'TKJ', 'nama' => 'Teknik Komputer Jaringan', 'kuota' => 100],
            ['kode' => 'MM',  'nama' => 'Multimedia', 'kuota' => 90],
            ['kode' => 'AKL', 'nama' => 'Akuntansi', 'kuota' => 80],
            ['kode' => 'OTKP','nama' => 'Otomatisasi Tata Kelola Perkantoran', 'kuota' => 70],
        ];

        foreach ($jurusan as $j) {
            Jurusan::updateOrCreate(
                ['kode' => $j['kode']],
                ['nama' => $j['nama'], 'kuota' => $j['kuota']]
            );
        }
    }
}