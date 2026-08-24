@extends('layouts.app')

@section('title', 'Self-Drive Motorcycle & Scooter Rentals | SiangExplorer')

@section('content')
<!-- Header Banner -->
<div class="bg-slate-950 text-white py-16 border-b border-slate-800 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4 text-center">
        <span class="px-3.5 py-1.5 rounded-full bg-amber-500/20 text-amber-400 font-extrabold text-xs uppercase tracking-widest border border-amber-500/30">
            <i class="fa-solid fa-motorcycle mr-1.5"></i> Himalayan Fleet Expeditions
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold font-serif tracking-tight">Self-Drive Bike & Scooter Rentals</h1>
        <p class="text-slate-400 text-xs sm:text-sm max-w-2xl mx-auto">Rent Royal Enfield Himalayan 411cc, Classic 350, and automatic scooters for mountain expeditions and local exploration.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($bikes as $bike)
            <div class="bg-white rounded-3xl border border-slate-200/80 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between" x-data="{ showModal: false }">
                <div>
                    <!-- Bike Cover Image -->
                    <div class="h-56 relative overflow-hidden bg-slate-900">
                        <img src="{{ $bike->cover_image_url }}" alt="{{ $bike->model_name }}" class="w-full h-full object-cover">
                        <div class="absolute top-3 right-3 bg-slate-950/80 backdrop-blur-md text-amber-400 text-[10px] font-extrabold px-3 py-1 rounded-full border border-amber-500/30 uppercase tracking-wider">
                            {{ $bike->engine_capacity }}
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="p-6 space-y-4">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-[10px] font-extrabold text-amber-600 uppercase tracking-wider block">{{ $bike->bike_type }}</span>
                                <h3 class="font-extrabold text-slate-900 text-lg font-serif">{{ $bike->model_name }}</h3>
                            </div>
                            <div class="text-right">
                                <span class="text-lg font-black text-slate-900">₹{{ number_format($bike->daily_rate, 0) }}</span>
                                <span class="text-[10px] font-bold text-slate-400 block">/ day</span>
                            </div>
                        </div>

                        <p class="text-slate-500 text-xs line-clamp-2 leading-relaxed">{{ $bike->description }}</p>

                        <div class="grid grid-cols-2 gap-2 text-[11px] font-bold text-slate-700 bg-slate-50 p-3 rounded-2xl border border-slate-100">
                            <div><i class="fa-solid fa-gauge text-amber-500 mr-1.5"></i> {{ $bike->engine_capacity }}</div>
                            <div><i class="fa-solid fa-shield text-amber-500 mr-1.5"></i> {{ $bike->helmet_included ? 'Helmets Included' : 'Standard Gear' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Footer CTA Button -->
                <div class="p-6 pt-0">
                    <button @click="showModal = true" class="w-full py-3.5 bg-slate-900 hover:bg-amber-500 hover:text-slate-950 text-white font-extrabold text-xs rounded-2xl transition-all flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-key"></i>
                        <span>Book Bike Rental</span>
                    </button>

                    <!-- Booking Request Modal -->
                    <div x-show="showModal" 
                         x-transition 
                         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm" 
                         style="display: none;">
                        <div @click.away="showModal = false" class="bg-white rounded-3xl p-5 sm:p-6 max-w-lg w-full max-h-[90vh] overflow-y-auto shadow-2xl space-y-4">
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <h3 class="font-extrabold text-slate-900 text-base sm:text-lg pr-2 leading-tight">Rent {{ $bike->model_name }}</h3>
                                <button @click="showModal = false" class="text-slate-400 hover:text-slate-700 p-1.5 rounded-xl hover:bg-slate-100 transition-colors">
                                    <i class="fa-solid fa-xmark text-lg"></i>
                                </button>
                            </div>

                            <form action="{{ route('bikes.book', $bike) }}" method="POST" class="space-y-3 text-left">
                                @csrf

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Your Full Name</label>
                                        <input type="text" name="customer_name" required placeholder="John Doe" class="w-full px-3.5 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 font-medium">
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Phone Number</label>
                                        <input type="tel" name="customer_phone" required placeholder="+91 91272 11962" class="w-full px-3.5 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 font-medium">

                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Email Address</label>
                                        <input type="email" name="customer_email" required placeholder="john@example.com" class="w-full px-3.5 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 font-medium">
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Pickup Date</label>
                                        <input type="date" name="start_date" min="{{ date('Y-m-d') }}" required class="w-full px-3.5 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 font-bold">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Pickup City / Hub Location</label>
                                    <input type="text" name="pickup_location" placeholder="e.g. Manali Mall Road Hub" class="w-full px-3.5 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 font-medium">
                                </div>

                                <div>
                                    <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Special Requirements / Notes</label>
                                    <input type="text" name="notes" placeholder="Extra helmet needed, riding gloves, etc." class="w-full px-3.5 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-amber-500 font-medium">
                                </div>

                                <div class="pt-2">
                                    <button type="submit" class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 font-black text-xs rounded-xl shadow-lg shadow-amber-500/20 transition-all">
                                        Request Bike Reservation
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-white rounded-3xl border border-slate-200 p-8 space-y-3">
                <i class="fa-solid fa-motorcycle text-4xl text-slate-300"></i>
                <h3 class="font-extrabold text-slate-700">No Motorcycles Listed</h3>
                <p class="text-xs text-slate-500">Rental bikes updates are in progress.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
