<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Hotel;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminHotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::with('destination');

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $hotels = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        $destinations = Destination::orderBy('name', 'asc')->get();
        return view('admin.hotels.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'destination_id' => ['required', 'exists:destinations,id'],
            'category' => ['required', 'string'],
            'city' => ['nullable', 'string', 'max:255'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'amenities' => ['nullable', 'string'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . rand(100, 999);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = ImageService::upload($request->file('cover_image'), 'hotels');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : true;

        Hotel::create($validated);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel created successfully!');
    }

    public function edit(Hotel $hotel)
    {
        $destinations = Destination::orderBy('name', 'asc')->get();
        return view('admin.hotels.edit', compact('hotel', 'destinations'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'destination_id' => ['required', 'exists:destinations,id'],
            'category' => ['required', 'string'],
            'city' => ['nullable', 'string', 'max:255'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'amenities' => ['nullable', 'string'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        if ($request->hasFile('cover_image')) {
            ImageService::delete($hotel->cover_image);
            $validated['cover_image'] = ImageService::upload($request->file('cover_image'), 'hotels');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $hotel->update($validated);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully!');
    }

    public function destroy(Hotel $hotel)
    {
        ImageService::delete($hotel->cover_image);
        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted.');
    }
}
