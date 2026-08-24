<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_name',
        'slug',
        'vehicle_type',
        'capacity',
        'price_per_day',
        'price_per_km',
        'cover_image',
        'features',
        'description',
        'is_active',
    ];

    protected $casts = [
        'price_per_day' => 'decimal:2',
        'price_per_km' => 'decimal:2',
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
        return 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=1200&q=80';
    }
}
