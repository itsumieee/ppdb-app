<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['event_name', 'start_date', 'end_date', 'description'];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];
}