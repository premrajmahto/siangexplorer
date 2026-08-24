@extends('layouts.app')

@section('title', 'Create Account | SiangExplorer')

@section('content')
<div class="py-20 bg-slate-100 min-h-[70vh] flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white p-8 rounded-3xl shadow-xl border border-slate-200/80 space-y-6">
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-brand-600 to-teal-400 mx-auto flex items-center justify-center text-white text-xl font-black shadow-md">
                S
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 font-serif">Create Customer Account</h1>
            <p class="text-xs text-slate-500 font-medium">Join SiangExplorer to track bookings and manage travel profile.</p>
        </div>

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Full Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="John Doe" class="w-full px-4 py-3 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                @error('name') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="john@example.com" class="w-full px-4 py-3 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                @error('email') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Phone Number</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="+91 98765 43210" class="w-full px-4 py-3 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                @error('phone') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required placeholder="Minimum 8 characters" class="w-full px-4 py-3 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                @error('password') <p class="text-rose-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Re-enter password" class="w-full px-4 py-3 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
            </div>

            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-brand-500 to-teal-500 text-white font-extrabold text-xs rounded-xl shadow-lg shadow-brand-500/25 transition-all">
                Register Account
            </button>
        </form>

        <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500">
            Already have an account? <a href="{{ route('login') }}" class="font-extrabold text-brand-600 hover:underline">Sign In</a>
        </div>
    </div>
</div>
@endsection
