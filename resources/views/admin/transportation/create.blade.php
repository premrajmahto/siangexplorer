@extends('layouts.admin')

@section('title', 'Add New Vehicle')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-extrabold text-slate-900">Add New Transportation Vehicle</h1>
    <a href="{{ route('admin.transportation.index') }}" class="text-xs font-bold text-slate-600 hover:underline">Back to Vehicles</a>
</div>

<form action="{{ route('admin.transportation.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm max-w-3xl space-y-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Vehicle Name / Model</label>
            <input type="text" name="vehicle_name" required placeholder="Toyota Innova Crysta" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Vehicle Type</label>
            <select name="vehicle_type" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
                <option value="SUV">SUV (7-Seater)</option>
                <option value="Sedan">Sedan (4-Seater)</option>
                <option value="Luxury Van">Luxury Van (Executive)</option>
                <option value="Tempo Traveller">Tempo Traveller (12/17-Seater)</option>
                <option value="Executive Bus">Luxury Coach Bus</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Passenger Capacity</label>
            <input type="number" name="capacity" required placeholder="6" value="6" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Daily Rate (₹)</label>
            <input type="number" step="0.01" name="price_per_day" required placeholder="4500" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Vehicle Cover Photo</label>
        <input type="file" name="cover_image" accept="image/*" class="w-full text-xs text-slate-500">
    </div>

    <div>
        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Features (e.g. AC, Bluetooth, Carrier, Leather Seats)</label>
        <input type="text" name="features" placeholder="Dual AC, Leather Recliners, Roof Luggage Rack, Bluetooth" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
    </div>

    <div>
        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Description</label>
        <textarea name="description" rows="3" class="w-full p-3 text-xs rounded-xl border border-slate-300"></textarea>
    </div>

    <button type="submit" class="px-8 py-3 bg-brand-600 text-white font-extrabold text-xs rounded-xl shadow-md">Save Vehicle</button>
</form>
@endsection
