@extends('layouts.admin')

@section('title', 'Add New Bike')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-extrabold text-slate-900">Add New Rental Motorcycle / Scooter</h1>
    <a href="{{ route('admin.bikes.index') }}" class="text-xs font-bold text-slate-600 hover:underline">Back to Bikes</a>
</div>

<form action="{{ route('admin.bikes.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm max-w-3xl space-y-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Model Name</label>
            <input type="text" name="model_name" required placeholder="Royal Enfield Himalayan 411" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Bike Type</label>
            <select name="bike_type" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
                <option value="Adventure">Adventure Tourer</option>
                <option value="Cruiser">Cruiser Motorcycle</option>
                <option value="Royal Enfield">Royal Enfield Bullet / Classic</option>
                <option value="Scooter">Automatic Scooter (Activa/Jupiter)</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Engine Capacity</label>
            <input type="text" name="engine_capacity" required placeholder="411cc" value="411cc" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Daily Rent Rate (₹)</label>
            <input type="number" step="0.01" name="daily_rate" required placeholder="1800" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Security Deposit (₹)</label>
            <input type="number" step="0.01" name="deposit_amount" required placeholder="3000" value="3000" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pickup Location</label>
            <input type="text" name="location" placeholder="Manali Mall Road / Leh Airport" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-medium">
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Bike Photo</label>
        <input type="file" name="cover_image" accept="image/*" class="w-full text-xs text-slate-500">
    </div>

    <button type="submit" class="px-8 py-3 bg-brand-600 text-white font-extrabold text-xs rounded-xl shadow-md">Save Bike</button>
</form>
@endsection
