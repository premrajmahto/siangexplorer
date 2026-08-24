<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_type',
        'percentage',
        'fixed_amount',
        'min_booking_amount',
        'max_discount',
        'start_date',
        'expiry_date',
        'usage_limit',
        'per_user_limit',
        'times_used',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'expiry_date' => 'date',
        'is_active' => 'boolean',
        'percentage' => 'decimal:2',
        'fixed_amount' => 'decimal:2',
        'min_booking_amount' => 'decimal:2',
        'max_discount' => 'decimal:2',
    ];

    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    public function isValidForAmount(float $amount): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now()->toDateString();

        if ($this->start_date && $this->start_date > $now) {
            return false;
        }

        if ($this->expiry_date && $this->expiry_date < $now) {
            return false;
        }

        if ($this->usage_limit !== null && $this->times_used >= $this->usage_limit) {
            return false;
        }

        if ($amount < $this->min_booking_amount) {
            return false;
        }

        return true;
    }

    public function calculateDiscount(float $amount): float
    {
        if (!$this->isValidForAmount($amount)) {
            return 0.00;
        }

        if ($this->discount_type === 'percentage') {
            $discount = ($amount * $this->percentage) / 100;
            if ($this->max_discount && $discount > $this->max_discount) {
                $discount = $this->max_discount;
            }
            return round($discount, 2);
        }

        return round(min($this->fixed_amount, $amount), 2);
    }
}
