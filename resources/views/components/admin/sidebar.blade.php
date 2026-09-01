<!-- Mobile Overlay Backdrop -->
<div x-show="sidebarOpen" 
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden"></div>

<!-- Sidebar Container -->
<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 flex flex-col justify-between border-r border-slate-800 shadow-xl">
    
    <div>
        <!-- Brand Header -->
        <div class="h-16 flex items-center justify-between px-6 bg-slate-950/50 border-b border-slate-800">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                @if($logo = \App\Models\Setting::get('site_logo', '/images/logo.png'))
                    <div class="bg-white px-3 py-1.5 rounded-xl shadow-md group-hover:scale-105 transition-transform flex items-center">
                        <img src="{{ asset($logo) }}" alt="SiangExplorer Admin" class="h-7 w-auto max-w-[140px] object-contain">
                    </div>
                @else
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-600 to-teal-400 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-brand-500/20 group-hover:scale-105 transition-transform">
                        S
                    </div>
                    <div>
                        <span class="font-extrabold text-white text-lg tracking-wide block leading-none">Siang<span class="text-brand-400">Explorer</span></span>
                        <span class="text-[10px] font-semibold tracking-wider uppercase text-slate-400">Admin Console</span>
                    </div>
                @endif
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-4 space-y-1 overflow-y-auto max-h-[calc(100vh-8rem)] text-sm font-medium">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-600/30' : 'hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-chart-pie w-5 text-center text-base"></i>
                <span>Dashboard</span>
            </a>

            <!-- Hero Slider Manager -->
            <a href="{{ route('admin.hero-slides.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/hero-slides*') ? 'bg-brand-600 text-white font-semibold shadow-md shadow-brand-600/30' : 'hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-images w-5 text-center text-base text-amber-400"></i>
                <span>Hero Slider Manager</span>
            </a>


            <!-- Tour Management -->
            <div x-data="{ open: {{ request()->is('admin/tours*') || request()->is('admin/categories*') || request()->is('admin/tour-types*') ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors hover:bg-slate-800 hover:text-white {{ request()->is('admin/tours*') ? 'text-brand-400 font-semibold' : '' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fa-solid fa-compass w-5 text-center text-base"></i>
                        <span>Tour Management</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-collapse class="pl-9 pr-2 py-1 space-y-1 text-xs">
                    <a href="{{ route('admin.tours.index') }}" class="block py-1.5 px-2 rounded hover:text-white {{ request()->routeIs('admin.tours.index') ? 'text-brand-400 font-bold' : 'text-slate-400' }}">All Tours</a>
                    <a href="{{ route('admin.tours.create') }}" class="block py-1.5 px-2 rounded hover:text-white {{ request()->routeIs('admin.tours.create') ? 'text-brand-400 font-bold' : 'text-slate-400' }}">Add New Tour</a>
                    <a href="{{ route('admin.tours.categories') }}" class="block py-1.5 px-2 rounded hover:text-white {{ request()->routeIs('admin.tours.categories') ? 'text-brand-400 font-bold' : 'text-slate-400' }}">Categories</a>
                    <a href="{{ route('admin.tours.types') }}" class="block py-1.5 px-2 rounded hover:text-white {{ request()->routeIs('admin.tours.types') ? 'text-brand-400 font-bold' : 'text-slate-400' }}">Tour Types</a>
                </div>
            </div>

            <!-- Destinations -->
            <div x-data="{ open: {{ request()->is('admin/destinations*') ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors hover:bg-slate-800 hover:text-white {{ request()->is('admin/destinations*') ? 'text-brand-400 font-semibold' : '' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fa-solid fa-map-location-dot w-5 text-center text-base"></i>
                        <span>Destinations</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-collapse class="pl-9 pr-2 py-1 space-y-1 text-xs">
                    <a href="{{ route('admin.destinations.index') }}" class="block py-1.5 px-2 rounded hover:text-white {{ request()->routeIs('admin.destinations.index') ? 'text-brand-400 font-bold' : 'text-slate-400' }}">All Destinations</a>
                    <a href="{{ route('admin.destinations.create') }}" class="block py-1.5 px-2 rounded hover:text-white {{ request()->routeIs('admin.destinations.create') ? 'text-brand-400 font-bold' : 'text-slate-400' }}">Add Destination</a>
                </div>
            </div>

            <!-- Hotels & Resorts -->
            <a href="{{ route('admin.hotels.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/hotels*') ? 'bg-brand-600 text-white font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-hotel w-5 text-center text-base"></i>
                <span>Hotels & Resorts</span>
            </a>

            <!-- Transportation / Cabs -->
            <a href="{{ route('admin.transportation.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/transportation*') ? 'bg-brand-600 text-white font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-car w-5 text-center text-base"></i>
                <span>Cab Rentals</span>
            </a>

            <!-- Bike Rentals -->
            <a href="{{ route('admin.bikes.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/bikes*') ? 'bg-brand-600 text-white font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-motorcycle w-5 text-center text-base"></i>
                <span>Bike Rentals</span>
            </a>

            <!-- Bookings -->
            <a href="{{ route('admin.bookings.index') }}" 
               class="flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/bookings*') ? 'bg-brand-600 text-white font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-calendar-check w-5 text-center text-base"></i>
                    <span>Bookings</span>
                </div>
                <span class="bg-brand-500/20 text-brand-300 text-[10px] font-bold px-2 py-0.5 rounded-full">Manage</span>
            </a>

            <!-- Customers -->
            <a href="{{ route('admin.customers.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/customers*') ? 'bg-brand-600 text-white font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-users w-5 text-center text-base"></i>
                <span>Customers</span>
            </a>

            <!-- General Enquiries -->
            <a href="{{ route('admin.enquiries.index') }}" 
               class="flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.enquiries.index') ? 'bg-brand-600 text-white font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-headset w-5 text-center text-base"></i>
                    <span>General Enquiries</span>
                </div>
            </a>

            <!-- Car, Bike & Hotel Service Bookings -->
            <a href="{{ route('admin.service-enquiries.index') }}" 
               class="flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/service-enquiries*') ? 'bg-brand-600 text-white font-semibold shadow-md' : 'hover:bg-slate-800 hover:text-white' }}">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-car-side w-5 text-center text-base text-teal-400"></i>
                    <span>Cab, Bike & Hotel Requests</span>
                </div>
                <span class="bg-teal-500/20 text-teal-300 text-[10px] font-bold px-2 py-0.5 rounded-full">New</span>
            </a>


            <!-- Content Management -->
            <div x-data="{ open: {{ request()->is('admin/blog*') || request()->is('admin/pages*') || request()->is('admin/testimonials*') || request()->is('admin/faqs*') || request()->is('admin/gallery*') ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors hover:bg-slate-800 hover:text-white">
                    <div class="flex items-center space-x-3">
                        <i class="fa-solid fa-newspaper w-5 text-center text-base"></i>
                        <span>CMS & Media</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-collapse class="pl-9 pr-2 py-1 space-y-1 text-xs">
                    <a href="{{ route('admin.blog.index') }}" class="block py-1.5 px-2 rounded hover:text-white text-slate-400">Blog Posts</a>
                    <a href="{{ route('admin.pages.index') }}" class="block py-1.5 px-2 rounded hover:text-white text-slate-400">CMS Pages</a>
                    <a href="{{ route('admin.testimonials.index') }}" class="block py-1.5 px-2 rounded hover:text-white text-slate-400">Testimonials</a>
                    <a href="{{ route('admin.faqs.index') }}" class="block py-1.5 px-2 rounded hover:text-white text-slate-400">FAQs</a>
                    <a href="{{ route('admin.gallery.index') }}" class="block py-1.5 px-2 rounded hover:text-white text-slate-400">Media Gallery</a>
                </div>
            </div>

            <!-- Marketing -->
            <div x-data="{ open: {{ request()->is('admin/coupons*') || request()->is('admin/newsletter*') ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors hover:bg-slate-800 hover:text-white">
                    <div class="flex items-center space-x-3">
                        <i class="fa-solid fa-bullhorn w-5 text-center text-base"></i>
                        <span>Marketing</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-collapse class="pl-9 pr-2 py-1 space-y-1 text-xs">
                    <a href="{{ route('admin.coupons.index') }}" class="block py-1.5 px-2 rounded hover:text-white text-slate-400">Coupons & Offers</a>
                    <a href="{{ route('admin.newsletter.index') }}" class="block py-1.5 px-2 rounded hover:text-white text-slate-400">Subscribers</a>
                </div>
            </div>

            <!-- Reports -->
            <a href="{{ route('admin.reports.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/reports*') ? 'bg-brand-600 text-white font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-chart-line w-5 text-center text-base"></i>
                <span>Reports & Analytics</span>
            </a>

            <!-- Settings -->
            <a href="{{ route('admin.settings.index') }}" 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->is('admin/settings*') ? 'bg-brand-600 text-white font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                <i class="fa-solid fa-sliders w-5 text-center text-base"></i>
                <span>Site Settings</span>
            </a>
        </nav>
    </div>

    <!-- Quick Footer / Logout -->
    <div class="p-4 border-t border-slate-800 bg-slate-950/30">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3 min-w-0">
                <div class="w-8 h-8 rounded-full bg-brand-600 text-white flex items-center justify-center font-bold text-xs">
                    {{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="truncate">
                    <p class="text-xs font-semibold text-white truncate">{{ Auth::guard('admin')->user()->name ?? 'Administrator' }}</p>
                    <p class="text-[10px] text-slate-400 truncate">{{ Auth::guard('admin')->user()->email ?? '' }}</p>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" title="Logout" class="text-slate-400 hover:text-rose-400 transition-colors p-1.5 rounded-lg hover:bg-slate-800">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
