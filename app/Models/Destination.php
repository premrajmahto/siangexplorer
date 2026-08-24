<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destination extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'country',
        'state_region',
        'cover_image',
        'gallery',
        'short_description',
        'description',
        'best_time_to_visit',
        'popular_attractions',
        'travel_info',
        'is_featured',
        'is_active',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getCoverImageUrlAttribute(): string
    {
        if (!empty($this->cover_image)) {
            if (str_starts_with($this->cover_image, 'http://') || str_starts_with($this->cover_image, 'https://')) {
                return $this->cover_image;
            }
            return asset('storage/' . $this->cover_image);
        }
        return 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80';
    }

    public function tourPackages()
    {
        return $this->hasMany(TourPackage::class);
    }
}
