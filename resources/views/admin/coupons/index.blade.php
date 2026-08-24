@extends('layouts.admin')

@section('title', 'Promo Coupons & Offers')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Coupons & Special Offers</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Manage percentage and fixed promo discounts for customer bookings.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm h-fit space-y-4">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Create New Coupon</h3>

        <form action="{{ route('admin.coupons.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Coupon Code</label>
                <input type="text" name="code" required placeholder="e.g. EXPLORE5000" class="w-full px-3.5 py-2 text-xs font-mono uppercase rounded-xl border border-slate-300">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Discount Type</label>
                <select name="discount_type" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 font-bold">
                    <option value="percentage">Percentage (%)</option>
                    <option value="fixed">Fixed Amount (₹)</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Percentage (%)</label>
                    <input type="number" step="0.01" name="percentage" placeholder="10.00" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Fixed Rate (₹)</label>
                    <input type="number" step="0.01" name="fixed_amount" placeholder="5000.00" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Min Booking Amount (₹)</label>
                <input type="number" step="0.01" name="min_booking_amount" placeholder="20000.00" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300">
            </div>

            <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md">
                Create Coupon
            </button>
        </form>
    </div>

    <div class="md:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <table class="w-full text-left text-xs text-slate-700">
            <thead class="bg-slate-100/80 text-[10px] font-bold text-slate-500 uppercase">
                <tr>
                    <th class="px-4 py-3">Code</th>
                    <th class="px-4 py-3">Type & Discount</th>
                    <th class="px-4 py-3">Min Order</th>
                    <th class="px-4 py-3">Times Used</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($coupons as $coupon)
                    <tr>
                        <td class="px-4 py-3 font-mono font-bold text-brand-700">{{ $coupon->code }}</td>
                        <td class="px-4 py-3 font-bold text-slate-900">
                            @if($coupon->discount_type === 'percentage')
                                {{ $coupon->percentage }}% Off
                            @else
                                ₹{{ number_format($coupon->fixed_amount, 2) }} Off
                            @endif
                        </td>
                        <td class="px-4 py-3 text-slate-600">₹{{ number_format($coupon->min_booking_amount, 2) }}</td>
                        <td class="px-4 py-3 font-bold text-slate-800">{{ $coupon->times_used }} times</td>
                        <td class="px-4 py-3 text-right">
                            <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-500 hover:text-rose-700 text-xs font-bold">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-slate-400">No active coupons created.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
