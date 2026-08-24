<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BikeRental;
use App\Models\ServiceEnquiry;
use Illuminate\Http\Request;

class BikeRentalController extends Controller
{
    public function index(Request $request)
    {
        $query = BikeRental::where('is_active', true);

        if ($request->filled('bike_type')) {
            $query->where('bike_type', $request->input('bike_type'));
        }

        $bikes = $query->orderBy('daily_rate', 'asc')->get();

        return view('frontend.bikes.index', compact('bikes'));
    }

    public function book(Request $request, BikeRental $bike)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'pickup_location' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        ServiceEnquiry::create([
            'service_type' => 'bike_rental',
            'service_id' => $bike->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? $validated['start_date'],
            'pickup_location' => $validated['pickup_location'] ?? $bike->location,
            'notes' => $validated['notes'] ?? null,
            'status' => 'new',
        ]);

        return back()->with('success', 'Motorcycle rental request for ' . $bike->model_name . ' submitted! Hub manager will contact you shortly.');
    }
}
