<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\HeroSlide;
use App\Models\Testimonial;
use App\Models\TourPackage;
use App\Models\TourType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredDestinations = Destination::where('is_active', true)
            ->where('is_featured', true)
            ->withCount('tourPackages')
            ->take(6)
            ->get();

        $featuredTours = TourPackage::with(['destination', 'tourType'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->take(6)
            ->get();

        $popularDomesticTours = TourPackage::with('destination')
            ->where('is_active', true)
            ->whereHas('tourType', function ($q) {
                $q->where('slug', 'domestic');
            })
            ->take(4)
            ->get();

        $internationalTours = TourPackage::with('destination')
            ->where('is_active', true)
            ->whereHas('tourType', function ($q) {
                $q->where('slug', 'international');
            })
            ->take(4)
            ->get();

        $testimonials = Testimonial::where('is_approved', true)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        $galleryImages = Gallery::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->take(8)
            ->get();

        $recentBlogs = Blog::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        $destinationsList = Destination::where('is_active', true)->orderBy('name', 'asc')->get();
        $tourTypesList = TourType::where('is_active', true)->orderBy('name', 'asc')->get();

        // Fetch custom hero slides configured in Admin Dashboard
        $dbHeroSlides = HeroSlide::where('is_active', true)->orderBy('sort_order', 'asc')->get();

        $heroSlides = collect();
        if ($dbHeroSlides->count() > 0) {
            foreach ($dbHeroSlides as $slide) {
                $heroSlides->push([
                    'tag' => $slide->tag,
                    'title' => $slide->title,
                    'subtitle' => $slide->subtitle,
                    'image' => $slide->cover_image_url,
                    'badgeIcon' => $slide->badge_icon ?? 'fa-sparkles',
                    'ctaText' => $slide->cta_text,
                    'ctaLink' => $slide->cta_link,
                ]);
            }
        } else {
            foreach ($featuredDestinations as $dest) {
                $heroSlides->push([
                    'tag' => $dest->country . ($dest->state_region ? ' • ' . $dest->state_region : ''),
                    'title' => 'Explore ' . e($dest->name) . ' & <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 via-teal-300 to-amber-300 italic">Unforgettable Vacations</span>',
                    'subtitle' => e($dest->short_description ?? 'Curated luxury tour packages with day-wise itineraries, 5-star accommodations, and private transfers.'),
                    'image' => $dest->cover_image_url,
                    'badgeIcon' => 'fa-sparkles',
                    'ctaText' => 'Explore Destination',
                    'ctaLink' => route('destinations.show', $dest->slug),
                ]);
            }
        }

        return view('frontend.home', compact(
            'featuredDestinations',
            'featuredTours',
            'popularDomesticTours',
            'internationalTours',
            'testimonials',
            'galleryImages',
            'recentBlogs',
            'faqs',
            'destinationsList',
            'tourTypesList',
            'heroSlides'
        ));
    }
}
