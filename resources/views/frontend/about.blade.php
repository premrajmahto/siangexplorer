@extends('layouts.app')

@section('title', 'About Us | SiangExplorer - Specialized in North East India, Pan India & International Tours')

@section('content')
<!-- Hero Section -->
<div class="bg-slate-950 text-white py-20 border-b border-slate-800 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 text-center relative z-10">
        <div class="inline-flex items-center space-x-2.5 px-5 py-2.5 rounded-full bg-teal-950/85 backdrop-blur-md border border-teal-400/50 text-teal-300 text-xs sm:text-sm font-extrabold uppercase tracking-wider shadow-2xl">
            <i class="fa-solid fa-earth-asia text-teal-400 text-base"></i>
            <span>Specialized in North East India • Pan India & International Tours</span>
        </div>

        <h1 class="text-4xl sm:text-6xl font-extrabold font-serif tracking-tight leading-tight max-w-4xl mx-auto">
            Crafting Unforgettable Journeys & Mountain Expeditions
        </h1>

        <p class="text-slate-400 text-sm sm:text-base max-w-2xl mx-auto font-normal leading-relaxed">
            Headquartered in Guwahati, Assam, SiangExplorer is a premier tour management, luxury hotel booking, and vehicle rental ecosystem dedicated to authentic travel experiences.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
            <a href="{{ route('tours.index') }}" class="px-7 py-3.5 bg-gradient-to-r from-brand-500 to-teal-500 hover:from-brand-600 hover:to-teal-600 text-white font-extrabold text-xs rounded-2xl shadow-xl transition-all">
                Explore Tour Packages
            </a>
            <a href="{{ route('contact') }}" class="px-7 py-3.5 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white font-extrabold text-xs rounded-2xl transition-all">
                Contact Concierge
            </a>
        </div>
    </div>
</div>

<!-- Our Story Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <span class="text-xs font-extrabold uppercase tracking-widest text-brand-600">Our Story & Mission</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-serif text-slate-900 leading-tight">
                    Rooted in the North-East, Connecting You to the World
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    SiangExplorer was born out of a deep passion for the pristine landscapes, rich tribal heritage, and wild rivers of North East India. From the mighty Brahmaputra river islands of Assam to the living root bridges of Meghalaya and high-altitude mountain passes of Arunachal Pradesh, we bring you firsthand local expertise and seamless logistics.
                </p>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    While we specialize deeply in North East India, our operations extend across Pan-India destination hubs (Himachal Pradesh, Leh-Ladakh, Goa, Kerala, Rajasthan, Kashmir) and international luxury hotspots including Dubai, Bali, Europe, Thailand, and Maldives.
                </p>

                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-1">
                        <span class="text-2xl font-black text-brand-600">100%</span>
                        <p class="text-xs font-bold text-slate-800">Verified Stays & Cabs</p>
                        <p class="text-[10px] text-slate-400">Inspected hotels and commercial drivers</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 space-y-1">
                        <span class="text-2xl font-black text-teal-600">24/7</span>
                        <p class="text-xs font-bold text-slate-800">Personal Travel Manager</p>
                        <p class="text-[10px] text-slate-400">Dedicated concierge on every trip</p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="h-[480px] rounded-3xl overflow-hidden bg-slate-900 border border-slate-200 shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?auto=format&fit=crop&w=1200&q=80" alt="North East Explorer" class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-6 -left-6 bg-slate-950 text-white p-6 rounded-3xl border border-slate-800 shadow-2xl max-w-xs hidden sm:block">
                    <i class="fa-solid fa-quote-left text-brand-400 text-2xl mb-2 block"></i>
                    <p class="text-xs text-slate-300 font-medium">"Providing authentic local experiences with 5-star comfort and complete peace of mind."</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3 Specialization Pillars -->
<section class="py-20 bg-slate-50 border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs font-extrabold text-brand-600 uppercase tracking-widest">Our Tour Horizons</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-serif text-slate-900">3 Core Travel Specializations</h2>
            <p class="text-slate-500 text-xs sm:text-sm">From eastern Himalayan valleys to global capitals, we curate tailored tour itineraries for every traveler.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Pillar 1: North East India -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-4 hover:shadow-xl transition-all">
                <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl font-bold">
                    <i class="fa-solid fa-mountain"></i>
                </div>
                <span class="px-3 py-1 bg-teal-50 text-teal-700 text-[10px] font-extrabold uppercase rounded-full tracking-wider border border-teal-200">Core Specialty</span>
                <h3 class="font-extrabold text-slate-900 text-xl font-serif">North East India</h3>
                <p class="text-slate-500 text-xs leading-relaxed">
                    Assam, Meghalaya, Arunachal Pradesh, Nagaland, Manipur, Mizoram, Tripura, Sikkim & Darjeeling. Complete Inner Line Permit (ILP) assistance, rhino safaris, and living root bridge treks.
                </p>
                <a href="{{ route('destinations.index') }}" class="inline-flex items-center space-x-1.5 text-xs font-extrabold text-teal-600 hover:underline">
                    <span>Explore North East</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- Pillar 2: Pan India -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-4 hover:shadow-xl transition-all">
                <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-2xl font-bold">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <span class="px-3 py-1 bg-brand-50 text-brand-700 text-[10px] font-extrabold uppercase rounded-full tracking-wider border border-brand-200">Domestic Network</span>
                <h3 class="font-extrabold text-slate-900 text-xl font-serif">Pan India Tours</h3>
                <p class="text-slate-500 text-xs leading-relaxed">
                    Manali, Shimla, Leh-Ladakh, Goa, Kerala Houseboats, Rajasthan Heritage Palaces, and Kashmir Tulips. All-inclusive family and honeymoon packages.
                </p>
                <a href="{{ route('tours.index') }}" class="inline-flex items-center space-x-1.5 text-xs font-extrabold text-brand-600 hover:underline">
                    <span>Explore India Tours</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- Pillar 3: International -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-4 hover:shadow-xl transition-all">
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-2xl font-bold">
                    <i class="fa-solid fa-plane"></i>
                </div>
                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-extrabold uppercase rounded-full tracking-wider border border-indigo-200">Global Holidays</span>
                <h3 class="font-extrabold text-slate-900 text-xl font-serif">International Tours</h3>
                <p class="text-slate-500 text-xs leading-relaxed">
                    Dubai luxury extravaganzas, Bali tropical beach villas, Thailand island hopping, Europe alpine trains, Singapore city tours, and Maldives overwater bungalows.
                </p>
                <a href="{{ route('tours.index') }}" class="inline-flex items-center space-x-1.5 text-xs font-extrabold text-indigo-600 hover:underline">
                    <span>Explore International</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Headquarters & Direct Contact Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-900 text-white rounded-3xl p-8 sm:p-12 border border-slate-800 shadow-2xl grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
            <div class="lg:col-span-2 space-y-4">
                <span class="px-3 py-1 bg-brand-500/20 text-brand-400 text-[10px] font-extrabold uppercase tracking-widest rounded-full border border-brand-500/30">Official Headquarters</span>
                <h2 class="text-2xl sm:text-4xl font-extrabold font-serif">Visit Us or Get in Touch Today</h2>
                <div class="space-y-2 text-xs sm:text-sm text-slate-300 pt-2">
                    <p class="flex items-center space-x-3">
                        <i class="fa-solid fa-location-dot text-brand-400 text-base"></i>
                        <span>Mazar Path, Guwahati, Assam, 781037</span>
                    </p>
                    <p class="flex items-center space-x-3">
                        <i class="fa-solid fa-phone text-brand-400 text-base"></i>
                        <span>+91 91272 11962</span>
                    </p>
                    <p class="flex items-center space-x-3">
                        <i class="fa-solid fa-envelope text-brand-400 text-base"></i>
                        <span>support@siangexplorer.com</span>
                    </p>
                </div>
            </div>

            <div class="text-center lg:text-right space-y-3">
                <a href="https://wa.me/919127211962" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs rounded-2xl shadow-xl transition-all">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                    <span>Chat on WhatsApp</span>
                </a>
                <a href="{{ route('contact') }}" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-extrabold text-xs rounded-2xl transition-all border border-white/20">
                    <span>Send Message</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
