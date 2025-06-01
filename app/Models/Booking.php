<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Model;
   use Illuminate\Database\Eloquent\Factories\HasFactory;

   class Booking extends Model
   {
    use HasFactory;

       protected $fillable = [
           'user_id', 'field_id', 'schedule_id', 'date', 'start_time', 'end_time', 'total_cost', 'payment_status', 'payment_proof',
       ];

       public function user()
       {
           return $this->belongsTo(User::class);
       }

        public function payment()
        {
            return $this->hasOne(Payment::class);
        }

       public function field()
       {
           return $this->belongsTo(\App\Models\Field::class);
       }

       public function schedule()
       {
           return $this->belongsTo(Schedule::class);
       }
   }