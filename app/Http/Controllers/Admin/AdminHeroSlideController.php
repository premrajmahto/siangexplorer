<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('sort_order', 'asc')->get();
        return view('admin.hero_slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero_slides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tag' => 'required|string|max:255',
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'cover_image_url_input' => 'nullable|url',
            'badge_icon' => 'nullable|string|max:100',
            'cta_text' => 'required|string|max:100',
            'cta_link' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('hero', 'public');
            $validated['cover_image'] = $path;
        } elseif ($request->filled('cover_image_url_input')) {
            $validated['cover_image'] = $request->cover_image_url_input;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $request->sort_order ?? 0;
        unset($validated['cover_image_url_input']);

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide created successfully!');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero_slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'tag' => 'required|string|max:255',
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'cover_image_url_input' => 'nullable|url',
            'badge_icon' => 'nullable|string|max:100',
            'cta_text' => 'required|string|max:100',
            'cta_link' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($heroSlide->cover_image && !str_starts_with($heroSlide->cover_image, 'http')) {
                Storage::disk('public')->delete($heroSlide->cover_image);
            }
            $path = $request->file('cover_image')->store('hero', 'public');
            $validated['cover_image'] = $path;
        } elseif ($request->filled('cover_image_url_input')) {
            $validated['cover_image'] = $request->cover_image_url_input;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $request->sort_order ?? $heroSlide->sort_order;
        unset($validated['cover_image_url_input']);

        $heroSlide->update($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide updated successfully!');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        if ($heroSlide->cover_image && !str_starts_with($heroSlide->cover_image, 'http')) {
            Storage::disk('public')->delete($heroSlide->cover_image);
        }
        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide deleted successfully!');
    }
}
