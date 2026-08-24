<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Models\Destination;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminDestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::withCount('tourPackages');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%")
                  ->orWhere('state_region', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $destinations = $query->orderBy('name', 'asc')->paginate(12)->withQueryString();

        return view('admin.destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(StoreDestinationRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        // Check unique slug
        $count = Destination::where('slug', 'LIKE', "{$data['slug']}%")->count();
        if ($count > 0) {
            $data['slug'] .= '-' . ($count + 1);
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = ImageService::upload($request->file('cover_image'), 'destinations');
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->has('is_active') ? $request->boolean('is_active') : true;

        Destination::create($data);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination created successfully!');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(UpdateDestinationRequest $request, Destination $destination)
    {
        $data = $request->validated();

        if ($destination->name !== $data['name']) {
            $data['slug'] = Str::slug($data['name']);
            $count = Destination::where('slug', 'LIKE', "{$data['slug']}%")
                ->where('id', '!=', $destination->id)
                ->count();
            if ($count > 0) {
                $data['slug'] .= '-' . ($count + 1);
            }
        }

        if ($request->hasFile('cover_image')) {
            ImageService::delete($destination->cover_image);
            $data['cover_image'] = ImageService::upload($request->file('cover_image'), 'destinations');
        }

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');

        $destination->update($data);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully!');
    }

    public function destroy(Destination $destination)
    {
        ImageService::delete($destination->cover_image);
        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully!');
    }
}
