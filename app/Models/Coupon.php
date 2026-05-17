<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount_amount',
        'discount_percentage',
        'expires_at',
        'is_active',
    ];
    
    protected $casts = [
        'expires_at' => 'date',
        'is_active' => 'boolean',
    ];

    public function isValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return true;
    }

    public function calculateDiscount(float $amount): float
    {
        if ($this->discount_percentage) {
            return round(($amount * $this->discount_percentage) / 100, 2);
        }

        if ($this->discount_amount) {
            return min($amount, $this->discount_amount);
        }

        return 0.0;
    }
}
