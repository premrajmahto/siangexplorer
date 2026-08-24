@extends('layouts.admin')

@section('title', 'Hotels & Resorts Management')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Hotel & Resort Accommodations</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Manage luxury hotels, resorts, room pricing, and amenities.</p>
    </div>
    <a href="{{ route('admin.hotels.create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-xs rounded-xl shadow-md transition-all">
        <i class="fa-solid fa-plus"></i>
        <span>Add New Hotel</span>
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <table class="w-full text-left text-xs text-slate-700">
        <thead class="bg-slate-100/80 text-[10px] font-bold text-slate-500 uppercase">
            <tr>
                <th class="px-4 py-3.5">Hotel Name</th>
                <th class="px-4 py-3.5">Destination</th>
                <th class="px-4 py-3.5">Category</th>
                <th class="px-4 py-3.5">Price / Night</th>
                <th class="px-4 py-3.5">Featured</th>
                <th class="px-4 py-3.5 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($hotels as $hotel)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-4 py-3 font-bold text-slate-900 flex items-center space-x-3">
                        <img src="{{ $hotel->cover_image_url }}" class="w-10 h-10 rounded-lg object-cover">
                        <span>{{ $hotel->name }}</span>
                    </td>

                    <td class="px-4 py-3 font-medium text-slate-800">{{ $hotel->destination->name ?? 'N/A' }}</td>
                    <td class="px-4 py-3"><span class="px-2 py-0.5 bg-amber-50 text-amber-800 text-[10px] font-bold rounded">{{ $hotel->category }}</span></td>
                    <td class="px-4 py-3 font-extrabold text-slate-900">₹{{ number_format($hotel->price_per_night, 2) }}</td>
                    <td class="px-4 py-3">{{ $hotel->is_featured ? 'Yes' : 'No' }}</td>
                    <td class="px-4 py-3 text-right">
                        <form action="{{ route('admin.hotels.destroy', $hotel) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-700 font-bold text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-slate-400">No hotels added yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $hotels->links() }}
</div>
@endsection
