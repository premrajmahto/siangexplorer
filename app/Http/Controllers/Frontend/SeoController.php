<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Page;
use App\Models\TourPackage;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $tours = TourPackage::where('is_active', true)->get();
        $destinations = Destination::where('is_active', true)->get();
        $pages = Page::where('is_published', true)->get();

        $content = view('frontend.seo.sitemap', compact('tours', 'destinations', 'pages'))->render();

        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    public function robots(): Response
    {
        $content = "User-agent: *\nDisallow: /admin/\nDisallow: /customer/\nSitemap: " . url('/sitemap.xml');
        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
