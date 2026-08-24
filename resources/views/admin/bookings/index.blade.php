@extends('layouts.admin')

@section('title', 'Bookings Management')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Booking Management Desk</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Filter reservations, update payment status, and view customer invoices.</p>
    </div>
</div>

<div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
    <form action="{{ route('admin.bookings.index') }}" method="GET" class="w-full grid grid-cols-1 sm:grid-cols-4 gap-3">
        <div class="relative">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search ref, customer name..." class="w-full pl-9 pr-4 py-2 text-xs rounded-xl bg-slate-100 border border-slate-200">
        </div>

        <select name="status" onchange="this.form.submit()" class="px-3 py-2 text-xs rounded-xl bg-slate-100 border border-slate-200">
            <option value="">All Booking Statuses</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>

        <select name="payment_status" onchange="this.form.submit()" class="px-3 py-2 text-xs rounded-xl bg-slate-100 border border-slate-200">
            <option value="">All Payment Statuses</option>
            <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Pending Payment</option>
            <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
        </select>

        <div class="flex items-center space-x-2">
            <button type="submit" class="w-full px-4 py-2 bg-slate-900 text-white text-xs font-bold rounded-xl">Filter</button>
            @if(request('search') || request('status') || request('payment_status'))
                <a href="{{ route('admin.bookings.index') }}" class="text-xs text-slate-500 underline font-medium">Reset</a>
            @endif
        </div>
    </form>
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <table class="w-full text-left text-xs text-slate-700">
        <thead class="bg-slate-100/80 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
            <tr>
                <th class="px-4 py-3.5">Reference</th>
                <th class="px-4 py-3.5">Customer</th>
                <th class="px-4 py-3.5">Tour Package</th>
                <th class="px-4 py-3.5">Travel Date</th>
                <th class="px-4 py-3.5">Final Amount</th>
                <th class="px-4 py-3.5">Booking Status</th>
                <th class="px-4 py-3.5">Payment</th>
                <th class="px-4 py-3.5 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($bookings as $booking)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-4 py-3 font-mono font-bold text-brand-700">{{ $booking->booking_reference }}</td>
                    <td class="px-4 py-3">
                        <span class="font-bold block text-slate-800">{{ $booking->customer_name }}</span>
                        <span class="text-[10px] text-slate-400 block">{{ $booking->customer_email }}</span>
                    </td>
                    <td class="px-4 py-3 font-medium text-slate-900 max-w-[160px] truncate">{{ $booking->tourPackage->title ?? 'N/A' }}</td>
                    <td class="px-4 py-3">{{ $booking->travel_date->format('d M Y') }}</td>
                    <td class="px-4 py-3 font-extrabold text-slate-900">₹{{ number_format($booking->final_amount, 2) }}</td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="payment_status" value="{{ $booking->payment_status }}">
                            <select name="booking_status" onchange="this.form.submit()" class="text-[10px] font-bold py-1 px-2 rounded-lg border border-slate-200">
                                <option value="pending" {{ $booking->booking_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->booking_status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $booking->booking_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $booking->booking_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="booking_status" value="{{ $booking->booking_status }}">
                            <select name="payment_status" onchange="this.form.submit()" class="text-[10px] font-bold py-1 px-2 rounded-lg border border-slate-200">
                                <option value="pending" {{ $booking->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $booking->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="partially_paid" {{ $booking->payment_status === 'partially_paid' ? 'selected' : '' }}>Partially Paid</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.bookings.show', $booking) }}" class="px-3 py-1 bg-slate-900 text-white font-bold text-[10px] rounded-lg">
                            Details
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-8 text-slate-400 text-xs">No bookings recorded yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $bookings->links() }}
</div>
@endsection
