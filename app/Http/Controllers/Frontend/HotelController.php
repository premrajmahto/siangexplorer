<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\ServiceEnquiry;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::with('destination')->where('is_active', true);

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->input('destination_id'));
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $hotels = $query->orderBy('is_featured', 'desc')->orderBy('name', 'asc')->paginate(9)->withQueryString();
        $destinations = Destination::where('is_active', true)->orderBy('name', 'asc')->get();

        return view('frontend.hotels.index', compact('hotels', 'destinations'));
    }

    public function show($slug)
    {
        $hotel = Hotel::with('destination')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedHotels = Hotel::where('destination_id', $hotel->destination_id)
            ->where('id', '!=', $hotel->id)
            ->where('is_active', true)
            ->take(3)
            ->get();

        return view('frontend.hotels.show', compact('hotel', 'relatedHotels'));
    }

    public function book(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'num_guests' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string'],
        ]);

        ServiceEnquiry::create([
            'service_type' => 'hotel',
            'service_id' => $hotel->id,
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'num_guests' => $validated['num_guests'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'new',
        ]);

        return back()->with('success', 'Hotel reservation request for ' . $hotel->name . ' submitted! Our team will confirm your room within 2 hours.');
    }
}
