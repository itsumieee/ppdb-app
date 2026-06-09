<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@ppdb.com'],
            [
                'name' => 'Admin PPDB',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // Contoh siswa (optional)
        User::firstOrCreate(
            ['email' => 'siswa@example.com'],
            [
                'name' => 'Budi Siswa',
                'password' => Hash::make('password123'),
                'role' => 'student',
            ]
        );
    }
}