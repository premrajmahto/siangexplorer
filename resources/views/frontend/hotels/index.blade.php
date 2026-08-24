@extends('layouts.app')

@section('title', 'Luxury Hotels & Resorts | SiangExplorer')

@section('content')
<!-- Header Banner -->
<section class="bg-slate-950 text-white py-16 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
        <span class="px-3 py-1 bg-brand-500/20 text-brand-400 font-extrabold text-[10px] uppercase tracking-widest rounded-full border border-brand-500/30">
            Accommodations & Stays
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold font-serif tracking-tight">Luxury Hotels & Beach Resorts</h1>
        <p class="text-slate-300 text-xs sm:text-sm max-w-2xl font-normal leading-relaxed">
            Verified 3-Star, 4-Star, and 5-Star properties with complimentary breakfast, pool, and exclusive guest privileges.
        </p>
    </div>
</section>

<!-- Filter & Hotels Listing -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    <!-- Filter Bar -->
    <div class="bg-white p-4 sm:p-6 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
        <span class="text-xs font-extrabold text-slate-700">Showing {{ $hotels->count() }} Verified Properties</span>

        <form action="{{ route('hotels.index') }}" method="GET" class="w-full md:w-auto flex flex-col sm:flex-row items-center gap-3">
            <select name="destination_id" onchange="this.form.submit()" class="w-full sm:w-auto px-4 py-2.5 text-xs font-bold rounded-xl bg-slate-100 border border-slate-200 text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500">
                <option value="">All Destinations</option>
                @foreach($destinations as $d)
                    <option value="{{ $d->id }}" {{ request('destination_id') == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach
            </select>

            <select name="category" onchange="this.form.submit()" class="w-full sm:w-auto px-4 py-2.5 text-xs font-bold rounded-xl bg-slate-100 border border-slate-200 text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500">
                <option value="">All Star Categories</option>
                <option value="5-Star" {{ request('category') === '5-Star' ? 'selected' : '' }}>5-Star Hotels</option>
                <option value="4-Star" {{ request('category') === '4-Star' ? 'selected' : '' }}>4-Star Hotels</option>
                <option value="3-Star" {{ request('category') === '3-Star' ? 'selected' : '' }}>3-Star Hotels</option>
                <option value="Luxury Resort" {{ request('category') === 'Luxury Resort' ? 'selected' : '' }}>Luxury Resorts</option>
            </select>
        </form>
    </div>

    <!-- Hotels Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($hotels as $hotel)
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group">
                <div class="relative h-56 bg-slate-100 overflow-hidden">
                    <img src="{{ $hotel->cover_image_url }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-slate-950/80 backdrop-blur-md text-amber-300 font-extrabold text-[10px] uppercase rounded-full tracking-wider border border-white/20">
                            {{ $hotel->category }}
                        </span>
                    </div>

                    <div class="absolute bottom-3 left-4 text-white text-xs font-semibold">
                        <i class="fa-solid fa-location-dot text-brand-400 mr-1"></i> {{ $hotel->city ?? $hotel->destination->name }}
                    </div>
                </div>

                <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <h3 class="font-extrabold text-slate-900 text-base leading-snug group-hover:text-brand-600 transition-colors">
                            <a href="{{ route('hotels.show', $hotel->slug) }}">{{ $hotel->name }}</a>
                        </h3>
                        <p class="text-xs text-slate-500 font-normal line-clamp-2 leading-relaxed">{{ $hotel->short_description }}</p>

                        @if($hotel->amenities)
                            <div class="pt-2 flex flex-wrap gap-1.5">
                                @foreach(array_slice(explode(',', $hotel->amenities), 0, 3) as $amenity)
                                    <span class="px-2 py-0.5 bg-slate-100 text-slate-600 text-[10px] font-bold rounded-md">
                                        {{ trim($amenity) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-extrabold uppercase text-slate-400 block tracking-wider">Per Night</span>
                            <span class="text-xl font-black text-slate-900">₹{{ number_format($hotel->price_per_night) }}</span>
                        </div>

                        <a href="{{ route('hotels.show', $hotel->slug) }}" class="px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-xs rounded-xl shadow-md transition-all">
                            View Room Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-white rounded-3xl border border-slate-200 p-8 space-y-3">
                <i class="fa-solid fa-hotel text-4xl text-slate-300"></i>
                <h3 class="font-extrabold text-slate-700">No Hotels Found</h3>
                <p class="text-xs text-slate-500">Try selecting a different destination or category.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
