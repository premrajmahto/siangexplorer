@extends('layouts.app')

@section('title', 'About Us | Your Trusted Destination Management Partner for Northeast India - Siang Explorer Holidays')

@section('content')
<!-- Hero Section -->
<div class="bg-slate-950 text-white py-20 border-b border-slate-800 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#38bdf8_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 text-center relative z-10">
        <div class="inline-flex items-center space-x-2.5 px-5 py-2.5 rounded-full bg-teal-950/85 backdrop-blur-md border border-teal-400/50 text-teal-300 text-xs sm:text-sm font-extrabold uppercase tracking-wider shadow-2xl">
            <i class="fa-solid fa-earth-asia text-teal-400 text-base"></i>
            <span>Destination Management Company (DMC) • Northeast India</span>
        </div>

        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold font-serif tracking-tight leading-tight max-w-5xl mx-auto text-white">
            Your Trusted Destination Management Partner for Northeast India
        </h1>

        <p class="text-slate-300 text-sm sm:text-base max-w-4xl mx-auto font-normal leading-relaxed">
            Siang Explorer Holidays is a destination management company (DMC) specializing in Northeast India. With strong on-ground knowledge, local networks, and years of experience in tourism, we help travel partners discover and deliver the Northeast with confidence, efficiency, and genuine local experiences.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
            <a href="{{ route('tours.index') }}" class="px-7 py-3.5 bg-gradient-to-r from-brand-500 to-teal-500 hover:from-brand-600 hover:to-teal-600 text-white font-extrabold text-xs rounded-2xl shadow-xl transition-all">
                Explore Tour Packages
            </a>
            <a href="{{ route('contact') }}" class="px-7 py-3.5 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white font-extrabold text-xs rounded-2xl transition-all">
                Get In Touch
            </a>
        </div>
    </div>
</div>

<!-- Regional Expertise Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <span class="text-xs font-extrabold uppercase tracking-widest text-brand-600">Deep Regional Knowledge</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-serif text-slate-900 leading-tight">
                    Understanding the Region Beyond the Brochure
                </h2>
                <p class="text-slate-600 text-sm leading-relaxed">
                    From the mighty Brahmaputra and Assam’s wildlife to the living root bridges of Meghalaya, the mountains of Arunachal Pradesh, the cultural heritage of Nagaland and Mizoram, and the diverse traditions of the Northeast, we understand the region beyond what is shown in a brochure.
                </p>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Our expertise covers <strong class="text-slate-900">Assam, Meghalaya, Arunachal Pradesh, Nagaland, Manipur, Mizoram, Tripura, and Sikkim</strong>, allowing us to create and operate both popular and offbeat travel experiences across the region.
                </p>

                <!-- States Grid Badges -->
                <div class="pt-4">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-3">States We Cover</span>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Assam', 'Meghalaya', 'Arunachal Pradesh', 'Nagaland', 'Manipur', 'Mizoram', 'Tripura', 'Sikkim'] as $state)
                            <span class="px-3.5 py-1.5 rounded-xl bg-teal-50 border border-teal-200/80 text-teal-800 font-bold text-xs flex items-center space-x-1.5 shadow-sm">
                                <i class="fa-solid fa-location-dot text-teal-500 text-xs"></i>
                                <span>{{ $state }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="h-[460px] rounded-3xl overflow-hidden bg-slate-900 border border-slate-200 shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?auto=format&fit=crop&w=1200&q=80" alt="Northeast India Landscapes" class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-6 -left-6 bg-slate-950 text-white p-6 rounded-3xl border border-slate-800 shadow-2xl max-w-sm hidden sm:block">
                    <i class="fa-solid fa-quote-left text-teal-400 text-2xl mb-2 block"></i>
                    <p class="text-xs text-slate-300 font-medium italic">"We know the Northeast. We operate the Northeast. We live the Northeast."</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What We Do Section -->
<section class="py-20 bg-slate-50 border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs font-extrabold text-brand-600 uppercase tracking-widest">Services & Capabilities</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-serif text-slate-900">What We Do</h2>
            <p class="text-slate-600 text-sm leading-relaxed">
                We provide complete destination management support for travel agencies, tour operators, corporate clients, educational institutions, and individual travellers, including:
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $services = [
                    ['icon' => 'fa-route', 'title' => 'Customized FIT & Group Tour Operations', 'color' => 'teal'],
                    ['icon' => 'fa-hotel', 'title' => 'Hotel & Resort Reservations', 'color' => 'brand'],
                    ['icon' => 'fa-van-shuttle', 'title' => 'Transportation & Fleet Management', 'color' => 'indigo'],
                    ['icon' => 'fa-plane-arrival', 'title' => 'Airport Transfers & Local Transfers', 'color' => 'sky'],
                    ['icon' => 'fa-camera-retro', 'title' => 'Sightseeing & Excursion Management', 'color' => 'amber'],
                    ['icon' => 'fa-user-tie', 'title' => 'Experienced Local Guides', 'color' => 'emerald'],
                    ['icon' => 'fa-id-card', 'title' => 'ILP & Permit Assistance', 'color' => 'rose'],
                    ['icon' => 'fa-briefcase', 'title' => 'MICE & Corporate Travel', 'color' => 'purple'],
                    ['icon' => 'fa-graduation-cap', 'title' => 'Educational & Institutional Tours', 'color' => 'blue'],
                    ['icon' => 'fa-person-hiking', 'title' => 'Adventure & Experiential Tourism', 'color' => 'orange'],
                    ['icon' => 'fa-hippo', 'title' => 'Wildlife, Tribal, Tea & Culinary Tours', 'color' => 'teal'],
                    ['icon' => 'fa-compass', 'title' => 'Special Interest & Offbeat Tours', 'color' => 'indigo'],
                    ['icon' => 'fa-handshake', 'title' => 'Complete Ground Handling Services', 'color' => 'emerald']
                ];
            @endphp

            @foreach($services as $service)
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl flex-shrink-0">
                        <i class="fa-solid {{ $service['icon'] }}"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-sm leading-snug pt-1">{{ $service['title'] }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Why Siang Explorer Holidays & Our Approach -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <span class="text-xs font-extrabold uppercase tracking-widest text-brand-600">The On-Ground Advantage</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold font-serif text-slate-900 leading-tight">
                    Why Siang Explorer Holidays?
                </h2>
                <p class="text-slate-600 text-sm leading-relaxed">
                    The Northeast is not a destination that can be managed successfully from a desk alone. It requires local knowledge, reliable partners, practical experience and strong on-ground coordination.
                </p>
                <p class="text-slate-800 font-bold text-sm">
                    That is where we make a difference.
                </p>
                <p class="text-slate-600 text-sm leading-relaxed">
                    We work closely with hotels, transporters, local communities, guides and other destination partners to ensure smooth operations from arrival to departure. Our team understands the realities of operating in a region where terrain, weather, permits, road conditions and local regulations can influence a journey.
                </p>
            </div>

            <!-- Approach Box -->
            <div class="bg-slate-950 text-white p-8 rounded-3xl border border-slate-800 shadow-2xl space-y-6">
                <div class="border-b border-slate-800 pb-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-teal-400">Execution Strategy</span>
                    <h3 class="text-2xl font-extrabold font-serif text-white mt-1">Our Approach is Simple</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-slate-900/90 p-4 rounded-2xl border border-slate-800 space-y-1">
                        <span class="text-xs font-extrabold text-teal-400 uppercase tracking-wider">Step 01</span>
                        <h4 class="text-base font-extrabold text-white">Understand</h4>
                        <p class="text-xs text-slate-400">Listen carefully to the specific requirements & preferences.</p>
                    </div>

                    <div class="bg-slate-900/90 p-4 rounded-2xl border border-slate-800 space-y-1">
                        <span class="text-xs font-extrabold text-teal-400 uppercase tracking-wider">Step 02</span>
                        <h4 class="text-base font-extrabold text-white">Plan</h4>
                        <p class="text-xs text-slate-400">Design meticulously with ground realities & permits in mind.</p>
                    </div>

                    <div class="bg-slate-900/90 p-4 rounded-2xl border border-slate-800 space-y-1">
                        <span class="text-xs font-extrabold text-teal-400 uppercase tracking-wider">Step 03</span>
                        <h4 class="text-base font-extrabold text-white">Operate</h4>
                        <p class="text-xs text-slate-400">Manage seamless logistics, transport, guides & hotels.</p>
                    </div>

                    <div class="bg-slate-900/90 p-4 rounded-2xl border border-slate-800 space-y-1">
                        <span class="text-xs font-extrabold text-teal-400 uppercase tracking-wider">Step 04</span>
                        <h4 class="text-base font-extrabold text-white">Deliver</h4>
                        <p class="text-xs text-slate-400">Ensure an exceptional, stress-free experience on the ground.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- More Than a Tour Operator -->
        <div class="bg-gradient-to-br from-teal-900 via-slate-900 to-slate-950 text-white rounded-3xl p-8 sm:p-12 border border-teal-800/40 shadow-2xl space-y-6">
            <div class="max-w-3xl space-y-4">
                <span class="px-3.5 py-1.5 bg-teal-500/20 text-teal-300 text-xs font-extrabold uppercase tracking-widest rounded-full border border-teal-500/30 inline-block">
                    Our Philosophy & B2B Partnership
                </span>
                <h3 class="text-2xl sm:text-4xl font-extrabold font-serif text-white">More Than a Tour Operator</h3>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    We believe tourism is about creating experiences that travellers remember long after they return home.
                </p>
                <p class="text-slate-300 text-sm leading-relaxed">
                    Whether it is watching a one-horned rhinoceros in Kaziranga, experiencing the monsoon landscapes of Meghalaya, travelling through the high mountains of Arunachal Pradesh, discovering the cultural traditions of Nagaland, or exploring lesser-known villages and communities, we aim to connect travellers with the real Northeast.
                </p>
                <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 text-teal-100 text-sm font-semibold">
                    <i class="fa-solid fa-handshake-angle text-teal-400 mr-2"></i>
                    For our B2B partners, we act as an extension of their team on the ground—handling destination operations while they focus on their clients and business.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Meet Our Founder Section -->
<section class="py-20 bg-slate-950 text-white border-t border-slate-800 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#38bdf8_1px,transparent_1px)] [background-size:24px_24px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="px-4 py-1.5 bg-teal-500/20 text-teal-300 text-xs font-extrabold uppercase tracking-widest rounded-full border border-teal-500/30 inline-block">
                Leadership & Vision
            </span>
            <h2 class="text-3xl sm:text-5xl font-extrabold font-serif text-white">Meet Our Founder</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Founder Profile Sidebar / Credentials Card -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 shadow-2xl text-center space-y-6 relative overflow-hidden">
                    <div class="w-32 h-32 mx-auto rounded-full bg-gradient-to-br from-teal-500 to-brand-600 p-1 shadow-2xl">
                        <div class="w-full h-full rounded-full bg-slate-950 flex items-center justify-center text-teal-400">
                            <i class="fa-solid fa-mountain-sun text-5xl"></i>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <h3 class="text-2xl font-extrabold font-serif text-white">Tapuban Saikia</h3>
                        <p class="text-xs font-bold text-teal-400 uppercase tracking-wider">Founder, Siang Explorer Holidays</p>
                    </div>

                    <div class="border-t border-slate-800 pt-6 space-y-3">
                        <div class="flex items-center space-x-3 text-left p-3 rounded-xl bg-slate-950/60 border border-slate-800/80">
                            <i class="fa-solid fa-person-hiking text-brand-400 text-lg w-6 text-center"></i>
                            <span class="text-xs text-slate-300 font-semibold">Certified Mountaineer</span>
                        </div>
                        <div class="flex items-center space-x-3 text-left p-3 rounded-xl bg-slate-950/60 border border-slate-800/80">
                            <i class="fa-solid fa-person-running text-teal-400 text-lg w-6 text-center"></i>
                            <span class="text-xs text-slate-300 font-semibold">Extreme Athlete</span>
                        </div>
                        <div class="flex items-center space-x-3 text-left p-3 rounded-xl bg-slate-950/60 border border-slate-800/80">
                            <i class="fa-solid fa-briefcase text-indigo-400 text-lg w-6 text-center"></i>
                            <span class="text-xs text-slate-300 font-semibold">Tourism Professional</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Founder Bio & Story -->
            <div class="lg:col-span-8 space-y-10">
                <!-- Bio Intro -->
                <div class="space-y-4 text-slate-300 text-sm leading-relaxed">
                    <p class="text-base sm:text-lg text-white font-medium">
                        <strong>Tapuban Saikia</strong>, Founder of Siang Explorer Holidays, is a tourism professional, certified mountaineer and extreme athlete with a deep passion for adventure, exploration and Northeast India.
                    </p>
                    <p>
                        His journey in tourism has been shaped not only by professional experience in travel operations and destination management, but also by his personal connection with the mountains, challenging terrains and outdoor adventure.
                    </p>
                    <p>
                        As a certified mountaineer and extreme athlete, Tapuban brings a unique perspective to destination management. His experience in the outdoors has helped him understand the realities of mountain travel, adventure tourism, remote destinations, changing terrain and on-ground logistics.
                    </p>
                    <p>
                        He founded Siang Explorer Holidays with a clear vision—to create a professional and dependable destination management company that understands Northeast India from the ground up.
                    </p>
                </div>

                <!-- A Passion for the Northeast -->
                <div class="bg-slate-900/80 border border-slate-800 rounded-3xl p-8 space-y-4">
                    <h3 class="text-xl font-extrabold font-serif text-teal-300 flex items-center space-x-2">
                        <i class="fa-solid fa-compass text-teal-400"></i>
                        <span>A Passion for the Northeast</span>
                    </h3>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        For Tapuban, the Northeast is more than a tourism destination. It is a region of mountains, forests, rivers, wildlife, indigenous cultures and extraordinary people.
                    </p>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        His personal experiences across challenging landscapes have strengthened his belief that the best journeys are those that combine adventure, authenticity and responsible exploration.
                    </p>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        Today, Siang Explorer Holidays works with travel partners, tour operators, corporate groups, families and adventure travellers to design and operate customized journeys across Assam, Meghalaya, Arunachal Pradesh, Nagaland, Manipur, Mizoram, Tripura and Sikkim.
                    </p>
                </div>

                <!-- His Philosophy -->
                <div class="space-y-6">
                    <div class="p-8 rounded-3xl bg-gradient-to-r from-teal-950 to-slate-900 border border-teal-500/30 shadow-2xl relative">
                        <i class="fa-solid fa-quote-left text-teal-400/40 text-4xl mb-2 block"></i>
                        <blockquote class="text-lg sm:text-xl font-serif font-extrabold text-teal-200 leading-snug">
                            “We don't just sell the destination. We know the destination, understand the ground and make the journey happen.”
                        </blockquote>
                    </div>

                    <div class="space-y-4 text-slate-300 text-sm leading-relaxed">
                        <p>
                            Tapuban believes that successful destination management requires more than an itinerary. It requires local knowledge, practical experience, reliable partnerships and the ability to handle challenges on the ground.
                        </p>
                        <p>
                            Through Siang Explorer Holidays, his goal is to showcase the real Northeast India—beyond conventional tourism, with experiences that travellers remember and travel partners can trust.
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-800">
                        <p class="text-base font-extrabold font-serif text-white">Tapuban Saikia</p>
                        <p class="text-xs text-teal-400 font-semibold">Founder, Siang Explorer Holidays</p>
                        <p class="text-[11px] text-slate-400">Certified Mountaineer | Extreme Athlete | Tourism Professional</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- Our Commitment Section -->
<section class="py-20 bg-slate-50 border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="text-xs font-extrabold text-brand-600 uppercase tracking-widest">Our Promise</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold font-serif text-slate-900">Our Commitment</h2>
            <p class="text-slate-600 text-sm">At Siang Explorer Holidays, our commitment is to provide:</p>
        </div>

        <!-- 5 Pillars Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            @php
                $commitments = [
                    ['title' => 'Local Expertise', 'icon' => 'fa-map-location-dot', 'desc' => 'In-depth regional knowledge & native ground networks.'],
                    ['title' => 'Reliable Operations', 'icon' => 'fa-shield-halved', 'desc' => 'Punctual, safe, and flawlessly managed tours.'],
                    ['title' => 'Personalized Experiences', 'icon' => 'fa-sliders', 'desc' => 'Tailored itineraries crafted for unique preferences.'],
                    ['title' => 'Transparent Communication', 'icon' => 'fa-comments', 'desc' => 'Clear pricing, honest advice & 24/7 client support.'],
                    ['title' => 'Professional Ground Handling', 'icon' => 'fa-truck-fast', 'desc' => 'End-to-end fleet, guide & permit management.']
                ];
            @endphp

            @foreach($commitments as $item)
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm text-center space-y-3 hover:shadow-md transition-all">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-xl">
                        <i class="fa-solid {{ $item['icon'] }}"></i>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-sm">{{ $item['title'] }}</h3>
                    <p class="text-slate-500 text-xs leading-normal">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>

        <!-- Tagline Banner -->
        <div class="bg-slate-950 text-white rounded-3xl p-8 text-center border border-slate-800 shadow-2xl space-y-3 max-w-4xl mx-auto">
            <p class="text-slate-400 text-sm italic font-serif">"We don't just sell destinations."</p>
            <h3 class="text-xl sm:text-3xl font-extrabold font-serif text-teal-400 tracking-wide">
                We know the Northeast. We operate the Northeast. We live the Northeast.
            </h3>
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
