<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'destination_id', 'description', 'location',
        'rating', 'image_url', 'images', 'status', 'amenities', 'price_per_night', 'type', 'category',
        'total_rooms', 'available_rooms'
    ];

    protected $casts = [
        'amenities' => 'array',
    ];

    public function getImageUrlAttribute($value)
    {
        if (!$value) {
            return 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=1000';
        }

        if (Str::startsWith($value, ['http://', 'https://', '//', 'data:'])) {
            return $value;
        }

        if (Str::startsWith($value, ['/storage/', 'storage/', '/'])) {
            return asset(ltrim($value, '/'));
        }

        return Storage::url($value);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
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

    public function roomCategories()
    {
        return $this->hasMany(HotelRoomCategory::class);
    }

    /**
     * Get the average review rating
     */
    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? $this->rating;
    }
}
