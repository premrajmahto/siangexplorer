@extends('layouts.app')

@section('title', 'Contact Travel Concierge | SiangExplorer')

@section('content')
<div class="bg-slate-900 text-white py-16 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-3">
        <span class="text-xs font-extrabold uppercase tracking-widest text-brand-400">Get In Touch</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight font-serif">Contact Our Concierge</h1>
        <p class="text-slate-400 text-xs sm:text-sm max-w-xl">Specialized in North East India. We also do Pan India and International Tours as well.</p>

    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Contact Info Cards -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-xl font-bold">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <h3 class="font-extrabold text-slate-900 text-base">Phone & WhatsApp</h3>
                <p class="text-xs text-slate-500 font-medium">{{ \App\Models\Setting::get('contact_phone', '+91 91272 11962') }}</p>

            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl font-bold">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <h3 class="font-extrabold text-slate-900 text-base">Email Support</h3>
                <p class="text-xs text-slate-500 font-medium">{{ \App\Models\Setting::get('contact_email', 'support@siangexplorer.com') }}</p>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl font-bold">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <h3 class="font-extrabold text-slate-900 text-base">Headquarters</h3>
                <p class="text-xs text-slate-500 font-medium leading-relaxed">{{ \App\Models\Setting::get('contact_address', 'Mazar Path, Guwahati, Assam, 781037') }}</p>

            </div>
        </div>

        <!-- Contact Form -->
        <div class="lg:col-span-2 bg-white p-8 rounded-3xl border border-slate-200/80 shadow-xl space-y-6">
            <h2 class="text-2xl font-extrabold text-slate-900 font-serif">Send Us A Message</h2>

            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Your Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" required placeholder="John Doe" class="w-full px-4 py-3 text-xs rounded-xl bg-slate-50 border border-slate-200">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Email Address <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" required placeholder="john@example.com" class="w-full px-4 py-3 text-xs rounded-xl bg-slate-50 border border-slate-200">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Phone Number</label>
                        <input type="tel" name="phone" placeholder="+91 98765 43210" class="w-full px-4 py-3 text-xs rounded-xl bg-slate-50 border border-slate-200">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Subject</label>
                        <input type="text" name="subject" placeholder="Inquiry about Kashmir Holiday" class="w-full px-4 py-3 text-xs rounded-xl bg-slate-50 border border-slate-200">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Your Message <span class="text-rose-500">*</span></label>
                    <textarea name="message" rows="5" required placeholder="Tell us how we can assist your travel plans..." class="w-full px-4 py-3 text-xs rounded-xl bg-slate-50 border border-slate-200"></textarea>
                </div>

                <button type="submit" class="px-8 py-4 bg-gradient-to-r from-brand-500 to-teal-500 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-brand-500/30 transition-all hover:from-brand-600 hover:to-teal-600">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
