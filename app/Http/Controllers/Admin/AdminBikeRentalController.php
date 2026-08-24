<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BikeRental;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBikeRentalController extends Controller
{
    public function index()
    {
        $bikes = BikeRental::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.bikes.index', compact('bikes'));
    }

    public function create()
    {
        return view('admin.bikes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'model_name' => ['required', 'string', 'max:255'],
            'bike_type' => ['required', 'string'],
            'engine_capacity' => ['required', 'string', 'max:100'],
            'daily_rate' => ['required', 'numeric', 'min:0'],
            'deposit_amount' => ['required', 'numeric', 'min:0'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'location' => ['nullable', 'string', 'max:255'],
            'is_available' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['model_name']) . '-' . rand(100, 999);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = ImageService::upload($request->file('cover_image'), 'bikes');
        }

        $validated['is_available'] = $request->has('is_available') ? $request->boolean('is_available') : true;
        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : true;

        BikeRental::create($validated);

        return redirect()->route('admin.bikes.index')->with('success', 'Bike rental created successfully!');
    }

    public function edit(BikeRental $bike)
    {
        return view('admin.bikes.edit', compact('bike'));
    }

    public function update(Request $request, BikeRental $bike)
    {
        $validated = $request->validate([
            'model_name' => ['required', 'string', 'max:255'],
            'bike_type' => ['required', 'string'],
            'engine_capacity' => ['required', 'string', 'max:100'],
            'daily_rate' => ['required', 'numeric', 'min:0'],
            'deposit_amount' => ['required', 'numeric', 'min:0'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'location' => ['nullable', 'string', 'max:255'],
            'is_available' => ['boolean'],
            'is_active' => ['boolean'],
        ]);

        if ($request->hasFile('cover_image')) {
            ImageService::delete($bike->cover_image);
            $validated['cover_image'] = ImageService::upload($request->file('cover_image'), 'bikes');
        }

        $validated['is_available'] = $request->boolean('is_available');
        $validated['is_active'] = $request->boolean('is_active');

        $bike->update($validated);

        return redirect()->route('admin.bikes.index')->with('success', 'Bike rental updated successfully!');
    }

    public function destroy(BikeRental $bike)
    {
        ImageService::delete($bike->cover_image);
        $bike->delete();
        return redirect()->route('admin.bikes.index')->with('success', 'Bike rental deleted.');
    }
}
