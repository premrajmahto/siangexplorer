@extends('layouts.admin')

@section('title', 'Destinations Management')

@section('content')
<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Destinations Catalog</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Manage travel locations, cover photos, attractions, and travel guides.</p>
    </div>
    <div>
        <a href="{{ route('admin.destinations.create') }}" 
           class="inline-flex items-center space-x-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md shadow-brand-600/20 transition-all">
            <i class="fa-solid fa-plus"></i>
            <span>Add New Destination</span>
        </a>
    </div>
</div>

<!-- Search & Filters Bar -->
<div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
    <form action="{{ route('admin.destinations.index') }}" method="GET" class="flex-1 flex flex-col sm:flex-row items-center gap-3">
        <div class="relative w-full sm:w-80">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Search destination name, country..." 
                   class="w-full pl-9 pr-4 py-2 text-xs rounded-xl bg-slate-100 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:bg-white transition-all">
        </div>
        
        <select name="status" onchange="this.form.submit()" class="w-full sm:w-auto px-3 py-2 text-xs rounded-xl bg-slate-100 border border-slate-200 text-slate-700 focus:outline-none focus:ring-2 focus:ring-brand-500">
            <option value="">All Statuses</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active Only</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive Only</option>
        </select>

        <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl transition-all">
            Filter
        </button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.destinations.index') }}" class="text-xs text-slate-500 hover:text-slate-700 underline font-medium">Reset</a>
        @endif
    </form>
</div>

<!-- Destinations Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($destinations as $destination)
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition-all">
            <!-- Cover Photo Container -->
            <div class="relative h-44 bg-slate-100 overflow-hidden">
                <img src="{{ $destination->cover_image_url }}" alt="{{ $destination->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">


                <!-- Badges -->
                <div class="absolute top-3 left-3 flex items-center space-x-2">
                    @if($destination->is_featured)
                        <span class="px-2.5 py-1 bg-amber-500/90 backdrop-blur-md text-white text-[10px] font-extrabold uppercase rounded-lg shadow-sm">
                            <i class="fa-solid fa-star mr-1"></i> Featured
                        </span>
                    @endif
                    @if($destination->is_active)
                        <span class="px-2.5 py-1 bg-emerald-500/90 backdrop-blur-md text-white text-[10px] font-extrabold uppercase rounded-lg shadow-sm">Active</span>
                    @else
                        <span class="px-2.5 py-1 bg-slate-600/90 backdrop-blur-md text-white text-[10px] font-extrabold uppercase rounded-lg shadow-sm">Draft</span>
                    @endif
                </div>

                <div class="absolute bottom-3 right-3 bg-slate-950/70 backdrop-blur-md text-white px-2.5 py-1 rounded-lg text-[11px] font-bold">
                    {{ $destination->tour_packages_count }} Packages
                </div>
            </div>

            <!-- Details Body -->
            <div class="p-5 flex-1 flex flex-col justify-between">
                <div>
                    <span class="text-[10px] font-extrabold text-brand-600 uppercase tracking-widest block">{{ $destination->country }} {{ $destination->state_region ? '• ' . $destination->state_region : '' }}</span>
                    <h3 class="font-extrabold text-slate-900 text-lg mt-0.5 group-hover:text-brand-600 transition-colors">{{ $destination->name }}</h3>
                    <p class="text-xs text-slate-500 line-clamp-2 mt-2 leading-relaxed font-normal">
                        {{ $destination->short_description ?? 'No description provided yet.' }}
                    </p>
                </div>

                @if($destination->best_time_to_visit)
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center text-xs text-slate-600">
                        <i class="fa-regular fa-calendar-check text-brand-500 mr-2"></i>
                        <span class="font-medium">Best Time: <strong class="text-slate-800">{{ $destination->best_time_to_visit }}</strong></span>
                    </div>
                @endif

                <!-- Actions -->
                <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between">
                    <a href="{{ route('admin.destinations.edit', $destination) }}" 
                       class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-slate-100 hover:bg-brand-50 text-slate-700 hover:text-brand-700 text-xs font-bold rounded-lg transition-colors">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Edit Destination</span>
                    </a>

                    <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this destination?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Delete">
                            <i class="fa-solid fa-trash-can text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white p-12 rounded-2xl border border-slate-200 text-center">
            <i class="fa-solid fa-map-location-dot text-4xl text-slate-300 mb-3"></i>
            <h3 class="font-bold text-slate-800 text-base">No destinations found</h3>
            <p class="text-xs text-slate-500 mt-1 mb-4">Start by adding your first travel destination to map tour packages.</p>
            <a href="{{ route('admin.destinations.create') }}" class="inline-flex items-center space-x-2 px-4 py-2 bg-brand-600 text-white font-bold text-xs rounded-xl shadow-md">
                <i class="fa-solid fa-plus"></i>
                <span>Add Destination</span>
            </a>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $destinations->links() }}
</div>
@endsection
