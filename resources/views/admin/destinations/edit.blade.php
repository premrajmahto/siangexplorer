@extends('layouts.admin')

@section('title', 'Edit Destination - ' . $destination->name)

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Edit Destination</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Update details, cover image, and SEO settings for {{ $destination->name }}.</p>
    </div>
    <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-600 hover:text-slate-900 px-3.5 py-2 rounded-xl bg-white border border-slate-200">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Back to Destinations</span>
    </a>
</div>

<form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-4xl">
    @csrf
    @method('PUT')

    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">General Information</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Destination Name <span class="text-rose-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $destination->name) }}" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="country" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Country <span class="text-rose-500">*</span></label>
                <input type="text" name="country" id="country" value="{{ old('country', $destination->country) }}" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                @error('country') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="state_region" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">State / Region</label>
                <input type="text" name="state_region" id="state_region" value="{{ old('state_region', $destination->state_region) }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label for="best_time_to_visit" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Best Time To Visit</label>
                <input type="text" name="best_time_to_visit" id="best_time_to_visit" value="{{ old('best_time_to_visit', $destination->best_time_to_visit) }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
        </div>

        <div>
            <label for="short_description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Short Description (Snippet)</label>
            <textarea name="short_description" id="short_description" rows="2" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('short_description', $destination->short_description) }}</textarea>
        </div>

        <div>
            <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Full Detailed Description</label>
            <textarea name="description" id="description" rows="5" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('description', $destination->description) }}</textarea>
        </div>
    </div>

    <!-- Media & Attractions -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Cover Image & Attractions</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="cover_image" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Update Cover Image</label>
                <input type="file" name="cover_image" id="cover_image" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100">
                    <div class="mt-3 flex items-center space-x-3">
                        <img src="{{ $destination->cover_image_url }}" alt="Current Cover" class="w-16 h-12 rounded-lg object-cover border border-slate-200">
                        <span class="text-[11px] text-slate-500">Current Cover Image</span>
                    </div>

            </div>

            <div>
                <label for="popular_attractions" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Popular Attractions (Comma Separated)</label>
                <input type="text" name="popular_attractions" id="popular_attractions" value="{{ old('popular_attractions', $destination->popular_attractions) }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
        </div>

        <div>
            <label for="travel_info" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Travel Guidelines & Practical Info</label>
            <textarea name="travel_info" id="travel_info" rows="3" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('travel_info', $destination->travel_info) }}</textarea>
        </div>

        <div class="flex items-center space-x-6 pt-2">
            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $destination->is_featured) ? 'checked' : '' }} class="rounded text-brand-600 focus:ring-brand-500 w-4 h-4">
                <span class="text-xs font-bold text-slate-700">Mark as Featured Destination</span>
            </label>

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $destination->is_active) ? 'checked' : '' }} class="rounded text-brand-600 focus:ring-brand-500 w-4 h-4">
                <span class="text-xs font-bold text-slate-700">Publish / Active</span>
            </label>
        </div>
    </div>

    <!-- SEO Metadata -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">SEO Metadata</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="seo_title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">SEO Title</label>
                <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $destination->seo_title) }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <div>
                <label for="seo_keywords" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">SEO Keywords</label>
                <input type="text" name="seo_keywords" id="seo_keywords" value="{{ old('seo_keywords', $destination->seo_keywords) }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>
        </div>

        <div>
            <label for="seo_description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">SEO Meta Description</label>
            <textarea name="seo_description" id="seo_description" rows="2" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ old('seo_description', $destination->seo_description) }}</textarea>
        </div>
    </div>

    <!-- Submit Buttons -->
    <div class="flex items-center justify-end space-x-3">
        <a href="{{ route('admin.destinations.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-all">Cancel</a>
        <button type="submit" class="px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md shadow-brand-600/30 transition-all">
            Update Destination
        </button>
    </div>
</form>
@endsection
