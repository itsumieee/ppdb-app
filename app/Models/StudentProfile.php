<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'place_of_birth',
        'date_of_birth',
        'previous_school',
        'major_choice',
        'status',
        'admin_note',
        'registration_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
