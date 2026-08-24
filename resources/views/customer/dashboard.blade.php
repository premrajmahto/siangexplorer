@extends('layouts.app')

@section('title', 'Customer Dashboard | SiangExplorer')

@section('content')
<div class="bg-slate-900 text-white py-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <div>
            <span class="text-xs font-extrabold text-brand-400 uppercase tracking-widest block">Customer Portal</span>
            <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight font-serif">Welcome, {{ $user->name }}</h1>
        </div>
        <form action="{{ route('customer.logout') }}" method="POST">

            @csrf
            <button type="submit" class="px-4 py-2 bg-slate-800 hover:bg-rose-600/80 text-white text-xs font-bold rounded-xl transition-all border border-slate-700">
                Sign Out
            </button>
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase text-slate-400">Total Bookings</p>
                <h3 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $totalBookings }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-xl font-bold">
                <i class="fa-solid fa-receipt"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase text-slate-400">Confirmed Trips</p>
                <h3 class="text-2xl font-extrabold text-emerald-600 mt-1">{{ $confirmedBookings }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl font-bold">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase text-slate-400">Pending Review</p>
                <h3 class="text-2xl font-extrabold text-amber-600 mt-1">{{ $pendingBookings }}</h3>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl font-bold">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
        </div>
    </div>

    <!-- Quick Navigation Bar -->
    <div class="flex items-center space-x-3 border-b border-slate-200 pb-3 text-xs font-bold">
        <a href="{{ route('customer.dashboard') }}" class="px-4 py-2 rounded-xl bg-slate-900 text-white">Overview</a>
        <a href="{{ route('customer.bookings') }}" class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50">My Bookings</a>
        <a href="{{ route('customer.profile') }}" class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50">My Profile</a>
    </div>

    <!-- Recent Bookings Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden space-y-4 p-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <h3 class="font-extrabold text-slate-900 text-base">My Recent Tour Reservations</h3>
            <a href="{{ route('customer.bookings') }}" class="text-xs font-bold text-brand-600 hover:underline">View All</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[10px] font-bold text-slate-500 uppercase">
                    <tr>
                        <th class="px-4 py-3">Booking Ref</th>
                        <th class="px-4 py-3">Tour Package</th>
                        <th class="px-4 py-3">Travel Date</th>
                        <th class="px-4 py-3">Travelers</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentBookings as $booking)
                        <tr>
                            <td class="px-4 py-3 font-mono font-bold text-brand-700">{{ $booking->booking_reference }}</td>
                            <td class="px-4 py-3 font-bold text-slate-900">{{ $booking->tourPackage->title ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $booking->travel_date->format('d M Y') }}</td>
                            <td class="px-4 py-3">{{ $booking->num_travelers }} Persons</td>
                            <td class="px-4 py-3 font-extrabold text-slate-900">₹{{ number_format($booking->final_amount, 2) }}</td>
                            <td class="px-4 py-3">
                                @if($booking->booking_status === 'confirmed')
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold text-emerald-700 bg-emerald-50 rounded-full border border-emerald-200">Confirmed</span>
                                @elseif($booking->booking_status === 'pending')
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold text-amber-700 bg-amber-50 rounded-full border border-amber-200">Pending Review</span>
                                @else
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold text-slate-700 bg-slate-100 rounded-full">{{ ucfirst($booking->booking_status) }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('customer.bookings.show', $booking) }}" class="px-3 py-1.5 bg-slate-900 hover:bg-brand-600 text-white font-bold text-[11px] rounded-lg transition-colors">
                                    View Invoice
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-slate-400">
                                You haven't made any tour reservations yet. <a href="{{ route('tours.index') }}" class="text-brand-600 underline font-bold">Browse Packages</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
