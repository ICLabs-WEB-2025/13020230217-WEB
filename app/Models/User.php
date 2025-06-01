<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;


class User extends Authenticatable
{
    
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function bookings()
       {
           return $this->hasMany(Booking::class);
       }

    public function isAdmin()
    {
        Log::info('Checking isAdmin for user: ' . $this->email . ', role: ' . $this->role);
        return $this->role === 'admin';
    }

}
