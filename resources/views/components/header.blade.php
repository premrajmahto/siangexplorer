<header class="bg-slate-900 text-white sticky top-0 z-50 border-b border-slate-800/80 backdrop-blur-md bg-slate-900/95">
    <!-- Top Utility Bar -->
    <div class="bg-slate-950 text-slate-400 text-xs border-b border-slate-800/60 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <span class="flex items-center space-x-2">
                    <i class="fa-solid fa-phone text-brand-400 text-[10px]"></i>
                    <span>{{ \App\Models\Setting::get('contact_phone', '+91 91272 11962') }}</span>

                </span>
                <span class="flex items-center space-x-2">
                    <i class="fa-solid fa-envelope text-brand-400 text-[10px]"></i>
                    <span>{{ \App\Models\Setting::get('contact_email', 'support@siangexplorer.com') }}</span>
                </span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('tours.index') }}" class="hover:text-brand-400 transition-colors">Special Offers</a>
                <span class="text-slate-700">|</span>
                @auth
                    <a href="{{ route('customer.dashboard') }}" class="hover:text-brand-400 transition-colors font-bold text-white">My Account</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-brand-400 transition-colors">Customer Login</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" class="flex items-center group">
            @if($logo = \App\Models\Setting::get('site_logo', '/images/logo.png'))
                <div class="bg-white/95 backdrop-blur-md px-3.5 py-1.5 rounded-2xl shadow-md border border-white/20 group-hover:bg-white group-hover:scale-105 transition-all flex items-center">
                    <img src="{{ asset($logo) }}" alt="{{ \App\Models\Setting::get('site_name', 'SiangExplorer') }}" class="h-9 w-auto max-w-[180px] object-contain">
                </div>
            @else
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-brand-600 to-teal-400 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-brand-500/20 group-hover:scale-105 transition-transform">
                    S
                </div>
                <div class="ml-3">
                    <span class="font-extrabold text-white text-xl tracking-tight block leading-none">Siang<span class="text-brand-400">Explorer</span></span>
                </div>
            @endif
        </a>

        <!-- Desktop Menu Links -->
        <nav class="hidden lg:flex items-center space-x-6 text-xs font-bold text-slate-300">
            <a href="{{ url('/') }}" class="hover:text-brand-400 transition-colors {{ request()->is('/') ? 'text-brand-400 font-extrabold' : '' }}">Home</a>
            <a href="{{ route('destinations.index') }}" class="hover:text-brand-400 transition-colors {{ request()->is('destinations*') ? 'text-brand-400 font-extrabold' : '' }}">Destinations</a>
            <a href="{{ route('tours.index') }}" class="hover:text-brand-400 transition-colors {{ request()->is('tours*') ? 'text-brand-400 font-extrabold' : '' }}">Tour Packages</a>
            <a href="{{ route('hotels.index') }}" class="hover:text-brand-400 transition-colors {{ request()->is('hotels*') ? 'text-brand-400 font-extrabold' : '' }}">Hotels</a>
            <a href="{{ route('transportation.index') }}" class="hover:text-brand-400 transition-colors {{ request()->is('transportation*') ? 'text-brand-400 font-extrabold' : '' }}">Cab Rentals</a>
            <a href="{{ route('bikes.index') }}" class="hover:text-brand-400 transition-colors {{ request()->is('bikes*') ? 'text-brand-400 font-extrabold' : '' }}">Bike Rentals</a>
            <a href="{{ route('about') }}" class="hover:text-brand-400 transition-colors {{ request()->is('about*') ? 'text-brand-400 font-extrabold' : '' }}">About Us</a>
            <a href="{{ route('contact') }}" class="hover:text-brand-400 transition-colors {{ request()->is('contact*') ? 'text-brand-400 font-extrabold' : '' }}">Contact</a>

        </nav>

        <!-- Right Desktop CTA Buttons -->
        <div class="hidden lg:flex items-center space-x-3">
            @auth
                <a href="{{ route('customer.dashboard') }}" class="px-3.5 py-2 bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs rounded-xl border border-slate-700 transition-all flex items-center space-x-2">
                    <i class="fa-solid fa-user-gear text-brand-400"></i>
                    <span>Dashboard</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-xs font-bold text-slate-300 hover:text-white px-3 py-2 transition-colors">
                    Login
                </a>
            @endauth

            <a href="{{ route('tours.index') }}" class="px-4 py-2.5 bg-gradient-to-r from-brand-500 to-teal-500 hover:from-brand-600 hover:to-teal-600 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-brand-500/25 transition-all transform hover:-translate-y-0.5">
                Book Now
            </a>
        </div>

        <!-- Mobile Hamburger Button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800">
            <i class="fa-solid fa-bars text-xl" x-show="!mobileMenuOpen"></i>
            <i class="fa-solid fa-xmark text-xl" x-show="mobileMenuOpen"></i>
        </button>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div x-show="mobileMenuOpen" 
         x-transition 
         class="lg:hidden bg-slate-900 border-b border-slate-800 px-4 pt-3 pb-6 space-y-3">
        <a href="{{ url('/') }}" class="block py-2 text-sm font-semibold text-white">Home</a>
        <a href="{{ route('destinations.index') }}" class="block py-2 text-sm font-semibold text-slate-300 hover:text-white">Destinations</a>
        <a href="{{ route('tours.index') }}" class="block py-2 text-sm font-semibold text-slate-300 hover:text-white">Tour Packages</a>
        <a href="{{ route('hotels.index') }}" class="block py-2 text-sm font-semibold text-slate-300 hover:text-white">Hotels & Resorts</a>
        <a href="{{ route('transportation.index') }}" class="block py-2 text-sm font-semibold text-slate-300 hover:text-white">Cab & Vehicle Rentals</a>
        <a href="{{ route('bikes.index') }}" class="block py-2 text-sm font-semibold text-slate-300 hover:text-white">Motorcycle & Bike Rentals</a>
        <a href="{{ route('about') }}" class="block py-2 text-sm font-semibold text-slate-300 hover:text-white">About Us</a>
        <a href="{{ route('contact') }}" class="block py-2 text-sm font-semibold text-slate-300 hover:text-white">Contact Us</a>


        <div class="pt-4 border-t border-slate-800 flex flex-col space-y-2">
            @auth
                <a href="{{ route('customer.dashboard') }}" class="w-full text-center py-2.5 bg-slate-800 text-white font-bold text-xs rounded-xl">My Account Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="w-full text-center py-2.5 bg-slate-800 text-white font-bold text-xs rounded-xl">Customer Login</a>
            @endauth
            <a href="{{ route('tours.index') }}" class="w-full text-center py-2.5 bg-brand-600 text-white font-bold text-xs rounded-xl shadow-md">Book Now</a>
        </div>
    </div>
</header>
