@extends('layouts.admin')

@section('title', 'Add New Hotel')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-extrabold text-slate-900">Add New Hotel / Resort</h1>
    <a href="{{ route('admin.hotels.index') }}" class="text-xs font-bold text-slate-600 hover:underline">Back to Hotels</a>
</div>

<form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm max-w-3xl space-y-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Hotel Name</label>
            <input type="text" name="name" required placeholder="Grand Himalayan Resort" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Destination</label>
            <select name="destination_id" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
                @foreach($destinations as $dest)
                    <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Category</label>
            <select name="category" required class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
                <option value="5-Star">5-Star Luxury</option>
                <option value="4-Star" selected>4-Star Premium</option>
                <option value="3-Star">3-Star Standard</option>
                <option value="Luxury Resort">Luxury Heritage Resort</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Price Per Night (₹)</label>
            <input type="number" step="0.01" name="price_per_night" required placeholder="6500" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300 font-bold">
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Cover Image</label>
        <input type="file" name="cover_image" accept="image/*" class="w-full text-xs text-slate-500">
    </div>

    <div>
        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Amenities (Comma separated)</label>
        <input type="text" name="amenities" placeholder="Free WiFi, Swimming Pool, Spa, Breakfast, Parking" class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-300">
    </div>

    <div>
        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Short Summary</label>
        <textarea name="short_description" rows="2" class="w-full p-3 text-xs rounded-xl border border-slate-300"></textarea>
    </div>

    <div>
        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Full Description</label>
        <textarea name="description" rows="4" class="w-full p-3 text-xs rounded-xl border border-slate-300"></textarea>
    </div>

    <div class="flex items-center space-x-6">
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="is_featured" value="1" class="rounded text-brand-600">
            <span class="text-xs font-bold text-slate-700">Feature on Homepage</span>
        </label>
    </div>

    <button type="submit" class="px-8 py-3 bg-brand-600 text-white font-extrabold text-xs rounded-xl shadow-md">Save Hotel</button>
</form>
@endsection
