<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'bookable_type', 'bookable_id', 'start_date', 
        'end_date', 'travelers', 'total_price', 'status', 'booking_reference',
        'coupon_id', 'coupon_code', 'discount_amount', 'subtotal', 'tax_amount',
        'room_category_id', 'cancellation_status', 'refund_status', 'refund_amount',
        'cancelled_at', 'cancellation_reason', 'itinerary_generated_at'
    ];

    protected $casts = [
        'cancelled_at' => 'datetime',
        'itinerary_generated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookable()
    {
        return $this->morphTo();
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function statusHistories()
    {
        return $this->hasMany(BookingStatusHistory::class);
    }

    public function itineraries()
    {
        return $this->hasMany(Itinerary::class)->orderBy('day_number');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function roomCategory()
    {
        return $this->belongsTo(HotelRoomCategory::class, 'room_category_id');
    }
}
