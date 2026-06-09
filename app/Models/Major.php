<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'description', 'image', 'quota', 'is_active'];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'major_choice', 'code');
    }
}