@extends('layouts.app')

@section('title', $destination->seo_title ?? $destination->name . ' Tour Packages | SiangExplorer')

@section('content')
<!-- Destination Hero Banner -->
<div class="relative h-[400px] sm:h-[480px] bg-slate-950 overflow-hidden flex items-end">
    <img src="{{ $destination->cover_image_url }}" alt="{{ $destination->name }}" class="absolute inset-0 w-full h-full object-cover opacity-60">
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 space-y-3 text-white">
        <span class="px-3 py-1 bg-brand-500 text-slate-950 font-black text-[10px] uppercase rounded-full tracking-wider">
            {{ $destination->country }} {{ $destination->state_region ? '• ' . $destination->state_region : '' }}
        </span>
        <h1 class="text-4xl sm:text-6xl font-extrabold font-serif tracking-tight">{{ $destination->name }}</h1>
        <p class="text-slate-300 text-xs sm:text-sm max-w-2xl font-normal leading-relaxed">
            {{ $destination->short_description }}
        </p>
    </div>
</div>

<!-- Destination Details & Packages Workspace -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Overview & Travel Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
                <h2 class="text-xl font-extrabold text-slate-900 font-serif">About {{ $destination->name }}</h2>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">{{ $destination->description }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @if($destination->best_time_to_visit)
                    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm space-y-2">
                        <span class="text-[10px] font-extrabold text-brand-600 uppercase tracking-widest block">Optimal Season</span>
                        <h3 class="font-extrabold text-slate-900 text-sm">Best Time to Visit</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">{{ $destination->best_time_to_visit }}</p>
                    </div>
                @endif

                @if($destination->popular_attractions)
                    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm space-y-2">
                        <span class="text-[10px] font-extrabold text-brand-600 uppercase tracking-widest block">Must See Places</span>
                        <h3 class="font-extrabold text-slate-900 text-sm">Popular Sightseeing</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">{{ $destination->popular_attractions }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Travel Guide Info -->
        <div class="space-y-6">
            <div class="bg-slate-900 text-white p-8 rounded-3xl shadow-xl space-y-4">
                <h3 class="font-extrabold text-lg font-serif">Logistics & How to Reach</h3>
                <p class="text-slate-300 text-xs leading-relaxed">{{ $destination->travel_info ?? 'Fly to nearest airport or travel via express highway.' }}</p>
                <div class="pt-2 border-t border-slate-800">
                    <a href="#tours" class="inline-flex items-center space-x-2 text-brand-400 font-bold text-xs hover:underline">
                        <span>Browse {{ $destination->name }} Packages</span>
                        <i class="fa-solid fa-arrow-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Tour Packages for this Destination -->
    <div id="tours" class="space-y-8 pt-6">
        <div class="border-b border-slate-200 pb-4 flex items-center justify-between">
            <div>
                <span class="text-xs font-extrabold text-brand-600 uppercase tracking-widest block">Handpicked Itineraries</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-serif">Available Tour Packages</h2>
            </div>
            <span class="text-xs font-bold text-slate-500">{{ $tourPackages->count() }} Packages Found</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($tourPackages as $tour)
                <x-tour-card :tour="$tour" />
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-3xl border border-slate-200 p-8 space-y-3">
                    <i class="fa-solid fa-compass text-4xl text-slate-300"></i>
                    <h3 class="font-extrabold text-slate-700">No Tour Packages Listed Yet</h3>
                    <p class="text-xs text-slate-500">Check back soon or contact our concierge for a customized itinerary.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
