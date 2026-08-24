<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'destination_id',
        'category',
        'address',
        'city',
        'price_per_night',
        'cover_image',
        'gallery',
        'amenities',
        'short_description',
        'description',
        'is_featured',
        'is_active',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'gallery' => 'array',
        'price_per_night' => 'decimal:2',
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
        return 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80';
    }

    public function getAmenitiesListAttribute(): array
    {
        if (empty($this->amenities)) {
            return [];
        }
        if (is_array($this->amenities)) {
            return $this->amenities;
        }
        $decoded = json_decode($this->amenities, true);
        if (is_array($decoded)) {
            return $decoded;
        }
        return array_filter(array_map('trim', explode(',', $this->amenities)));
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}

