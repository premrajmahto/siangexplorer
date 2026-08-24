@extends('layouts.app')

@section('title', 'Explore Tour Packages | SiangExplorer')

@section('content')
<!-- Page Banner Header -->
<div class="bg-slate-900 text-white py-16 border-b border-slate-800 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-3 relative z-10">
        <span class="text-xs font-extrabold uppercase tracking-widest text-brand-400">Handpicked Vacations</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight font-serif">All Tour Packages</h1>
        <p class="text-slate-400 text-xs sm:text-sm max-w-xl font-normal">Discover domestic and international tour packages with day-wise itineraries, private transfers, and luxury stays.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filter Sidebar -->
        <aside class="space-y-6">
            <form action="{{ route('tours.index') }}" method="GET" class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-sm space-y-5">
                <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3 flex items-center justify-between">
                    <span>Filter Packages</span>
                    <i class="fa-solid fa-sliders text-brand-600"></i>
                </h3>

                <!-- Keyword -->
                <div>
                    <label class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1">Search Keywords</label>
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="e.g. Manali, Ladakh, Luxury" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200 text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500">
                </div>

                <!-- Destination -->
                <div>
                    <label class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1">Destination</label>
                    <select name="destination_id" class="w-full px-3.5 py-2.5 text-xs font-bold rounded-xl bg-slate-50 border border-slate-200 text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="">All Destinations</option>
                        @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tour Type -->
                <div>
                    <label class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1">Tour Type</label>
                    <select name="tour_type_id" class="w-full px-3.5 py-2.5 text-xs font-bold rounded-xl bg-slate-50 border border-slate-200 text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="">All Types</option>
                        @foreach($tourTypes as $type)
                            <option value="{{ $type->id }}" {{ request('tour_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Duration -->
                <div>
                    <label class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1">Duration</label>
                    <select name="duration" class="w-full px-3.5 py-2.5 text-xs font-bold rounded-xl bg-slate-50 border border-slate-200 text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="">Any Duration</option>
                        <option value="1-3" {{ request('duration') === '1-3' ? 'selected' : '' }}>1 to 3 Days</option>
                        <option value="4-7" {{ request('duration') === '4-7' ? 'selected' : '' }}>4 to 7 Days</option>
                        <option value="8+" {{ request('duration') === '8+' ? 'selected' : '' }}>8+ Days</option>
                    </select>
                </div>

                <!-- Price Range -->
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1">Min Price (₹)</label>
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="5000" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200">
                    </div>
                    <div>
                        <label class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1">Max Price (₹)</label>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="100000" class="w-full px-3 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200">
                    </div>
                </div>

                <!-- Sort By -->
                <div>
                    <label class="block text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1">Sort Results By</label>
                    <select name="sort" class="w-full px-3.5 py-2.5 text-xs font-bold rounded-xl bg-slate-50 border border-slate-200 text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest Packages</option>
                        <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Most Popular</option>
                    </select>
                </div>

                <div class="pt-2 flex items-center space-x-2">
                    <button type="submit" class="w-full py-3 bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-xs rounded-xl shadow-md transition-all">
                        Apply Filters
                    </button>
                    @if(request()->hasAny(['keyword', 'destination_id', 'tour_type_id', 'duration', 'min_price', 'max_price', 'sort']))
                        <a href="{{ route('tours.index') }}" class="px-3 py-3 text-xs text-slate-500 hover:text-slate-700 underline font-medium">Reset</a>
                    @endif
                </div>
            </form>
        </aside>

        <!-- Main Tour Listing Grid -->
        <main class="lg:col-span-3 space-y-6">
            <div class="flex items-center justify-between">
                <p class="text-xs font-bold text-slate-500">Showing <span class="text-slate-900 font-extrabold">{{ $tours->total() }}</span> tour packages</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($tours as $tour)
                    <x-tour-card :tour="$tour" />
                @empty
                    <div class="col-span-full bg-white p-12 rounded-3xl border border-slate-200 text-center space-y-3">
                        <i class="fa-solid fa-compass text-4xl text-slate-300"></i>
                        <h3 class="font-extrabold text-slate-800 text-base">No tour packages match your filters</h3>
                        <p class="text-xs text-slate-500">Try adjusting your destination, price range, or duration criteria.</p>
                        <a href="{{ route('tours.index') }}" class="inline-block px-5 py-2.5 bg-brand-600 text-white font-bold text-xs rounded-xl shadow-md">
                            Clear All Filters
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="pt-6">
                {{ $tours->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
