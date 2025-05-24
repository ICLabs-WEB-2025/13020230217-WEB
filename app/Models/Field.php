<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Field extends Model
{
    protected $fillable = [
        'name', 
        'sport_type', 
        'price_per_hour', 
        'description', 
        'photo', 
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price_per_hour' => 'decimal:2',
    ];

    protected $appends = ['photo_url'];

    /**
     * Get the schedules for the field.
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the bookings for the field.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the active fields.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get fields by sport type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('sport_type', $type);
    }

    /**
     * Get the formatted price attribute.
     */
    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => 'Rp ' . number_format($this->price_per_hour, 0, ',', '.'),
        );
    }

    /**
     * Get the full photo URL.
     */
    protected function photoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->photo) {
                    return asset('images/default-field.jpg');
                }
                
                return str_starts_with($this->photo, 'http') 
                    ? $this->photo 
                    : Storage::url($this->photo);
            }
        );
    }

    /**
     * Get the available hours for booking.
     */
    public function availableHours($date)
    {
        $bookedHours = $this->bookings()
            ->whereDate('date', $date)
            ->pluck('start_time', 'end_time');
            
        // Implement your availability logic here
        return [];
    }
}

//    namespace App\Models;

//    use Illuminate\Database\Eloquent\Model;
//    use Illuminate\Database\Eloquent\Relations\HasMany;

//    class Field extends Model
//    {
//        protected $fillable = [
//            'name', 'sport_type', 'price_per_hour', 'description', 'photo', 'is_active',
//        ];

//        protected $casts = [
//             'is_active' => 'boolean',
//             'price_per_hour' => 'decimal:2',
//         ];

//         protected $appends = ['photo_url'];

//        public function schedules()
//        {
//            return $this->hasMany(Schedule::class);
//        }

//        public function bookings()
//        {
//            return $this->hasMany(Booking::class);
//        }

//        public function images(): HasMany
//         {
//             return $this->hasMany(FieldImage::class);
//         }
//    }