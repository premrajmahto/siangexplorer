@extends('layouts.admin')

@section('title', 'Hero Section Slider & Search Widget Manager')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Hero Section Slider Manager</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Customize, add, and reorder high-impact slides and the floating quick search bar displayed on the home page hero section.</p>
    </div>

    <a href="{{ route('admin.hero-slides.create') }}" class="inline-flex items-center justify-center space-x-2 text-xs font-extrabold text-white bg-brand-600 hover:bg-brand-700 px-4 py-2.5 rounded-xl shadow-md transition-all">
        <i class="fa-solid fa-plus"></i>
        <span>Add New Hero Slide</span>
    </a>
</div>

<!-- Hero Slides Table -->
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden mb-8">
    <div class="p-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
        <h3 class="font-extrabold text-slate-900 text-sm">Background Carousel Slides</h3>
        <span class="text-xs font-bold text-slate-500">{{ $slides->count() }} Active Slides</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-700">
            <thead class="bg-slate-100/80 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3.5">Slide Image & Tag</th>
                    <th class="px-4 py-3.5">Title & Subtitle</th>
                    <th class="px-4 py-3.5">CTA Button & Link</th>
                    <th class="px-4 py-3.5">Sort Order</th>
                    <th class="px-4 py-3.5">Status</th>
                    <th class="px-4 py-3.5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($slides as $slide)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $slide->cover_image_url }}" alt="{{ $slide->tag }}" class="w-16 h-10 rounded-lg object-cover border border-slate-200 shadow-sm">
                                <div>
                                    <span class="px-2 py-0.5 bg-brand-50 text-brand-700 text-[10px] font-bold rounded-md block">
                                        <i class="fa-solid {{ $slide->badge_icon ?? 'fa-sparkles' }} mr-1"></i> {{ $slide->tag }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 max-w-xs">
                            <h4 class="font-extrabold text-xs text-slate-900 line-clamp-1">{!! strip_tags($slide->title) !!}</h4>
                            <p class="text-[11px] text-slate-500 line-clamp-1 mt-0.5">{{ $slide->subtitle }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <div class="space-y-0.5">
                                <span class="font-bold text-slate-800 block text-xs">{{ $slide->cta_text }}</span>
                                <code class="text-[10px] text-brand-600 bg-slate-100 px-1.5 py-0.5 rounded">{{ $slide->cta_link }}</code>
                            </div>
                        </td>
                        <td class="px-4 py-3 font-mono font-bold text-slate-700">{{ $slide->sort_order }}</td>
                        <td class="px-4 py-3">
                            @if($slide->is_active)
                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 font-extrabold text-[10px] uppercase rounded-lg">Active</span>
                            @else
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 font-extrabold text-[10px] uppercase rounded-lg">Disabled</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="p-2 text-slate-600 hover:text-brand-600 hover:bg-slate-100 rounded-lg transition-colors" title="Edit Slide">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this slide?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Delete Slide">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500 text-xs">
                            No hero slides found. Click <strong>Add New Hero Slide</strong> to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Floating Search Bar Widget Configurator -->
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-6">
    <div class="border-b border-slate-100 pb-3 flex items-center justify-between">
        <div>
            <h3 class="font-extrabold text-slate-900 text-base flex items-center space-x-2">
                <i class="fa-solid fa-sliders text-brand-600"></i>
                <span>Hero Floating Quick Search Bar Configuration</span>
            </h3>
            <p class="text-xs text-slate-500 mt-0.5">Manage search dropdown fields, field titles, placeholders, and search button labels.</p>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Enable Switch -->
        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-between">
            <div>
                <h4 class="font-extrabold text-slate-900 text-xs">Display Floating Quick Search Widget</h4>
                <p class="text-[11px] text-slate-500">Show or hide the floating search bar overlaying the bottom of the hero section.</p>
            </div>
            <input type="hidden" name="hero_search_enabled_submitted" value="1">
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="hero_search_enabled" value="1" class="sr-only peer" {{ \App\Models\Setting::get('hero_search_enabled', '1') == '1' ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-600"></div>
            </label>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
            <!-- Field 1: Destination -->
            <div class="p-4 rounded-xl border border-slate-200 space-y-3 bg-slate-50/50">
                <div class="flex items-center justify-between">
                    <h4 class="font-extrabold text-xs text-slate-900 flex items-center space-x-1.5">
                        <i class="fa-solid fa-location-dot text-brand-600"></i>
                        <span>Destination Field</span>
                    </h4>
                    <input type="hidden" name="hero_search_show_destination_submitted" value="1">
                    <label class="inline-flex items-center cursor-pointer text-[10px] font-bold text-slate-600">
                        <input type="checkbox" name="hero_search_show_destination" value="1" class="rounded text-brand-600 focus:ring-brand-500 mr-1.5" {{ \App\Models\Setting::get('hero_search_show_destination', '1') == '1' ? 'checked' : '' }}> Show Field
                    </label>
                </div>

                <div>
                    <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Field Label</label>
                    <input type="text" name="hero_search_destination_label" value="{{ \App\Models\Setting::get('hero_search_destination_label', 'DESTINATION') }}" class="w-full px-3 py-2 text-xs font-bold rounded-lg border border-slate-300">
                </div>

                <div>
                    <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Placeholder Text</label>
                    <input type="text" name="hero_search_destination_placeholder" value="{{ \App\Models\Setting::get('hero_search_destination_placeholder', 'Any Destination') }}" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300">
                </div>
            </div>

            <!-- Field 2: Tour Type -->
            <div class="p-4 rounded-xl border border-slate-200 space-y-3 bg-slate-50/50">
                <div class="flex items-center justify-between">
                    <h4 class="font-extrabold text-xs text-slate-900 flex items-center space-x-1.5">
                        <i class="fa-solid fa-tags text-brand-600"></i>
                        <span>Tour Type Field</span>
                    </h4>
                    <input type="hidden" name="hero_search_show_tour_type_submitted" value="1">
                    <label class="inline-flex items-center cursor-pointer text-[10px] font-bold text-slate-600">
                        <input type="checkbox" name="hero_search_show_tour_type" value="1" class="rounded text-brand-600 focus:ring-brand-500 mr-1.5" {{ \App\Models\Setting::get('hero_search_show_tour_type', '1') == '1' ? 'checked' : '' }}> Show Field
                    </label>
                </div>

                <div>
                    <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Field Label</label>
                    <input type="text" name="hero_search_tour_type_label" value="{{ \App\Models\Setting::get('hero_search_tour_type_label', 'TOUR TYPE') }}" class="w-full px-3 py-2 text-xs font-bold rounded-lg border border-slate-300">
                </div>

                <div>
                    <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Placeholder Text</label>
                    <input type="text" name="hero_search_tour_type_placeholder" value="{{ \App\Models\Setting::get('hero_search_tour_type_placeholder', 'All Categories') }}" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300">
                </div>
            </div>

            <!-- Field 3: Duration -->
            <div class="p-4 rounded-xl border border-slate-200 space-y-3 bg-slate-50/50">
                <div class="flex items-center justify-between">
                    <h4 class="font-extrabold text-xs text-slate-900 flex items-center space-x-1.5">
                        <i class="fa-solid fa-clock text-brand-600"></i>
                        <span>Duration Field</span>
                    </h4>
                    <input type="hidden" name="hero_search_show_duration_submitted" value="1">
                    <label class="inline-flex items-center cursor-pointer text-[10px] font-bold text-slate-600">
                        <input type="checkbox" name="hero_search_show_duration" value="1" class="rounded text-brand-600 focus:ring-brand-500 mr-1.5" {{ \App\Models\Setting::get('hero_search_show_duration', '1') == '1' ? 'checked' : '' }}> Show Field
                    </label>
                </div>

                <div>
                    <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Field Label</label>
                    <input type="text" name="hero_search_duration_label" value="{{ \App\Models\Setting::get('hero_search_duration_label', 'DURATION') }}" class="w-full px-3 py-2 text-xs font-bold rounded-lg border border-slate-300">
                </div>

                <div>
                    <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Placeholder Text</label>
                    <input type="text" name="hero_search_duration_placeholder" value="{{ \App\Models\Setting::get('hero_search_duration_placeholder', 'Any Duration') }}" class="w-full px-3 py-2 text-xs rounded-lg border border-slate-300">
                </div>
            </div>
        </div>

        <!-- Search Button Configuration -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2">
            <div>
                <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Search Button Text</label>
                <input type="text" name="hero_search_button_text" value="{{ \App\Models\Setting::get('hero_search_button_text', 'Search Tours') }}" class="w-full px-3.5 py-2.5 text-xs font-bold rounded-xl border border-slate-300">
            </div>

            <div>
                <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Search Button Icon Class</label>
                <input type="text" name="hero_search_button_icon" value="{{ \App\Models\Setting::get('hero_search_button_icon', 'fa-magnifying-glass') }}" placeholder="fa-magnifying-glass, fa-paper-plane" class="w-full px-3.5 py-2.5 text-xs font-mono rounded-xl border border-slate-300">
            </div>
        </div>

        <div class="flex justify-end pt-2 border-t border-slate-100">
            <button type="submit" class="px-6 py-2.5 bg-slate-900 hover:bg-brand-600 text-white font-extrabold text-xs rounded-xl shadow-md transition-all">
                Save Search Bar Settings
            </button>
        </div>
    </form>
</div>
@endsection
