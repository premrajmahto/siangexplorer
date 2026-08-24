@extends('layouts.app')

@section('title', 'Explore Top Destinations | SiangExplorer')

@section('content')
<!-- Page Banner Header -->
<div class="bg-slate-900 text-white py-16 border-b border-slate-800 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-3 relative z-10">
        <span class="text-xs font-extrabold uppercase tracking-widest text-brand-400">World & Domestic Destinations</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight font-serif">Explore All Destinations</h1>
        <p class="text-slate-400 text-xs sm:text-sm max-w-xl font-normal">Browse handpicked travel locations with weather guides, top attractions, and available tour packages.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
    <!-- Search Bar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <form action="{{ route('destinations.index') }}" method="GET" class="w-full flex items-center gap-3">
            <div class="relative flex-1">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search destination by name or country..." class="w-full pl-9 pr-4 py-2.5 text-xs rounded-xl bg-slate-100 border border-slate-200">
            </div>
            <button type="submit" class="px-5 py-2.5 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-brand-600 transition-colors">
                Search
            </button>
        </form>
    </div>

    <!-- Destinations Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($destinations as $destination)
            <x-destination-card :destination="$destination" />
        @empty
            <div class="col-span-full bg-white p-12 rounded-3xl border border-slate-200 text-center text-slate-400 text-xs">
                No destinations match your search term.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pt-4">
        {{ $destinations->links() }}
    </div>
</div>
@endsection
