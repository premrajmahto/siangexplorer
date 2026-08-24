@extends('layouts.app')

@section('title', 'My Bookings | SiangExplorer')

@section('content')
<div class="bg-slate-900 text-white py-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-extrabold text-brand-400 uppercase tracking-widest block">Customer Portal</span>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight font-serif">My Tour Bookings</h1>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
    <div class="flex items-center space-x-3 border-b border-slate-200 pb-3 text-xs font-bold">
        <a href="{{ route('customer.dashboard') }}" class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50">Overview</a>
        <a href="{{ route('customer.bookings') }}" class="px-4 py-2 rounded-xl bg-slate-900 text-white">My Bookings</a>
        <a href="{{ route('customer.profile') }}" class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50">My Profile</a>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[10px] font-bold text-slate-500 uppercase">
                    <tr>
                        <th class="px-4 py-3">Booking Ref</th>
                        <th class="px-4 py-3">Tour Package</th>
                        <th class="px-4 py-3">Travel Date</th>
                        <th class="px-4 py-3">Travelers</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Booking Status</th>
                        <th class="px-4 py-3">Payment Status</th>
                        <th class="px-4 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($bookings as $booking)
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
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold text-amber-700 bg-amber-50 rounded-full border border-amber-200">Pending</span>
                                @else
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold text-slate-700 bg-slate-100 rounded-full">{{ ucfirst($booking->booking_status) }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($booking->payment_status === 'paid')
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold text-emerald-700 bg-emerald-50 rounded-full">Paid</span>
                                @else
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold text-rose-700 bg-rose-50 rounded-full">Pending</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('customer.bookings.show', $booking) }}" class="px-3 py-1.5 bg-slate-900 hover:bg-brand-600 text-white font-bold text-[11px] rounded-lg transition-colors">
                                    Invoice
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-8 text-slate-400">
                                No tour reservations recorded under your account.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection
