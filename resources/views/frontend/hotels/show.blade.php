@extends('layouts.app')

@section('title', $hotel->name . ' | SiangExplorer')

@section('content')
<div class="bg-slate-950 text-white py-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        <div class="flex items-center space-x-2 text-xs text-slate-400">
            <a href="{{ route('hotels.index') }}" class="hover:text-white">Hotels</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <span>{{ $hotel->destination->name ?? 'Worldwide' }}</span>
        </div>
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <span class="px-3 py-1 bg-brand-500/20 text-brand-400 text-[10px] font-extrabold rounded-full border border-brand-500/30 uppercase tracking-widest">{{ $hotel->category }}</span>
                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight font-serif mt-2">{{ $hotel->name }}</h1>
                <p class="text-slate-400 text-xs sm:text-sm mt-1">
                    <i class="fa-solid fa-location-dot text-brand-400 mr-1.5"></i> {{ $hotel->address ?? ($hotel->destination->name ?? 'Prime Location') }}
                </p>
            </div>
            <div class="text-right">
                <span class="text-3xl font-black text-white">₹{{ number_format($hotel->price_per_night) }}</span>
                <span class="text-xs text-slate-400 block">/ night</span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2 space-y-8">
            <!-- Cover Image -->
            <div class="h-96 rounded-3xl overflow-hidden bg-slate-900 border border-slate-200 shadow-md">
                <img src="{{ $hotel->cover_image_url }}" alt="{{ $hotel->name }}" class="w-full h-full object-cover">
            </div>

            <!-- Description -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
                <h2 class="text-xl font-extrabold text-slate-900 font-serif">Property Description</h2>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">{{ $hotel->description }}</p>
            </div>

            <!-- Amenities -->
            @if(!empty($hotel->amenities_list))
                <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
                    <h2 class="text-xl font-extrabold text-slate-900 font-serif">Featured Amenities</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach($hotel->amenities_list as $amenity)
                            <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100 text-xs font-bold text-slate-800 flex items-center space-x-2">
                                <i class="fa-solid fa-circle-check text-emerald-500"></i>
                                <span>{{ $amenity }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

        <div class="space-y-6">
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-xl space-y-6 sticky top-24">
                <div class="border-b border-slate-100 pb-4">
                    <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider block">Price Per Night</span>
                    <span class="text-3xl font-black text-slate-900">₹{{ number_format($hotel->price_per_night) }}</span>
                </div>

                <form action="{{ route('hotels.book', $hotel) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Your Full Name</label>
                        <input type="text" name="customer_name" required placeholder="John Doe" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Phone Number</label>
                        <input type="tel" name="customer_phone" required placeholder="+91 98765 43210" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Email Address</label>
                        <input type="email" name="customer_email" required placeholder="john@example.com" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Check-in Date</label>
                        <input type="date" name="start_date" min="{{ date('Y-m-d') }}" required class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200 font-bold">
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Check-out Date</label>
                        <input type="date" name="end_date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200 font-bold">
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Number of Guests</label>
                        <input type="number" name="num_guests" min="1" value="2" required class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200 font-bold">
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Special Notes / Room Preference</label>
                        <input type="text" name="notes" placeholder="King bed, high floor, airport transfer..." class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-xs rounded-xl shadow-lg transition-all">
                        Request Hotel Reservation
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
