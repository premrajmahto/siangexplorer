<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::withCount('tourPackages')
            ->where('is_active', true);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%");
            });
        }

        $destinations = $query->orderBy('name', 'asc')->paginate(9)->withQueryString();

        return view('frontend.destinations.index', compact('destinations'));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $tourPackages = TourPackage::with(['tourType', 'category'])
            ->where('destination_id', $destination->id)
            ->where('is_active', true)
            ->paginate(6);

        $tours = $tourPackages;

        $faqs = Faq::where('is_active', true)->take(4)->get();

        return view('frontend.destinations.show', compact('destination', 'tourPackages', 'tours', 'faqs'));
    }
}
