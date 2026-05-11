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
}
