<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use Exception;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function recordPayment(Booking $booking, float $amount, string $method = 'manual', ?string $transactionId = null, array $gatewayResponse = []): Payment
    {
        return DB::transaction(function () use ($booking, $amount, $method, $transactionId, $gatewayResponse) {
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'transaction_id' => $transactionId ?? ('TXN-' . time() . '-' . rand(100, 999)),
                'amount' => $amount,
                'currency' => $booking->tourPackage->currency ?? 'INR',
                'payment_method' => $method,
                'payment_status' => 'paid',
                'gateway_response' => $gatewayResponse,
                'paid_at' => now(),
            ]);

            $totalPaid = Payment::where('booking_id', $booking->id)
                ->where('payment_status', 'paid')
                ->sum('amount');

            if ($totalPaid >= $booking->final_amount) {
                $booking->update([
                    'payment_status' => 'paid',
                    'booking_status' => 'confirmed',
                ]);
            } elseif ($totalPaid > 0) {
                $booking->update([
                    'payment_status' => 'partially_paid',
                ]);
            }

            return $payment;
        });
    }

    public function processStripePayment(Booking $booking, string $stripeToken): Payment
    {
        // Stripe gateway wrapper abstraction
        $stripeSecret = config('services.stripe.secret');
        if (!$stripeSecret) {
            return $this->recordPayment($booking, $booking->final_amount, 'stripe', 'STRIPE-DEMO-' . time());
        }

        // Production Stripe API call logic can be bound here
        return $this->recordPayment($booking, $booking->final_amount, 'stripe', 'STRIPE-' . time());
    }

    public function processRazorpayPayment(Booking $booking, string $razorpayPaymentId): Payment
    {
        // Razorpay gateway wrapper abstraction
        return $this->recordPayment($booking, $booking->final_amount, 'razorpay', $razorpayPaymentId);
    }
}
