<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nik',
        'email',
        'password',
        'role',
        'phone',
        'nisn',
        'gender',
        'religion',
        'address',
        'parent_name',
        'parent_phone',
        'parent_job',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function registration()
    {
        return $this->hasOne(Registration::class);
    }

    public function studentProfile()
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }
}