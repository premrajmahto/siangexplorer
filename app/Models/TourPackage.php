<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourPackage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'destination_id',
        'category_id',
        'tour_type_id',
        'short_description',
        'full_description',
        'cover_image',
        'duration_days',
        'duration_nights',
        'starting_price',
        'discounted_price',
        'adult_price',
        'child_price',
        'currency',
        'max_travelers',
        'min_travelers',
        'is_featured',
        'is_popular',
        'is_active',
        'inclusions_text',
        'exclusions_text',
        'hotel_info',
        'transport_info',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'starting_price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'adult_price' => 'decimal:2',
        'child_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_popular' => 'boolean',
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

    public function getEffectivePriceAttribute(): float
    {
        return $this->discounted_price && $this->discounted_price > 0 
            ? (float) $this->discounted_price 
            : (float) $this->starting_price;
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function category()
    {
        return $this->belongsTo(TourCategory::class, 'category_id');
    }

    public function tourCategory()
    {
        return $this->belongsTo(TourCategory::class, 'category_id');
    }

    public function tourType()
    {
        return $this->belongsTo(TourType::class);
    }

    public function images()
    {
        return $this->hasMany(TourImage::class);
    }

    public function itineraries()
    {
        return $this->hasMany(TourItinerary::class)->orderBy('day_number', 'asc');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class)->where('is_approved', true);
    }
}

