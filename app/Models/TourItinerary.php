<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourItinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_package_id',
        'day_number',
        'title',
        'description',
        'morning_activity',
        'afternoon_activity',
        'evening_activity',
        'meals',
        'hotel',
        'transportation',
        'image',
        'sort_order',
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
