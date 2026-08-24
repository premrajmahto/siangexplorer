@extends('layouts.admin')

@section('title', 'Booking Details - ' . $booking->booking_reference)

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Reservation Details</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Booking Reference: <span class="font-mono font-bold text-brand-600">{{ $booking->booking_reference }}</span></p>
    </div>
    <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-600 hover:text-slate-900 px-3.5 py-2 rounded-xl bg-white border border-slate-200">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Back to Bookings</span>
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Tour Specification</h3>
            <div class="flex items-center space-x-4">
                <img src="{{ $booking->tourPackage->cover_image_url }}" class="w-16 h-16 rounded-xl object-cover">

                <div>
                    <h4 class="font-extrabold text-slate-900 text-base">{{ $booking->tourPackage->title ?? 'N/A' }}</h4>
                    <p class="text-xs text-slate-500">Destination: {{ $booking->tourPackage->destination->name ?? 'N/A' }}</p>
                    <p class="text-xs text-slate-500">Travel Date: <strong class="text-slate-800">{{ $booking->travel_date->format('d M Y') }}</strong></p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Line Items Breakdown</h3>
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[10px] font-bold uppercase">
                    <tr>
                        <th class="px-4 py-2">Item</th>
                        <th class="px-4 py-2">Rate</th>
                        <th class="px-4 py-2">Qty</th>
                        <th class="px-4 py-2 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($booking->items as $item)
                        <tr>
                            <td class="px-4 py-2.5 font-bold text-slate-900">{{ $item->item_name }}</td>
                            <td class="px-4 py-2.5">₹{{ number_format($item->item_price, 2) }}</td>
                            <td class="px-4 py-2.5">{{ $item->quantity }}</td>
                            <td class="px-4 py-2.5 text-right font-bold">₹{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Customer Information</h3>
            <div class="text-xs space-y-2">
                <p><strong>Name:</strong> {{ $booking->customer_name }}</p>
                <p><strong>Email:</strong> {{ $booking->customer_email }}</p>
                <p><strong>Phone:</strong> {{ $booking->customer_phone }}</p>
                <p><strong>Country:</strong> {{ $booking->customer_country }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Update Status</h3>
            <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Booking Status</label>
                    <select name="booking_status" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 font-bold">
                        <option value="pending" {{ $booking->booking_status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $booking->booking_status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="completed" {{ $booking->booking_status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $booking->booking_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Payment Status</label>
                    <select name="payment_status" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 font-bold">
                        <option value="pending" {{ $booking->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $booking->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="partially_paid" {{ $booking->payment_status === 'partially_paid' ? 'selected' : '' }}>Partially Paid</option>
                    </select>
                </div>

                <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md">
                    Update Status
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
