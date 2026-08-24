@props(['destination'])

<a href="{{ route('destinations.show', $destination->slug) }}" class="group relative rounded-3xl overflow-hidden h-80 block shadow-md hover:shadow-2xl transition-all duration-500">
    <img src="{{ $destination->cover_image_url }}" alt="{{ $destination->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>

    <div class="absolute bottom-6 left-6 right-6 text-white space-y-1">
        <span class="text-[10px] font-extrabold uppercase tracking-widest text-brand-400 block">{{ $destination->country }}</span>
        <h3 class="text-xl font-extrabold text-white group-hover:text-brand-300 transition-colors leading-tight">{{ $destination->name }}</h3>
        <p class="text-xs text-slate-300 line-clamp-1 font-normal opacity-90">{{ $destination->short_description }}</p>
        
        <div class="pt-2 flex items-center justify-between text-xs font-bold text-slate-200">
            <span>{{ $destination->tour_packages_count ?? $destination->tourPackages->count() }} Packages</span>
            <span class="text-brand-400 group-hover:translate-x-1 transition-transform flex items-center space-x-1">
                <span>Explore</span>
                <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </span>
        </div>
    </div>
</a>
