<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use App\Services\BookingService;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function process(Request $request, TourPackage $tour)
    {
        $validated = $request->validate([
            'travel_date' => ['required', 'date', 'after_or_equal:today'],
            'num_adults' => ['required', 'integer', 'min:1'],
            'num_children' => ['nullable', 'integer', 'min:0'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'customer_country' => ['nullable', 'string', 'max:100'],
            'coupon_code' => ['nullable', 'string', 'max:50'],
            'pickup_location' => ['nullable', 'string', 'max:255'],
            'special_requests' => ['nullable', 'string'],
        ]);

        $validated['tour_package_id'] = $tour->id;

        try {
            $booking = $this->bookingService->createBooking($validated);

            return redirect()->route('booking.confirmation', $booking->booking_reference)
                ->with('success', 'Your booking request has been submitted successfully! Booking Ref: ' . $booking->booking_reference);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function confirmation($reference)
    {
        $booking = \App\Models\Booking::with(['tourPackage.destination', 'items', 'payments'])
            ->where('booking_reference', $reference)
            ->firstOrFail();

        return view('frontend.booking.confirmation', compact('booking'));
    }
}
