<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'registration_id',
        'order_id',
        'gross_amount',
        'payment_type',
        'transaction_status',
        'snap_token',
        'fraud_status',
        'payment_details',
    ];

    // Definisikan relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Definisikan relasi ke model Registration
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}