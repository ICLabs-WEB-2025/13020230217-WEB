<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class FieldImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'field_id',
        'path',
        'caption',
        'is_primary',
        'order'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_primary' => 'boolean',
        'order' => 'integer'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url', 'thumbnail_url'];

    /**
     * Get the field that owns the image.
     */
    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    /**
     * Get the full URL for the image.
     */
    public function getUrlAttribute(): string
    {
        return $this->path ? Storage::disk('public')->url($this->path) : asset('images/default-field.jpg');
    }

    /**
     * Get the thumbnail URL for the image.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if (!$this->path) {
            return asset('images/default-field-thumb.jpg');
        }

        $pathParts = pathinfo($this->path);
        $thumbnailPath = $pathParts['dirname'].'/thumbs/'.$pathParts['filename'].'.'.$pathParts['extension'];
        
        return Storage::disk('public')->exists($thumbnailPath) 
            ? Storage::disk('public')->url($thumbnailPath)
            : $this->url;
    }

    /**
     * Delete the image file when the model is deleted.
     */
    protected static function booted()
    {
        static::deleted(function ($image) {
            Storage::disk('public')->delete($image->path);
            
            // Delete thumbnail if exists
            $pathParts = pathinfo($image->path);
            $thumbnailPath = $pathParts['dirname'].'/thumbs/'.$pathParts['filename'].'.'.$pathParts['extension'];
            
            if (Storage::disk('public')->exists($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }
        });
    }
}