<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transportation;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTransportationController extends Controller
{
    public function index()
    {
        $vehicles = Transportation::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.transportation.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.transportation.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_name' => ['required', 'string', 'max:255'],
            'vehicle_type' => ['required', 'string'],
            'capacity' => ['required', 'integer', 'min:1'],
            'price_per_day' => ['required', 'numeric', 'min:0'],
            'price_per_km' => ['nullable', 'numeric', 'min:0'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'features' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['vehicle_name']) . '-' . rand(100, 999);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = ImageService::upload($request->file('cover_image'), 'transportation');
        }

        $validated['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : true;

        Transportation::create($validated);

        return redirect()->route('admin.transportation.index')->with('success', 'Vehicle created successfully!');
    }

    public function edit(Transportation $transportation)
    {
        $vehicle = $transportation;
        return view('admin.transportation.edit', compact('vehicle'));
    }

    public function update(Request $request, Transportation $transportation)
    {
        $vehicle = $transportation;
        $validated = $request->validate([
            'vehicle_name' => ['required', 'string', 'max:255'],
            'vehicle_type' => ['required', 'string'],
            'capacity' => ['required', 'integer', 'min:1'],
            'price_per_day' => ['required', 'numeric', 'min:0'],
            'price_per_km' => ['nullable', 'numeric', 'min:0'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'features' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ]);

        if ($request->hasFile('cover_image')) {
            ImageService::delete($vehicle->cover_image);
            $validated['cover_image'] = ImageService::upload($request->file('cover_image'), 'transportation');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $vehicle->update($validated);

        return redirect()->route('admin.transportation.index')->with('success', 'Vehicle updated successfully!');
    }

    public function destroy(Transportation $transportation)
    {
        ImageService::delete($transportation->cover_image);
        $transportation->delete();
        return redirect()->route('admin.transportation.index')->with('success', 'Vehicle deleted.');
    }
}
