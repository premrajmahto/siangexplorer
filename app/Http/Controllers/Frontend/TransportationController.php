<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ServiceEnquiry;
use App\Models\Transportation;
use Illuminate\Http\Request;

class TransportationController extends Controller
{
    public function index(Request $request)
    {
        $query = Transportation::where('is_active', true);

        if ($request->filled('vehicle_type')) {
            $query->where('vehicle_type', $request->input('vehicle_type'));
        }

        $vehicles = $query->orderBy('capacity', 'asc')->get();

        return view('frontend.transportation.index', compact('vehicles'));
    }

    public function book(Request $request, Transportation $vehicle)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'pickup_location' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        ServiceEnquiry::create([
            'service_type' => 'transportation',
            'service_id' => $vehicle->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? $validated['start_date'],
            'pickup_location' => $validated['pickup_location'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'new',
        ]);

        return back()->with('success', 'Cab & Vehicle booking request for ' . $vehicle->vehicle_name . ' submitted! Driver details will be sent via SMS/WhatsApp.');
    }
}
