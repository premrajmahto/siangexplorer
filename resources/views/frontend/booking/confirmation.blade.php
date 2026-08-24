@extends('layouts.app')

@section('title', 'Booking Submitted | SiangExplorer')

@section('content')
<div class="py-20 bg-slate-100 min-h-[70vh] flex items-center justify-center px-4">
    <div class="w-full max-w-2xl bg-white p-8 sm:p-12 rounded-3xl shadow-xl border border-slate-200/80 text-center space-y-6">
        <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-4xl mx-auto shadow-inner">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <div class="space-y-2">
            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-extrabold rounded-full border border-emerald-200 uppercase tracking-widest">
                Booking Request Received
            </span>
            <h1 class="text-3xl font-extrabold text-slate-900 font-serif">Thank You, {{ $booking->customer_name }}!</h1>
            <p class="text-xs text-slate-500 max-w-md mx-auto">Your tour package booking request has been created and logged in our travel database system.</p>
        </div>

        <!-- Booking Details Card -->
        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/60 text-left text-xs space-y-3">
            <div class="flex justify-between border-b border-slate-200/80 pb-2">
                <span class="font-bold text-slate-500 uppercase text-[10px]">Booking Reference</span>
                <span class="font-extrabold font-mono text-brand-700 text-sm">{{ $booking->booking_reference }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-200/80 pb-2">
                <span class="font-bold text-slate-500 uppercase text-[10px]">Package Reserved</span>
                <span class="font-bold text-slate-900">{{ $booking->tourPackage->title ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-200/80 pb-2">
                <span class="font-bold text-slate-500 uppercase text-[10px]">Travel Date</span>
                <span class="font-bold text-slate-800">{{ $booking->travel_date->format('d M Y') }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-200/80 pb-2">
                <span class="font-bold text-slate-500 uppercase text-[10px]">Total Amount</span>
                <span class="font-black text-slate-900 text-sm">₹{{ number_format($booking->final_amount, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-bold text-slate-500 uppercase text-[10px]">Booking Status</span>
                <span class="font-extrabold text-amber-600 bg-amber-50 px-2 py-0.5 rounded text-[10px] uppercase">Pending Confirmation</span>
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
            <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number', '919876543210') }}?text=Hello%20SiangExplorer%2C%20I%20have%20just%20submitted%20booking%20ref%20{{ $booking->booking_reference }}" 
               target="_blank" 
               class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs rounded-xl shadow-md flex items-center space-x-2">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                <span>Confirm via WhatsApp</span>
            </a>

            @auth
                <a href="{{ route('customer.bookings.show', $booking) }}" class="px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl shadow-md">
                    View Complete Invoice
                </a>
            @else
                <a href="{{ route('login') }}" class="px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl shadow-md">
                    Sign In to Track Booking
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection
