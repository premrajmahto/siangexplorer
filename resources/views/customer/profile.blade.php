@extends('layouts.app')

@section('title', 'My Profile | SiangExplorer')

@section('content')
<div class="bg-slate-900 text-white py-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-xs font-extrabold text-brand-400 uppercase tracking-widest block">Customer Portal</span>
        <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight font-serif">Manage Profile</h1>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
    <div class="flex items-center space-x-3 border-b border-slate-200 pb-3 text-xs font-bold">
        <a href="{{ route('customer.dashboard') }}" class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50">Overview</a>
        <a href="{{ route('customer.bookings') }}" class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50">My Bookings</a>
        <a href="{{ route('customer.profile') }}" class="px-4 py-2 rounded-xl bg-slate-900 text-white">My Profile</a>
    </div>

    <div class="max-w-2xl bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-6">
        <h3 class="font-extrabold text-slate-900 text-base border-b border-slate-100 pb-3">Personal & Security Details</h3>

        <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Phone Number</label>
                <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" required class="w-full px-4 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Address</label>
                <input type="text" name="address" value="{{ old('address', $user->address) }}" placeholder="Street address..." class="w-full px-4 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Country</label>
                <input type="text" name="country" value="{{ old('country', $user->country ?? 'India') }}" class="w-full px-4 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
            </div>

            <div class="pt-4 border-t border-slate-100 space-y-4">
                <h4 class="font-extrabold text-slate-900 text-xs uppercase tracking-wider">Change Password (Optional)</h4>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">New Password</label>
                    <input type="password" name="password" placeholder="Leave blank to keep current password" class="w-full px-4 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" placeholder="Re-enter new password" class="w-full px-4 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
                </div>
            </div>

            <button type="submit" class="px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-xs rounded-xl shadow-md transition-all">
                Save Changes
            </button>
        </form>
    </div>
</div>
@endsection
