<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

     protected $fillable = [
        'booking_id',
        'amount',
        'method', // tambahkan ini
        'status',
        'reference'
    ];

    // Relasi ke booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

}
