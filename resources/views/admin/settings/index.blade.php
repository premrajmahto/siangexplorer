@extends('layouts.admin')

@section('title', 'System Settings')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Global System Settings</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Configure site branding, contact channels, WhatsApp, currency, tax rates, and payment gateways.</p>
    </div>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-4xl">
    @csrf
    @method('PUT')

    <!-- General Settings -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Branding & Site Info</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Website Name</label>
                <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'SiangExplorer' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tagline</label>
                <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
            </div>
        </div>
    </div>

    <!-- Contact & WhatsApp -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Contact Information & WhatsApp</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Phone Number</label>
                <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Email Address</label>
                <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">WhatsApp Number (with country code)</label>
                <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '' }}" placeholder="919876543210" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-mono">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Headquarters Address</label>
            <input type="text" name="contact_address" value="{{ $settings['contact_address'] ?? '' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
        </div>
    </div>

    <!-- Business & Currency -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Business Rules & Tax</h3>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Currency Code</label>
                <input type="text" name="currency_code" value="{{ $settings['currency_code'] ?? 'INR' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Currency Symbol</label>
                <input type="text" name="currency_symbol" value="{{ $settings['currency_symbol'] ?? '₹' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Tax Rate (%)</label>
                <input type="number" step="0.01" name="tax_percentage" value="{{ $settings['tax_percentage'] ?? '5.00' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Booking Prefix</label>
                <input type="text" name="booking_prefix" value="{{ $settings['booking_prefix'] ?? 'TRV' }}" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-mono uppercase font-bold">
            </div>
        </div>
    </div>

    <!-- Payment Gateways Integration Keys -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Payment Gateway Credentials (Stripe & Razorpay)</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Razorpay Key ID</label>
                <input type="text" name="razorpay_key" value="{{ $settings['razorpay_key'] ?? '' }}" placeholder="rzp_live_XXXXXXXX" class="w-full px-4 py-2.5 text-xs font-mono rounded-xl border border-slate-300">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Razorpay Key Secret</label>
                <input type="password" name="razorpay_secret" value="{{ $settings['razorpay_secret'] ?? '' }}" placeholder="••••••••••••••••" class="w-full px-4 py-2.5 text-xs font-mono rounded-xl border border-slate-300">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Stripe Publishable Key</label>
                <input type="text" name="stripe_key" value="{{ $settings['stripe_key'] ?? '' }}" placeholder="pk_live_XXXXXXXX" class="w-full px-4 py-2.5 text-xs font-mono rounded-xl border border-slate-300">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Stripe Secret Key</label>
                <input type="password" name="stripe_secret" value="{{ $settings['stripe_secret'] ?? '' }}" placeholder="••••••••••••••••" class="w-full px-4 py-2.5 text-xs font-mono rounded-xl border border-slate-300">
            </div>
        </div>
    </div>

    <!-- Submit -->
    <div class="flex justify-end">
        <button type="submit" class="px-8 py-3 bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-xs rounded-xl shadow-md transition-all">
            Save System Settings
        </button>
    </div>
</form>
@endsection
