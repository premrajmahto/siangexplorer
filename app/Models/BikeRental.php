<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikeRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'model_name',
        'slug',
        'bike_type',
        'engine_capacity',
        'daily_rate',
        'deposit_amount',
        'cover_image',
        'location',
        'is_available',
        'is_active',
    ];

    protected $casts = [
        'daily_rate' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
        'is_available' => 'boolean',
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
        return 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1200&q=80';
    }
}
