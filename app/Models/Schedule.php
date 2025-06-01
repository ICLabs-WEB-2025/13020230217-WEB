<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

   class Schedule extends Model
   {

    use HasFactory;
    protected $fillable = [
           'field_id', 'date', 'start_time', 'end_time', 'status',
       ];

       public function field()
       {
           return $this->belongsTo(Field::class);
       }

       public function bookings()
       {
           return $this->hasMany(Booking::class);
       }

        public function user()
        {
            return $this->hasOneThrough(
                User::class,
                Booking::class,
                'schedule_id', // Foreign key on bookings table
                'id', // Foreign key on users table
                'id', // Local key on schedules table
                'user_id' // Local key on bookings table
            );
        }       
   }