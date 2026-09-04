@extends('layouts.app')

@section('title', 'Customer Login | SiangExplorer')

@section('content')
<div class="py-20 bg-slate-100 min-h-[70vh] flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white p-8 rounded-3xl shadow-xl border border-slate-200/80 space-y-6">
        <div class="text-center space-y-2">
            @if($logo = \App\Models\Setting::get('site_logo', '/images/logo.png'))
                <div class="bg-white p-3.5 rounded-2xl shadow-md border border-slate-200 inline-block mx-auto mb-2">
                    <img src="{{ asset($logo) }}" alt="SiangExplorer" class="h-10 w-auto object-contain">
                </div>
            @else
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-brand-600 to-teal-400 mx-auto flex items-center justify-center text-white text-xl font-black shadow-md">
                    S
                </div>
            @endif
            <h1 class="text-2xl font-extrabold text-slate-900 font-serif">Customer Login</h1>
            <p class="text-xs text-slate-500 font-medium">Access your trip bookings, itinerary confirmations, and profile.</p>
        </div>

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                @error('email') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required class="w-full px-4 py-3 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                @error('password') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded text-brand-600 focus:ring-brand-500 w-4 h-4">
                    <span class="text-slate-600">Remember me</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-brand-500 to-teal-500 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-brand-500/25 transition-all">
                Sign In to Account
            </button>
        </form>

        <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500 space-y-2">
            <p>Don't have an account yet? <a href="{{ route('register') }}" class="font-extrabold text-brand-600 hover:underline">Register Now</a></p>
            <p>Are you an Administrator? <a href="{{ route('admin.login') }}" class="font-extrabold text-teal-600 hover:underline">Admin Login Portal</a></p>
        </div>
    </div>
</div>
@endsection
