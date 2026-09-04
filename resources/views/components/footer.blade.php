<footer class="bg-slate-950 text-slate-400 text-xs border-t border-slate-900 pt-16 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <!-- Top Section: Brand & Newsletter -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center bg-slate-900/60 p-8 rounded-3xl border border-slate-800/80">
            <div class="lg:col-span-2">
                <h3 class="text-white text-lg font-extrabold tracking-tight">Subscribe to Exclusive Travel Offers & Secret Deals</h3>
                <p class="text-slate-400 text-xs mt-1">Get early access to luxury tour discounts, seasonal packages, and travel guides straight to your inbox.</p>
            </div>
            <div>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    <input type="email" name="email" required placeholder="Enter your email address..." class="w-full px-4 py-3 rounded-xl bg-slate-950 border border-slate-800 text-white placeholder-slate-500 text-xs focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <button type="submit" class="px-5 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md shrink-0 transition-all">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <!-- Middle Section: Multi-column Links -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Col 1: Brand & Contact -->
            <div class="space-y-4">
                <a href="{{ url('/') }}" class="inline-block group">
                    @if($logo = \App\Models\Setting::get('site_logo', '/images/logo.png'))
                        <div class="bg-white px-3.5 py-2 rounded-2xl shadow-md border border-slate-700/50 inline-block group-hover:shadow-lg group-hover:scale-105 transition-all">
                            <img src="{{ asset($logo) }}" alt="{{ \App\Models\Setting::get('site_name', 'SiangExplorer') }}" class="h-9 w-auto max-w-[190px] object-contain">
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-brand-600 to-teal-400 flex items-center justify-center text-white font-black text-lg shadow-md">
                                S
                            </div>
                            <span class="font-extrabold text-white text-lg tracking-tight">Siang<span class="text-brand-400">Explorer</span></span>
                        </div>
                    @endif
                </a>
                <p class="text-slate-400 leading-relaxed font-normal">
                    Specialized in North East India. We also do Pan India and International Tours as well.
                </p>

                <div class="space-y-2 text-xs pt-2">
                    <p class="flex items-center space-x-2 text-slate-300">
                        <i class="fa-solid fa-location-dot text-brand-400 w-4 text-center"></i>
                        <span>{{ \App\Models\Setting::get('contact_address', 'Mazar Path, Guwahati, Assam, 781037') }}</span>

                    </p>
                    <p class="flex items-center space-x-2 text-slate-300">
                        <i class="fa-solid fa-phone text-brand-400 w-4 text-center"></i>
                        <span>{{ \App\Models\Setting::get('contact_phone', '+91 91272 11962') }}</span>
                    </p>

                    <p class="flex items-center space-x-2 text-slate-300">
                        <i class="fa-solid fa-envelope text-brand-400 w-4 text-center"></i>
                        <span>{{ \App\Models\Setting::get('contact_email', 'support@siangexplorer.com') }}</span>
                    </p>
                </div>
            </div>

            <!-- Col 2: Services -->
            <div class="space-y-3">
                <h4 class="text-white font-extrabold text-sm uppercase tracking-wider">Travel Services</h4>
                <ul class="space-y-2 font-medium">
                    <li><a href="{{ route('tours.index') }}" class="hover:text-white transition-colors">Tour Packages</a></li>
                    <li><a href="{{ route('hotels.index') }}" class="hover:text-white transition-colors">Hotels & Resorts</a></li>
                    <li><a href="{{ route('transportation.index') }}" class="hover:text-white transition-colors">Cab & Vehicle Rentals</a></li>
                    <li><a href="{{ route('bikes.index') }}" class="hover:text-white transition-colors">Motorcycle & Scooter Rentals</a></li>
                    <li><a href="{{ route('destinations.index') }}" class="hover:text-white transition-colors">Destinations Guide</a></li>
                </ul>
            </div>

            <!-- Col 3: Quick Links -->
            <div class="space-y-3">
                <h4 class="text-white font-extrabold text-sm uppercase tracking-wider">Quick Links</h4>
                <ul class="space-y-2 font-medium">
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About SiangExplorer</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact Travel Concierge</a></li>

                    <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Customer Portal Login</a></li>
                    <li><a href="{{ route('pages.show', 'privacy-policy') }}" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="{{ route('pages.show', 'terms-and-conditions') }}" class="hover:text-white transition-colors">Terms & Conditions</a></li>
                    <li><a href="{{ route('admin.login') }}" class="hover:text-white transition-colors">Admin Dashboard</a></li>
                </ul>
            </div>

            <!-- Col 4: Trust & Payments -->
            <div class="space-y-4">
                <h4 class="text-white font-extrabold text-sm uppercase tracking-wider">Accepted Payments</h4>
                <p class="text-slate-400 leading-relaxed">We support 100% secure payment transactions via Instant UPI, Net Banking, Credit/Debit Cards, Cash, and Bank Transfer.</p>
                <div class="flex items-center space-x-3 text-slate-300 text-xl pt-2">
                    <i class="fa-brands fa-cc-visa hover:text-white transition-colors"></i>
                    <i class="fa-brands fa-cc-mastercard hover:text-white transition-colors"></i>
                    <i class="fa-solid fa-building-columns hover:text-white transition-colors"></i>
                    <i class="fa-solid fa-wallet hover:text-white transition-colors"></i>
                </div>
            </div>
        </div>

        <!-- Destination Expert Banner -->
        <div class="p-6 bg-slate-900/90 rounded-2xl border border-slate-800 space-y-2 text-center">
            <p class="text-brand-400 font-extrabold text-xs uppercase tracking-widest flex items-center justify-center space-x-2">
                <i class="fa-solid fa-star text-amber-400 text-xs"></i>
                <span>Regional Tour Operations</span>
                <i class="fa-solid fa-star text-amber-400 text-xs"></i>
            </p>
            <h5 class="text-white font-black text-sm uppercase tracking-wider font-serif">
                Destination Expert For: ASSAM | ARUNACHAL | MEGHALAYA | MANIPUR | MIZORAM | NAGALAND | TRIPURA | BHUTAN | SIKKIM | DARJEELING
            </h5>
        </div>

        <!-- Bottom Copyright -->
        <div class="pt-8 border-t border-slate-900 flex flex-col sm:flex-row items-center justify-between text-slate-500 gap-4">
            <p>© {{ date('Y') }} {{ config('app.name', 'SiangExplorer') }}. All rights reserved. Built with Laravel & Tailwind CSS.</p>
            <div class="flex items-center space-x-4">
                <a href="{{ \App\Models\Setting::get('social_facebook', '#') }}" class="hover:text-white transition-colors" title="Facebook"><i class="fa-brands fa-facebook text-sm"></i></a>
                <a href="{{ \App\Models\Setting::get('social_instagram', '#') }}" class="hover:text-white transition-colors" title="Instagram"><i class="fa-brands fa-instagram text-sm"></i></a>
                <a href="{{ \App\Models\Setting::get('social_youtube', '#') }}" class="hover:text-white transition-colors" title="YouTube"><i class="fa-brands fa-youtube text-sm"></i></a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp_number', '919127211962')) }}" target="_blank" class="hover:text-emerald-400 transition-colors" title="WhatsApp"><i class="fa-brands fa-whatsapp text-sm"></i></a>

            </div>
        </div>
    </div>
</footer>
