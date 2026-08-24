@extends('layouts.app')

@section('title', 'Booking Invoice ' . $booking->booking_reference . ' | SiangExplorer')

@section('content')
<div class="bg-slate-900 text-white py-12 border-b border-slate-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <div>
            <span class="text-xs font-extrabold text-brand-400 uppercase tracking-widest block">Official Confirmation Invoice</span>
            <h1 class="text-2xl sm:text-3xl font-extrabold font-serif">Reference: {{ $booking->booking_reference }}</h1>
        </div>
        <button onclick="window.print()" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white font-bold text-xs rounded-xl border border-white/20">
            <i class="fa-solid fa-print mr-1"></i> Print / Save PDF
        </button>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white p-8 sm:p-12 rounded-3xl border border-slate-200/80 shadow-xl space-y-8">
        <!-- Invoice Top Header -->
        <div class="flex flex-col sm:flex-row justify-between border-b border-slate-200 pb-6 gap-4">
            <div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-xl bg-brand-600 text-white flex items-center justify-center font-black text-sm">S</div>
                    <span class="font-extrabold text-slate-900 text-lg">Siang<span class="text-brand-600">Explorer</span></span>
                </div>
                <p class="text-xs text-slate-500 mt-1 font-medium">{{ \App\Models\Setting::get('contact_address', 'Connaught Place, New Delhi') }}</p>
                <p class="text-xs text-slate-500">Phone: {{ \App\Models\Setting::get('contact_phone', '+91 98765 43210') }}</p>
            </div>
            <div class="sm:text-right space-y-1 text-xs">
                <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider block">Reservation Summary</span>
                <p class="font-extrabold text-slate-900 text-sm font-mono">{{ $booking->booking_reference }}</p>
                <p class="text-slate-500">Date Issued: {{ $booking->created_at->format('d M Y, h:i A') }}</p>
                <div class="pt-1">
                    <span class="px-3 py-1 bg-emerald-50 text-emerald-700 font-extrabold text-[10px] uppercase rounded-full border border-emerald-200">
                        Booking Status: {{ ucfirst($booking->booking_status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Customer & Tour Info Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs bg-slate-50 p-6 rounded-2xl border border-slate-200/60">
            <div class="space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block">Billed To Customer</span>
                <p class="font-extrabold text-slate-900 text-sm">{{ $booking->customer_name }}</p>
                <p class="text-slate-600">{{ $booking->customer_email }}</p>
                <p class="text-slate-600">{{ $booking->customer_phone }}</p>
                <p class="text-slate-500">{{ $booking->customer_country }}</p>
            </div>

            <div class="space-y-1">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[10px] block">Tour Specification</span>
                <p class="font-extrabold text-slate-900 text-sm">{{ $booking->tourPackage->title ?? 'N/A' }}</p>
                <p class="text-slate-600">Travel Date: <strong class="text-slate-800">{{ $booking->travel_date->format('d M Y') }}</strong></p>
                <p class="text-slate-600">Travelers: {{ $booking->num_adults }} Adults, {{ $booking->num_children }} Children</p>
                <p class="text-slate-500">Destination: {{ $booking->tourPackage->destination->name ?? 'Worldwide' }}</p>
            </div>
        </div>

        <!-- Line Items Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-100/80 text-[10px] font-bold text-slate-500 uppercase">
                    <tr>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Unit Price</th>
                        <th class="px-4 py-3">Qty</th>
                        <th class="px-4 py-3 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($booking->items as $item)
                        <tr>
                            <td class="px-4 py-3 font-bold text-slate-900">{{ $item->item_name }}</td>
                            <td class="px-4 py-3">₹{{ number_format($item->item_price, 2) }}</td>
                            <td class="px-4 py-3">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 text-right font-bold text-slate-900">₹{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Financial Totals -->
        <div class="flex justify-end pt-4 border-t border-slate-200">
            <div class="w-full sm:w-72 space-y-2 text-xs">
                <div class="flex justify-between text-slate-600">
                    <span>Base Amount:</span>
                    <span class="font-bold text-slate-900">₹{{ number_format($booking->base_price, 2) }}</span>
                </div>
                @if($booking->discount_amount > 0)
                    <div class="flex justify-between text-emerald-600 font-bold">
                        <span>Discount ({{ $booking->coupon_code }}):</span>
                        <span>-₹{{ number_format($booking->discount_amount, 2) }}</span>
                    </div>
                @endif
                <div class="flex justify-between text-slate-600">
                    <span>Government Tax (5%):</span>
                    <span class="font-bold text-slate-900">₹{{ number_format($booking->tax_amount, 2) }}</span>
                </div>
                <div class="flex justify-between text-base font-extrabold text-slate-900 pt-2 border-t border-slate-200">
                    <span>Final Amount:</span>
                    <span class="text-brand-600">₹{{ number_format($booking->final_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Payment Status Note -->
        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-600 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-circle-info text-brand-600"></i>
                <span>Payment Status: <strong class="text-slate-900">{{ strtoupper($booking->payment_status) }}</strong></span>
            </div>
            <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number', '919876543210') }}?text=Hello%20SiangExplorer%2C%20regarding%20booking%20ref%20{{ $booking->booking_reference }}" target="_blank" class="text-brand-600 hover:underline font-bold">
                Need Help with Payment?
            </a>
        </div>
    </div>
</div>
@endsection
