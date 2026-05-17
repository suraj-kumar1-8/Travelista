<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'image_url', 'code', 'banner_text', 'highlight_text',
        'discount_type', 'discount_value', 'min_booking_amount',
        'valid_from', 'valid_until', 'countdown_ends_at', 'is_active', 'max_uses', 'times_used'
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_until' => 'date',
        'countdown_ends_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Check if offer is currently valid
     */
    public function isValid(): bool
    {
        return $this->is_active
            && now()->between($this->valid_from, $this->valid_until)
            && ($this->max_uses === null || $this->times_used < $this->max_uses);
    }

    /**
     * Scope for active offers
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where('valid_from', '<=', now())
            ->where('valid_until', '>=', now());
    }
}
