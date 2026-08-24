<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\TourCategory;
use App\Models\TourPackage;
use App\Models\TourType;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = TourPackage::with(['destination', 'category', 'tourType'])
            ->where('is_active', true);

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('short_description', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->input('destination_id'));
        }

        if ($request->filled('tour_type_id')) {
            $query->where('tour_type_id', $request->input('tour_type_id'));
        }

        if ($request->filled('min_price')) {
            $query->where('starting_price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('starting_price', '<=', $request->input('max_price'));
        }

        if ($request->filled('duration')) {
            $duration = $request->input('duration');
            if ($duration === '1-3') {
                $query->whereBetween('duration_days', [1, 3]);
            } elseif ($duration === '4-7') {
                $query->whereBetween('duration_days', [4, 7]);
            } elseif ($duration === '8+') {
                $query->where('duration_days', '>=', 8);
            }
        }

        // Sorting
        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('starting_price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('starting_price', 'desc');
                break;
            case 'popular':
                $query->where('is_popular', true)->orderBy('created_at', 'desc');
                break;
            case 'featured':
                $query->where('is_featured', true)->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $tours = $query->paginate(9)->withQueryString();
        $destinations = Destination::where('is_active', true)->orderBy('name', 'asc')->get();
        $categories = TourCategory::where('is_active', true)->orderBy('name', 'asc')->get();
        $tourTypes = TourType::where('is_active', true)->orderBy('name', 'asc')->get();

        return view('frontend.tours.index', compact('tours', 'destinations', 'categories', 'tourTypes'));
    }

    public function show($slug)
    {
        $tour = TourPackage::with(['destination', 'category', 'tourType', 'images', 'itineraries', 'testimonials'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedTours = TourPackage::with('destination')
            ->where('is_active', true)
            ->where('destination_id', $tour->destination_id)
            ->where('id', '!=', $tour->id)
            ->take(3)
            ->get();

        return view('frontend.tours.show', compact('tour', 'relatedTours'));
    }
}
