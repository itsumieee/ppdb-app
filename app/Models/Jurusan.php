<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table = 'jurusan';
    protected $fillable = ['kode', 'nama', 'deskripsi', 'gambar', 'kuota', 'is_active'];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'major_choice', 'kode');
    }
}