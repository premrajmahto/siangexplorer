@extends('layouts.admin')

@section('title', 'Add New Hero Slide')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Add New Hero Slide</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Create a new featured slide with image background, title, subtitle, and CTA button.</p>
    </div>
    <a href="{{ route('admin.hero-slides.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-600 hover:text-slate-900 px-3.5 py-2 rounded-xl bg-white border border-slate-200 shadow-sm">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Back to Hero Slides</span>
    </a>
</div>

<form action="{{ route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Slide Content & Headers</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="tag" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Slide Tag / Category Badge</label>
                <input type="text" name="tag" id="tag" value="{{ old('tag', 'Handpicked Vacations') }}" required placeholder="e.g. Tropical Coastal Retreats" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label for="badge_icon" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Badge FontAwesome Icon Class</label>
                <input type="text" name="badge_icon" id="badge_icon" value="{{ old('badge_icon', 'fa-sparkles') }}" placeholder="fa-sparkles, fa-umbrella-beach, fa-plane-departure" class="w-full px-3.5 py-2.5 text-xs font-mono rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
        </div>

        <div>
            <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Headline Title (HTML Allowed)</label>
            <textarea name="title" id="title" rows="2" required placeholder="Discover The World’s Most Extraordinary <span class='text-transparent bg-clip-text bg-gradient-to-r from-brand-300 via-teal-300 to-amber-300 italic'>Destinations</span>" class="w-full px-3.5 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200 font-serif focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('title') }}</textarea>
            <span class="text-[10px] text-slate-400 mt-1 block">Tip: Wrap highlighted words in <code>&lt;span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 via-teal-300 to-amber-300 italic"&gt;Highlighted Text&lt;/span&gt;</code> for gradient effect.</span>
        </div>

        <div>
            <label for="subtitle" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Subtitle Description</label>
            <textarea name="subtitle" id="subtitle" rows="3" placeholder="Curated luxury tour packages with day-wise itineraries, 5-star accommodations..." class="w-full px-3.5 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('subtitle') }}</textarea>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Background Cover Image</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="cover_image" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Option A: Upload Image File</label>
                <input type="file" name="cover_image" id="cover_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
            </div>

            <div>
                <label for="cover_image_url_input" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Option B: Image URL (e.g. Unsplash URL)</label>
                <input type="url" name="cover_image_url_input" id="cover_image_url_input" value="{{ old('cover_image_url_input') }}" placeholder="https://images.unsplash.com/photo-..." class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">CTA Button & Settings</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="cta_text" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">CTA Button Text</label>
                <input type="text" name="cta_text" id="cta_text" value="{{ old('cta_text', 'Search Tour Packages') }}" required class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
            </div>

            <div>
                <label for="cta_link" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">CTA Target Link URL</label>
                <input type="text" name="cta_link" id="cta_link" value="{{ old('cta_link', '/tours') }}" required placeholder="/tours or /hotels" class="w-full px-3.5 py-2.5 text-xs font-mono rounded-xl bg-slate-50 border border-slate-200">
            </div>

            <div>
                <label for="sort_order" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Display Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 1) }}" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
            </div>

            <div class="flex items-center pt-6">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                    <span class="ml-3 text-xs font-bold text-slate-800">Publish & Set Active</span>
                </label>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end space-x-3">
        <a href="{{ route('admin.hero-slides.index') }}" class="px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">Cancel</a>
        <button type="submit" class="px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-extrabold shadow-md transition-all">Save & Create Slide</button>
    </div>
</form>
@endsection
