<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Models\Destination;
use App\Models\TourCategory;
use App\Models\TourImage;
use App\Models\TourItinerary;
use App\Models\TourPackage;
use App\Models\TourType;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminTourController extends Controller
{
    public function index(Request $request)
    {
        $query = TourPackage::with(['destination', 'category', 'tourType'])
            ->withCount('bookings');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->input('destination_id'));
        }

        if ($request->filled('tour_type_id')) {
            $query->where('tour_type_id', $request->input('tour_type_id'));
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $tours = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $destinations = Destination::orderBy('name', 'asc')->get();
        $tourTypes = TourType::orderBy('name', 'asc')->get();

        return view('admin.tours.index', compact('tours', 'destinations', 'tourTypes'));
    }

    public function create()
    {
        $destinations = Destination::where('is_active', true)->orderBy('name', 'asc')->get();
        $categories = TourCategory::where('is_active', true)->orderBy('name', 'asc')->get();
        $tourTypes = TourType::where('is_active', true)->orderBy('name', 'asc')->get();

        return view('admin.tours.create', compact('destinations', 'categories', 'tourTypes'));
    }

    public function store(StoreTourRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($request, &$data) {
            $data['slug'] = Str::slug($data['title']);
            $count = TourPackage::where('slug', 'LIKE', "{$data['slug']}%")->count();
            if ($count > 0) {
                $data['slug'] .= '-' . ($count + 1);
            }

            if ($request->hasFile('cover_image')) {
                $data['cover_image'] = ImageService::upload($request->file('cover_image'), 'tours');
            }

            $data['is_featured'] = $request->boolean('is_featured');
            $data['is_popular'] = $request->boolean('is_popular');
            $data['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : true;

            $tour = TourPackage::create($data);

            // Upload gallery images
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $index => $file) {
                    $path = ImageService::upload($file, 'tours/gallery');
                    TourImage::create([
                        'tour_package_id' => $tour->id,
                        'image_path' => $path,
                        'sort_order' => $index,
                    ]);
                }
            }

            // Create day-wise itineraries
            if ($request->filled('itineraries') && is_array($request->input('itineraries'))) {
                foreach ($request->input('itineraries') as $itineraryData) {
                    if (!empty($itineraryData['title'])) {
                        TourItinerary::create([
                            'tour_package_id' => $tour->id,
                            'day_number' => $itineraryData['day_number'] ?? 1,
                            'title' => $itineraryData['title'],
                            'description' => $itineraryData['description'] ?? null,
                            'morning_activity' => $itineraryData['morning_activity'] ?? null,
                            'afternoon_activity' => $itineraryData['afternoon_activity'] ?? null,
                            'evening_activity' => $itineraryData['evening_activity'] ?? null,
                            'meals' => $itineraryData['meals'] ?? null,
                            'hotel' => $itineraryData['hotel'] ?? null,
                            'transportation' => $itineraryData['transportation'] ?? null,
                            'sort_order' => $itineraryData['day_number'] ?? 1,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.tours.index')
            ->with('success', 'Tour package created successfully with day-wise itinerary!');
    }

    public function edit(TourPackage $tour)
    {
        $tour->load(['images', 'itineraries']);
        $destinations = Destination::orderBy('name', 'asc')->get();
        $categories = TourCategory::orderBy('name', 'asc')->get();
        $tourTypes = TourType::orderBy('name', 'asc')->get();

        return view('admin.tours.edit', compact('tour', 'destinations', 'categories', 'tourTypes'));
    }

    public function update(UpdateTourRequest $request, TourPackage $tour)
    {
        $data = $request->validated();

        DB::transaction(function () use ($request, $tour, &$data) {
            if ($tour->title !== $data['title']) {
                $data['slug'] = Str::slug($data['title']);
                $count = TourPackage::where('slug', 'LIKE', "{$data['slug']}%")
                    ->where('id', '!=', $tour->id)
                    ->count();
                if ($count > 0) {
                    $data['slug'] .= '-' . ($count + 1);
                }
            }

            if ($request->hasFile('cover_image')) {
                ImageService::delete($tour->cover_image);
                $data['cover_image'] = ImageService::upload($request->file('cover_image'), 'tours');
            }

            $data['is_featured'] = $request->boolean('is_featured');
            $data['is_popular'] = $request->boolean('is_popular');
            $data['is_active'] = $request->boolean('is_active');

            $tour->update($data);

            // Additional Gallery Images Upload
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $index => $file) {
                    $path = ImageService::upload($file, 'tours/gallery');
                    TourImage::create([
                        'tour_package_id' => $tour->id,
                        'image_path' => $path,
                        'sort_order' => $tour->images()->count() + $index,
                    ]);
                }
            }

            // Sync day-wise itineraries
            if ($request->filled('itineraries') && is_array($request->input('itineraries'))) {
                $tour->itineraries()->delete();
                foreach ($request->input('itineraries') as $itineraryData) {
                    if (!empty($itineraryData['title'])) {
                        TourItinerary::create([
                            'tour_package_id' => $tour->id,
                            'day_number' => $itineraryData['day_number'] ?? 1,
                            'title' => $itineraryData['title'],
                            'description' => $itineraryData['description'] ?? null,
                            'morning_activity' => $itineraryData['morning_activity'] ?? null,
                            'afternoon_activity' => $itineraryData['afternoon_activity'] ?? null,
                            'evening_activity' => $itineraryData['evening_activity'] ?? null,
                            'meals' => $itineraryData['meals'] ?? null,
                            'hotel' => $itineraryData['hotel'] ?? null,
                            'transportation' => $itineraryData['transportation'] ?? null,
                            'sort_order' => $itineraryData['day_number'] ?? 1,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.tours.index')
            ->with('success', 'Tour package updated successfully!');
    }

    public function destroy(TourPackage $tour)
    {
        ImageService::delete($tour->cover_image);
        foreach ($tour->images as $img) {
            ImageService::delete($img->image_path);
        }
        $tour->delete();

        return redirect()->route('admin.tours.index')
            ->with('success', 'Tour package deleted successfully!');
    }

    public function duplicate(TourPackage $tour)
    {
        $newTour = $tour->replicate();
        $newTour->title = $tour->title . ' (Copy)';
        $newTour->slug = Str::slug($newTour->title) . '-' . rand(100, 999);
        $newTour->is_active = false;
        $newTour->save();

        foreach ($tour->itineraries as $itinerary) {
            $newItinerary = $itinerary->replicate();
            $newItinerary->tour_package_id = $newTour->id;
            $newItinerary->save();
        }

        return redirect()->route('admin.tours.edit', $newTour)
            ->with('success', 'Tour package duplicated successfully! You can now edit the duplicate copy.');
    }

    public function deleteGalleryImage(TourImage $image)
    {
        ImageService::delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Gallery image deleted.');
    }

    public function categories()
    {
        $categories = TourCategory::withCount('tourPackages')->get();
        return view('admin.tours.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        TourCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);
        return back()->with('success', 'Tour category created.');
    }

    public function types()
    {
        $types = TourType::withCount('tourPackages')->get();
        return view('admin.tours.types', compact('types'));
    }

    public function storeType(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        TourType::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);
        return back()->with('success', 'Tour type created.');
    }
}
