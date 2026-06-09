<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    use HasFactory;
    protected $fillable = ['history', 'vision', 'mission', 'principal_speech', 'address', 'phone', 'email', 'facebook', 'instagram', 'youtube'];
}