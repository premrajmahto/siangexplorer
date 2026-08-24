<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_reference',
        'user_id',
        'tour_package_id',
        'travel_date',
        'num_adults',
        'num_children',
        'num_travelers',
        'base_price',
        'additional_charges',
        'discount_amount',
        'tax_amount',
        'final_amount',
        'coupon_code',
        'pickup_location',
        'special_requests',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_country',
        'booking_status',
        'payment_status',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'base_price' => 'decimal:2',
        'additional_charges' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'final_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }

    public function items()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public static function generateReference(): string
    {
        $prefix = 'TRV-' . date('Y') . '-';
        $latest = static::where('booking_reference', 'LIKE', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();

        if (!$latest) {
            return $prefix . '000001';
        }

        $number = (int) substr($latest->booking_reference, -6);
        return $prefix . str_pad((string) ($number + 1), 6, '0', STR_PAD_LEFT);
    }
}
