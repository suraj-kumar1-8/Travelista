<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelRoomCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'name',
        'price_per_night',
        'rooms_total',
        'rooms_available',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
