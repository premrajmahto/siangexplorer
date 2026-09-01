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

        $enquiry = ServiceEnquiry::create([
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

        try {
            $adminEmail = \App\Models\Setting::get('contact_email', 'amritamaharaj93@gmail.com');
            \Illuminate\Support\Facades\Mail::raw(
                "New Cab/Vehicle Rental Request on SiangExplorer!\n\n".
                "Vehicle: {$vehicle->vehicle_name} ({$vehicle->vehicle_type})\n".
                "Customer: {$enquiry->customer_name}\n".
                "Email: {$enquiry->customer_email}\n".
                "Phone: {$enquiry->customer_phone}\n".
                "Start Date: {$enquiry->start_date}\n".
                "Pickup Location: {$enquiry->pickup_location}\n".
                "Notes: {$enquiry->notes}",
                function ($mail) use ($adminEmail, $enquiry, $vehicle) {
                    $mail->to($adminEmail)
                         ->replyTo($enquiry->customer_email, $enquiry->customer_name)
                         ->subject("New Cab Request: {$vehicle->vehicle_name} from {$enquiry->customer_name}");
                }
            );
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Transportation email error: ' . $e->getMessage());
        }

        return back()->with('success', 'Cab & Vehicle booking request for ' . $vehicle->vehicle_name . ' submitted! Driver details will be sent via SMS/WhatsApp.');
    }
}
