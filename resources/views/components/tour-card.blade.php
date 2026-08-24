@props(['tour'])

<div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col group">
    <!-- Image Header -->
    <div class="relative h-56 sm:h-60 bg-slate-900 overflow-hidden">
        <img src="{{ $tour->cover_image_url }}" 
             alt="{{ $tour->title }}" 
             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80';">

        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>

        <!-- Top Badges Row -->
        <div class="absolute top-3 inset-x-3 flex items-center justify-between gap-2 z-10">
            <div class="flex items-center gap-1.5 min-w-0">
                @if($tour->destination)
                    <span class="px-2.5 py-1 bg-slate-950/85 backdrop-blur-md text-white font-extrabold text-[10px] uppercase rounded-full tracking-wider border border-white/20 truncate max-w-[170px] shadow-sm">
                        <i class="fa-solid fa-location-dot text-brand-400 mr-1 text-[9px]"></i>{{ $tour->destination->name }}
                    </span>
                @endif
                @if($tour->tourType)
                    <span class="px-2.5 py-1 bg-brand-500 text-slate-950 font-black text-[10px] uppercase rounded-full tracking-wider shadow-sm hidden sm:inline-block">
                        {{ $tour->tourType->name }}
                    </span>
                @endif
            </div>

            @if($tour->discounted_price && $tour->discounted_price > 0 && $tour->starting_price > $tour->discounted_price)
                @php
                    $savings = round((($tour->starting_price - $tour->discounted_price) / $tour->starting_price) * 100);
                @endphp
                <div class="bg-emerald-500 text-white text-[10px] font-black px-2.5 py-1 rounded-full shadow-lg border border-white/30 uppercase tracking-widest shrink-0">
                    SAVE {{ $savings }}%
                </div>
            @endif
        </div>

        <!-- Bottom Duration & Capacity -->
        <div class="absolute bottom-3 left-3 right-3 text-white text-xs font-semibold flex items-center justify-between">
            <div class="flex items-center space-x-3 text-[11px] font-bold text-slate-200">
                <span><i class="fa-solid fa-clock text-brand-400 mr-1"></i> {{ $tour->duration_days }}D / {{ $tour->duration_nights }}N</span>
                <span><i class="fa-solid fa-user-group text-brand-400 mr-1"></i> Max {{ $tour->max_travelers }}</span>
            </div>
        </div>
    </div>

    <!-- Body Content -->
    <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between space-y-4">
        <div class="space-y-2">
            <h3 class="font-extrabold text-slate-900 text-base leading-snug group-hover:text-brand-600 transition-colors line-clamp-2">
                <a href="{{ route('tours.show', $tour->slug) }}">{{ $tour->title }}</a>
            </h3>
            <p class="text-xs text-slate-500 font-normal line-clamp-2 leading-relaxed">{{ $tour->short_description }}</p>
        </div>

        <!-- Pricing & CTA -->
        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-extrabold uppercase text-slate-400 block tracking-wider">Starting From</span>
                <div class="flex items-baseline space-x-1.5">
                    <span class="text-xl font-black text-slate-900">₹{{ number_format($tour->effective_price) }}</span>
                    @if($tour->discounted_price && $tour->discounted_price > 0 && $tour->starting_price > $tour->discounted_price)
                        <span class="text-xs text-slate-400 line-through font-semibold">₹{{ number_format($tour->starting_price) }}</span>
                    @endif
                </div>
            </div>

            <a href="{{ route('tours.show', $tour->slug) }}" 
               class="px-4 py-2.5 bg-slate-900 hover:bg-brand-600 text-white font-extrabold text-xs rounded-xl shadow-md transition-all flex items-center space-x-1.5 group-hover:bg-brand-600">
                <span>View Tour</span>
                <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>
    </div>
</div>
