<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'image_url',
        'category', 'author', 'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function getImageUrlAttribute($value)
    {
        if (!$value) {
            return $value;
        }

        if (Str::startsWith($value, ['http://', 'https://', '//', 'data:'])) {
            return $value;
        }

        if (Str::startsWith($value, ['/storage/', 'storage/', '/'])) {
            return asset(ltrim($value, '/'));
        }

        return Storage::url($value);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
