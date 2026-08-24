<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('frontend.about');
    }

    public function show($slug)
    {
        if ($slug === 'about-us' || $slug === 'about') {
            return redirect()->route('about');
        }

        $page = Page::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('frontend.pages.show', compact('page'));
    }
}
