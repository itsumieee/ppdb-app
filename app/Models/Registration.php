<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

protected $fillable = [
    'user_id', 'registration_number', 'full_name', 'nisn', 'nik', 'place_of_birth',
    'date_of_birth', 'gender', 'religion', 'address', 'phone', 'previous_school',
    'major_choice', 'status', 'admin_note', 'foto', 'kk', 'akta', 'rapor', 'surat_lulus',
    'berkas_verified', 'catatan_verifikasi'
];

// Relasi ke User (pemilik pendaftaran)
public function user()
{
    return $this->belongsTo(User::class);
}

public function major()
{
    return $this->belongsTo(Major::class, 'major_choice', 'code');
}
}