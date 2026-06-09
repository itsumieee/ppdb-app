<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiBerkas extends Model
{
    use HasFactory;
    protected $fillable = ['registration_id', 'admin_id', 'status', 'catatan'];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}