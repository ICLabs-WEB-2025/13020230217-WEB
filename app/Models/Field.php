<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\Storage; // Tambahkan baris ini

class Field extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
       'name', 'sport_type', 'price_per_hour', 'description', 'photo', 'is_active',
    ];

    // Jika Anda masih memiliki protected $appends = ['photo_url']; tambahkan ini juga
    protected $appends = ['photo_url'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photos')
             ->singleFile()
             ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    
    public function images()
    {
        return $this->hasMany(FieldImage::class);
    }

    public function getPhotoUrlAttribute()
    {
        if (!$this->photo) {
            return asset('images/default-field.jpg');
        }

        // Perbaiki 'storage' menjadi 'Storage'
        return str_starts_with($this->photo, 'http')
            ? $this->photo
            : Storage::url($this->photo); // Perbaikan di sini
    }
}