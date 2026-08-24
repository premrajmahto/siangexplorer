@extends('layouts.admin')

@section('title', 'All Tour Packages')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tour Packages Catalog</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Manage pricing, itineraries, duration, featured packages, and booking availability.</p>
    </div>
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.tours.categories') }}" class="px-3.5 py-2.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-xs rounded-xl shadow-sm">
            Categories
        </a>
        <a href="{{ route('admin.tours.types') }}" class="px-3.5 py-2.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold text-xs rounded-xl shadow-sm">
            Tour Types
        </a>
        <a href="{{ route('admin.tours.create') }}" 
           class="inline-flex items-center space-x-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md shadow-brand-600/20 transition-all">
            <i class="fa-solid fa-plus"></i>
            <span>Add New Tour</span>
        </a>
    </div>
</div>

<!-- Search & Filters -->
<div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm">
    <form action="{{ route('admin.tours.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
        <div class="relative">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Search tour title..." 
                   class="w-full pl-9 pr-4 py-2 text-xs rounded-xl bg-slate-100 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>

        <select name="destination_id" onchange="this.form.submit()" class="px-3 py-2 text-xs rounded-xl bg-slate-100 border border-slate-200 text-slate-700 focus:outline-none focus:ring-2 focus:ring-brand-500">
            <option value="">All Destinations</option>
            @foreach($destinations as $dest)
                <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
            @endforeach
        </select>

        <select name="tour_type_id" onchange="this.form.submit()" class="px-3 py-2 text-xs rounded-xl bg-slate-100 border border-slate-200 text-slate-700 focus:outline-none focus:ring-2 focus:ring-brand-500">
            <option value="">All Tour Types</option>
            @foreach($tourTypes as $type)
                <option value="{{ $type->id }}" {{ request('tour_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
            @endforeach
        </select>

        <div class="flex items-center space-x-2">
            <button type="submit" class="w-full px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl transition-all">
                Filter
            </button>
            @if(request('search') || request('destination_id') || request('tour_type_id'))
                <a href="{{ route('admin.tours.index') }}" class="px-3 py-2 text-xs text-slate-500 hover:text-slate-700 underline font-medium">Reset</a>
            @endif
        </div>
    </form>
</div>

<!-- Tour Packages Table -->
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-700">
            <thead class="bg-slate-100/80 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3.5">Tour Package</th>
                    <th class="px-4 py-3.5">Destination</th>
                    <th class="px-4 py-3.5">Type & Duration</th>
                    <th class="px-4 py-3.5">Pricing</th>
                    <th class="px-4 py-3.5">Badges</th>
                    <th class="px-4 py-3.5">Status</th>
                    <th class="px-4 py-3.5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($tours as $tour)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $tour->cover_image_url }}" alt="{{ $tour->title }}" class="w-12 h-12 rounded-xl object-cover border border-slate-200 shadow-sm">
                                <div class="min-w-0">
                                    <h4 class="font-bold text-xs text-slate-900 line-clamp-1">{{ $tour->title }}</h4>
                                    <span class="text-[10px] text-slate-400 font-mono">/tours/{{ $tour->slug }}</span>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-3 font-semibold text-slate-800">
                            {{ $tour->destination->name ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="font-bold block text-slate-800">{{ $tour->tourType->name ?? 'General' }}</span>
                            <span class="text-[10px] text-slate-500">{{ $tour->duration_days }} Days / {{ $tour->duration_nights }} Nights</span>
                        </td>

                        <td class="px-4 py-3">
                            @if($tour->discounted_price && $tour->discounted_price > 0)
                                <span class="font-extrabold text-emerald-600 block">₹{{ number_format($tour->discounted_price, 2) }}</span>
                                <span class="text-[10px] text-slate-400 line-through">₹{{ number_format($tour->starting_price, 2) }}</span>
                            @else
                                <span class="font-extrabold text-slate-900">₹{{ number_format($tour->starting_price, 2) }}</span>
                            @endif
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-1">
                                @if($tour->is_featured)
                                    <span class="px-2 py-0.5 text-[9px] font-extrabold text-amber-800 bg-amber-100 rounded-md">Featured</span>
                                @endif
                                @if($tour->is_popular)
                                    <span class="px-2 py-0.5 text-[9px] font-extrabold text-indigo-800 bg-indigo-100 rounded-md">Popular</span>
                                @endif
                            </div>
                        </td>

                        <td class="px-4 py-3">
                            @if($tour->is_active)
                                <span class="px-2 py-0.5 text-[10px] font-bold text-emerald-700 bg-emerald-50 rounded-full border border-emerald-200">Active</span>
                            @else
                                <span class="px-2 py-0.5 text-[10px] font-bold text-slate-600 bg-slate-100 rounded-full">Draft</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end space-x-1">
                                <a href="{{ route('admin.tours.duplicate', $tour) }}" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Duplicate Package">
                                    <i class="fa-solid fa-copy text-xs"></i>
                                </a>
                                <a href="{{ route('admin.tours.edit', $tour) }}" class="p-1.5 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition-colors" title="Edit Package">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <form action="{{ route('admin.tours.destroy', $tour) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tour package?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Delete">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-8 text-slate-400 text-xs">
                            No tour packages found. Click "Add New Tour" to create your first package.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $tours->links() }}
</div>
@endsection
