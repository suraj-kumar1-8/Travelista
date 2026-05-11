<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'location', 'image_url', 'gallery',
        'weather', 'best_time_to_visit', 'nearby_attractions', 'category', 'map_coordinates', 'images', 'status'
    ];

    protected $casts = [
        'gallery' => 'array',
        'nearby_attractions' => 'array',
    ];

    public function getImageUrlAttribute($value)
    {
        if (!$value) {
            return 'https://images.unsplash.com/photo-1506929113670-b43135c8d33d?auto=format&fit=crop&q=80&w=1000';
        }

        if (Str::startsWith($value, ['http://', 'https://', '//', 'data:'])) {
            return $value;
        }

        if (Str::startsWith($value, ['/storage/', 'storage/', '/'])) {
            return asset(ltrim($value, '/'));
        }

        return Storage::url($value);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function tourPackages()
    {
        return $this->hasMany(TourPackage::class);
    }

    // Alias for blade templates using 'packages'
    public function packages()
    {
        return $this->hasMany(TourPackage::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function wishlists()
    {
        return $this->morphMany(Wishlist::class, 'wishable');
    }

    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }

    /**
     * Get the average review rating
     */
    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 4.5;
    }
}
