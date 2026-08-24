<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Payment;
use App\Models\TourPackage;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function createBooking(array $data): Booking
    {
        return DB::transaction(function () use ($data) {
            $tour = TourPackage::findOrFail($data['tour_package_id']);

            if (!$tour->is_active) {
                throw new Exception('Selected tour package is currently unavailable.');
            }

            $numAdults = (int) ($data['num_adults'] ?? 1);
            $numChildren = (int) ($data['num_children'] ?? 0);
            $numTravelers = $numAdults + $numChildren;

            if ($numTravelers > $tour->max_travelers) {
                throw new Exception("Maximum allowed travelers for this tour package is {$tour->max_travelers}.");
            }

            // Calculate pricing
            $adultPrice = $tour->adult_price > 0 ? $tour->adult_price : $tour->effective_price;
            $childPrice = $tour->child_price > 0 ? $tour->child_price : ($adultPrice * 0.7);

            $basePrice = ($numAdults * $adultPrice) + ($numChildren * $childPrice);
            $additionalCharges = 0.00;
            $discountAmount = 0.00;

            // Validate Coupon
            $couponCode = null;
            if (!empty($data['coupon_code'])) {
                $coupon = Coupon::where('code', strtoupper(trim($data['coupon_code'])))->first();
                if ($coupon && $coupon->isValidForAmount($basePrice)) {
                    $discountAmount = $coupon->calculateDiscount($basePrice);
                    $couponCode = $coupon->code;
                    $coupon->increment('times_used');
                }
            }

            $subtotalAfterDiscount = max(0, $basePrice - $discountAmount);
            $taxPercentage = (float) config('travel.tax_percentage', 5.00);
            $taxAmount = round(($subtotalAfterDiscount * $taxPercentage) / 100, 2);
            $finalAmount = round($subtotalAfterDiscount + $taxAmount, 2);

            $bookingReference = Booking::generateReference();
            $userId = Auth::id() ?? ($data['user_id'] ?? null);

            $booking = Booking::create([
                'booking_reference' => $bookingReference,
                'user_id' => $userId,
                'tour_package_id' => $tour->id,
                'travel_date' => $data['travel_date'],
                'num_adults' => $numAdults,
                'num_children' => $numChildren,
                'num_travelers' => $numTravelers,
                'base_price' => $basePrice,
                'additional_charges' => $additionalCharges,
                'discount_amount' => $discountAmount,
                'tax_amount' => $taxAmount,
                'final_amount' => $finalAmount,
                'coupon_code' => $couponCode,
                'pickup_location' => $data['pickup_location'] ?? null,
                'special_requests' => $data['special_requests'] ?? null,
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],
                'customer_country' => $data['customer_country'] ?? 'India',
                'booking_status' => 'pending',
                'payment_status' => 'pending',
            ]);

            // Add line items
            BookingItem::create([
                'booking_id' => $booking->id,
                'item_name' => "Adult Ticket x {$numAdults} ({$tour->title})",
                'item_price' => $adultPrice,
                'quantity' => $numAdults,
                'subtotal' => $numAdults * $adultPrice,
            ]);

            if ($numChildren > 0) {
                BookingItem::create([
                    'booking_id' => $booking->id,
                    'item_name' => "Child Ticket x {$numChildren} ({$tour->title})",
                    'item_price' => $childPrice,
                    'quantity' => $numChildren,
                    'subtotal' => $numChildren * $childPrice,
                ]);
            }

            // Create initial payment log
            Payment::create([
                'booking_id' => $booking->id,
                'amount' => $finalAmount,
                'currency' => $tour->currency ?? 'INR',
                'payment_method' => $data['payment_method'] ?? 'manual',
                'payment_status' => 'pending',
            ]);

            // Record Coupon Usage
            if ($couponCode && isset($coupon)) {
                CouponUsage::create([
                    'coupon_id' => $coupon->id,
                    'user_id' => $userId,
                    'booking_id' => $booking->id,
                    'discount_amount' => $discountAmount,
                ]);
            }

            return $booking;
        });
    }
}
