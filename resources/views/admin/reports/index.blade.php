@extends('layouts.admin')

@section('title', 'Reports & Revenue Analytics')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Reports & Analytics</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Filter booking volume and revenue performance by custom date range.</p>
    </div>
</div>

<div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm mb-6">
    <form action="{{ route('admin.reports.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Start Date</label>
            <input type="date" name="start_date" value="{{ $startDate }}" class="px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">End Date</label>
            <input type="date" name="end_date" value="{{ $endDate }}" class="px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
        </div>
        <button type="submit" class="px-6 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl shadow-md">
            Generate Report
        </button>
    </form>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
    <x-admin.stat-card title="Total Bookings in Range" value="{{ $totalBookings }}" icon="fa-receipt" bg="bg-teal-600" />
    <x-admin.stat-card title="Confirmed Bookings" value="{{ $confirmedBookings }}" icon="fa-circle-check" bg="bg-emerald-600" />
    <x-admin.stat-card title="Period Revenue" value="₹{{ number_format($totalRevenue, 2) }}" icon="fa-indian-rupee-sign" bg="bg-indigo-600" />
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-slate-100 font-extrabold text-slate-900 text-sm">
        Filtered Bookings Log
    </div>
    <table class="w-full text-left text-xs text-slate-700">
        <thead class="bg-slate-50 text-[10px] font-bold text-slate-500 uppercase">
            <tr>
                <th class="px-4 py-3">Reference</th>
                <th class="px-4 py-3">Customer</th>
                <th class="px-4 py-3">Tour Package</th>
                <th class="px-4 py-3">Travel Date</th>
                <th class="px-4 py-3">Amount</th>
                <th class="px-4 py-3">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($bookingsList as $booking)
                <tr>
                    <td class="px-4 py-3 font-mono font-bold text-brand-700">{{ $booking->booking_reference }}</td>
                    <td class="px-4 py-3 font-bold text-slate-900">{{ $booking->customer_name }}</td>
                    <td class="px-4 py-3 font-medium text-slate-800">{{ $booking->tourPackage->title ?? 'N/A' }}</td>
                    <td class="px-4 py-3">{{ $booking->travel_date->format('d M Y') }}</td>
                    <td class="px-4 py-3 font-extrabold text-slate-900">₹{{ number_format($booking->final_amount, 2) }}</td>
                    <td class="px-4 py-3 font-bold uppercase text-[10px]">{{ $booking->booking_status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-slate-400">No bookings recorded for selected date range.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
