@extends('layouts.app')

@section('title', \App\Models\Setting::get('seo_default_title', 'SiangExplorer | Premium Tour & Travel Packages'))

@section('content')
<!-- Hero Section with Server-Rendered Background Images & Alpine Auto-Slider -->
<section class="relative min-h-[650px] lg:min-h-[720px] flex items-center justify-center bg-slate-950 overflow-hidden"
         x-data="{ 
            activeSlide: 0,
            totalSlides: {{ count($heroSlides) }},
            timer: null,
            init() {
                this.startTimer();
            },
            startTimer() {
                this.stopTimer();
                this.timer = setInterval(() => {
                    this.nextSlide();
                }, 5000);
            },
            stopTimer() {
                if (this.timer) clearInterval(this.timer);
            },
            nextSlide() {
                this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
            },
            prevSlide() {
                this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
            }
         }"
         @mouseenter="stopTimer()"
         @mouseleave="startTimer()">

    <!-- Slide Background Images (Rendered Directly in HTML DOM) -->
    @foreach($heroSlides as $index => $slide)
        <div x-show="activeSlide === {{ $index }}"
             x-transition:enter="transition-opacity duration-1000 ease-out"
             x-transition:enter-start="opacity-0 scale-105"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition-opacity duration-1000 ease-in"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute inset-0 z-0"
             {!! $index === 0 ? '' : 'style="display: none;"' !!}>
            <img src="{{ $slide['image'] }}" 
                 alt="{{ $slide['tag'] }}" 
                 class="w-full h-full object-cover opacity-50">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-slate-950/70"></div>
        </div>
    @endforeach

    <!-- Left / Right Navigation Arrows -->
    <button @click="prevSlide()" 
            class="absolute left-4 sm:left-8 z-30 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white flex items-center justify-center transition-all transform hover:scale-110 focus:outline-none">
        <i class="fa-solid fa-chevron-left text-sm"></i>
    </button>

    <button @click="nextSlide()" 
            class="absolute right-4 sm:right-8 z-30 w-12 h-12 rounded-full bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white flex items-center justify-center transition-all transform hover:scale-110 focus:outline-none">
        <i class="fa-solid fa-chevron-right text-sm"></i>
    </button>

    <!-- Slide Content Overlays & Search Box -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center space-y-8 w-full">
        <!-- Agency Specialization Badge -->
        <div class="inline-flex items-center space-x-2.5 px-5 py-2.5 rounded-full bg-teal-950/85 backdrop-blur-md border border-teal-400/50 text-teal-300 text-xs sm:text-sm font-extrabold uppercase tracking-wider shadow-2xl animate-pulse">
            <i class="fa-solid fa-earth-asia text-teal-400 text-base"></i>
            <span>Specialized in North East India • Pan India & International Tours</span>
        </div>

        @foreach($heroSlides as $index => $slide)

            <div x-show="activeSlide === {{ $index }}"
                 x-transition:enter="transition-opacity duration-700 ease-out"
                 class="space-y-6"
                 {!! $index === 0 ? '' : 'style="display: none;"' !!}>
                <div class="inline-flex items-center space-x-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white text-xs font-extrabold uppercase tracking-widest">
                    <i class="fa-solid {{ $slide['badgeIcon'] ?? 'fa-sparkles' }} text-brand-400"></i>
                    <span>{{ $slide['tag'] }}</span>
                </div>

                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold text-white tracking-tight leading-tight max-w-4xl mx-auto font-serif">
                    {!! $slide['title'] !!}
                </h1>

                <p class="text-slate-300 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto font-normal leading-relaxed">
                    {{ $slide['subtitle'] }}
                </p>

                <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                    <a href="{{ $slide['ctaLink'] }}" 
                       class="px-8 py-4 bg-gradient-to-r from-brand-500 to-teal-500 hover:from-brand-600 hover:to-teal-600 text-white font-extrabold text-sm rounded-2xl shadow-xl shadow-brand-500/30 transition-all transform hover:-translate-y-1">
                        <i class="fa-solid fa-compass mr-2"></i> {{ $slide['ctaText'] }}
                    </a>
                    <a href="{{ route('destinations.index') }}" 
                       class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 text-white font-extrabold text-sm rounded-2xl transition-all transform hover:-translate-y-1">
                        Explore All Destinations
                    </a>
                </div>
            </div>
        @endforeach

        <!-- Pagination Dots -->
        <div class="flex items-center justify-center space-x-2.5 pt-2">
            @foreach($heroSlides as $index => $slide)
                <button @click="activeSlide = {{ $index }}"
                        class="h-2.5 rounded-full transition-all duration-300 focus:outline-none"
                        :class="activeSlide === {{ $index }} ? 'w-8 bg-brand-400' : 'w-2.5 bg-white/40 hover:bg-white/70'">
                </button>
            @endforeach
        </div>

        <!-- Floating Travel Search Box (Configured via Admin Dashboard) -->
        @if(\App\Models\Setting::get('hero_search_enabled', '1') == '1')
            <div class="pt-6 max-w-5xl mx-auto">
                <form action="{{ route('tours.index') }}" method="GET" class="bg-white/95 backdrop-blur-xl p-4 sm:p-6 rounded-3xl shadow-2xl border border-white/50 text-left grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @if(\App\Models\Setting::get('hero_search_show_destination', '1') == '1')
                        <div>
                            <label class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1.5">
                                {{ \App\Models\Setting::get('hero_search_destination_label', 'DESTINATION') }}
                            </label>
                            <div class="relative">
                                <i class="fa-solid fa-location-dot absolute left-3.5 top-1/2 -translate-y-1/2 text-brand-600 text-xs"></i>
                                <select name="destination_id" class="w-full pl-9 pr-3 py-3 text-xs font-bold rounded-xl bg-slate-100/80 border border-slate-200 text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500">
                                    <option value="">{{ \App\Models\Setting::get('hero_search_destination_placeholder', 'Any Destination') }}</option>
                                    @foreach($destinationsList as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    @if(\App\Models\Setting::get('hero_search_show_tour_type', '1') == '1')
                        <div>
                            <label class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1.5">
                                {{ \App\Models\Setting::get('hero_search_tour_type_label', 'TOUR TYPE') }}
                            </label>
                            <div class="relative">
                                <i class="fa-solid fa-tags absolute left-3.5 top-1/2 -translate-y-1/2 text-brand-600 text-xs"></i>
                                <select name="tour_type_id" class="w-full pl-9 pr-3 py-3 text-xs font-bold rounded-xl bg-slate-100/80 border border-slate-200 text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500">
                                    <option value="">{{ \App\Models\Setting::get('hero_search_tour_type_placeholder', 'All Categories') }}</option>
                                    @foreach($tourTypesList as $tt)
                                        <option value="{{ $tt->id }}">{{ $tt->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    @if(\App\Models\Setting::get('hero_search_show_duration', '1') == '1')
                        <div>
                            <label class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1.5">
                                {{ \App\Models\Setting::get('hero_search_duration_label', 'DURATION') }}
                            </label>
                            <div class="relative">
                                <i class="fa-solid fa-clock absolute left-3.5 top-1/2 -translate-y-1/2 text-brand-600 text-xs"></i>
                                <select name="duration" class="w-full pl-9 pr-3 py-3 text-xs font-bold rounded-xl bg-slate-100/80 border border-slate-200 text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500">
                                    <option value="">{{ \App\Models\Setting::get('hero_search_duration_placeholder', 'Any Duration') }}</option>
                                    <option value="1-3">1 to 3 Days</option>
                                    <option value="4-7">4 to 7 Days</option>
                                    <option value="8+">8+ Days</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-end">
                        <button type="submit" class="w-full py-3.5 bg-slate-900 hover:bg-brand-600 text-white font-extrabold text-xs rounded-xl shadow-md transition-all flex items-center justify-center space-x-2">
                            <i class="fa-solid {{ \App\Models\Setting::get('hero_search_button_icon', 'fa-magnifying-glass') }}"></i>
                            <span>{{ \App\Models\Setting::get('hero_search_button_text', 'Search Tours') }}</span>
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>
</section>

<!-- Popular Destinations Section -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <span class="text-xs font-extrabold text-brand-600 uppercase tracking-widest block">Top Locations</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-serif mt-1">Popular Destinations</h2>
            </div>
            <a href="{{ route('destinations.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center space-x-1 group">
                <span>View All Destinations</span>
                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredDestinations as $destination)
                <x-destination-card :destination="$destination" />
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Tour Packages Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <span class="text-xs font-extrabold text-brand-600 uppercase tracking-widest block">Trending Itineraries</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-serif mt-1">Featured Tour Packages</h2>
            </div>
            <a href="{{ route('tours.index') }}" class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center space-x-1 group">
                <span>Explore All Packages</span>
                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredTours as $tour)
                <x-tour-card :tour="$tour" />
            @endforeach
        </div>
    </div>
</section>

<!-- Services Highlights: Hotels, Cabs & Bikes -->
<section class="py-20 bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs font-extrabold text-brand-400 uppercase tracking-widest">Complete Travel Ecosystem</span>
            <h2 class="text-3xl sm:text-5xl font-extrabold font-serif">Explore All Travel Services</h2>
            <p class="text-slate-400 text-xs sm:text-sm">From luxury 5-star resort accommodations to private cabs and self-drive motorcycles, we have everything covered.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Service 1: Hotels -->
            <div class="bg-slate-800/80 p-8 rounded-3xl border border-slate-700/80 space-y-4 hover:border-brand-500 transition-all">
                <div class="w-14 h-14 rounded-2xl bg-brand-500/20 text-brand-400 flex items-center justify-center text-2xl font-bold">
                    <i class="fa-solid fa-hotel"></i>
                </div>
                <h3 class="font-extrabold text-white text-xl">Luxury Hotels & Resorts</h3>
                <p class="text-slate-400 text-xs leading-relaxed">Book verified 3-Star, 4-Star, and 5-Star luxury stays with complimentary breakfast and guest privileges.</p>
                <a href="{{ route('hotels.index') }}" class="inline-flex items-center space-x-2 text-brand-400 font-bold text-xs hover:underline">
                    <span>Browse Hotels</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- Service 2: Cabs -->
            <div class="bg-slate-800/80 p-8 rounded-3xl border border-slate-700/80 space-y-4 hover:border-brand-500 transition-all">
                <div class="w-14 h-14 rounded-2xl bg-teal-500/20 text-teal-400 flex items-center justify-center text-2xl font-bold">
                    <i class="fa-solid fa-car"></i>
                </div>
                <h3 class="font-extrabold text-white text-xl">Cab & Vehicle Rentals</h3>
                <p class="text-slate-400 text-xs leading-relaxed">Private AC SUVs, Sedans, and 17-Seater Tempo Travellers with experienced commercial drivers.</p>
                <a href="{{ route('transportation.index') }}" class="inline-flex items-center space-x-2 text-teal-400 font-bold text-xs hover:underline">
                    <span>Book Cabs</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- Service 3: Bikes -->
            <div class="bg-slate-800/80 p-8 rounded-3xl border border-slate-700/80 space-y-4 hover:border-brand-500 transition-all">
                <div class="w-14 h-14 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-2xl font-bold">
                    <i class="fa-solid fa-motorcycle"></i>
                </div>
                <h3 class="font-extrabold text-white text-xl">Bike & Scooter Rentals</h3>
                <p class="text-slate-400 text-xs leading-relaxed">Self-drive Royal Enfield Himalayan 411cc, Classic 350, and scooters for mountain expeditions.</p>
                <a href="{{ route('bikes.index') }}" class="inline-flex items-center space-x-2 text-amber-400 font-bold text-xs hover:underline">
                    <span>Rent Bikes</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Pillars Section -->
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs font-extrabold text-brand-600 uppercase tracking-widest">Why SiangExplorer</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-serif">Redefining Vacation & Travel Standards</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-3 text-center">
                <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-2xl font-bold mx-auto">
                    <i class="fa-solid fa-award"></i>
                </div>
                <h3 class="font-extrabold text-slate-900 text-base">Handpicked Itineraries</h3>
                <p class="text-slate-500 text-xs leading-relaxed">Tested day-wise travel plans crafted by experienced destination experts.</p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-3 text-center">
                <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl font-bold mx-auto">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h3 class="font-extrabold text-slate-900 text-base">100% Price Guarantee</h3>
                <p class="text-slate-500 text-xs leading-relaxed">Transparent pricing with no hidden charges, inclusive of all government taxes.</p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-3 text-center">
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl font-bold mx-auto">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h3 class="font-extrabold text-slate-900 text-base">24/7 Personal Concierge</h3>
                <p class="text-slate-500 text-xs leading-relaxed">Dedicated travel support officer available throughout your journey.</p>
            </div>

            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-3 text-center">
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl font-bold mx-auto">
                    <i class="fa-solid fa-thumbs-up"></i>
                </div>
                <h3 class="font-extrabold text-slate-900 text-base">Verified Luxury Stays</h3>
                <p class="text-slate-500 text-xs leading-relaxed">Inspected 3-Star, 4-Star, and 5-Star resorts with guaranteed breakfast.</p>
            </div>
        </div>
    </div>
</section>

<!-- Special Offer Promo Banner -->
<section class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-gradient-to-r from-brand-600 via-teal-600 to-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-2xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8">
        <div class="space-y-3 max-w-2xl">
            <span class="px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-black uppercase tracking-widest">Limited Time Season Discount</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-serif">Get ₹5,000 Flat Off On Your First Booking</h2>
            <p class="text-brand-100 text-xs sm:text-sm">Use coupon code <code class="bg-white/20 px-2 py-0.5 rounded font-mono font-bold text-amber-300">EXPLORE5000</code> at checkout.</p>
        </div>
        <a href="{{ route('tours.index') }}" class="px-8 py-4 bg-white text-slate-900 hover:bg-slate-100 font-extrabold text-xs rounded-2xl shadow-xl shrink-0 transition-all">
            Claim Offer Now
        </a>
    </div>
</section>
@endsection
