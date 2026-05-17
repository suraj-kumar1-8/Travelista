<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecentlyViewedItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'viewable_type',
        'viewable_id',
        'viewed_at',
    ];

    public $timestamps = true;

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function viewable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
