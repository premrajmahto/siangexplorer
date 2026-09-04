@extends('layouts.app')

@section('title', $tour->seo_title ?? $tour->title . ' | SiangExplorer')
@section('meta_description', $tour->seo_description ?? $tour->short_description)

@section('content')
<!-- Breadcrumbs Bar -->
<div class="bg-slate-900 text-slate-400 text-xs py-3 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center space-x-2">
        <a href="{{ url('/') }}" class="hover:text-white transition-colors">Home</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i>
        <a href="{{ route('tours.index') }}" class="hover:text-white transition-colors">Tours</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i>
        <a href="{{ route('destinations.show', $tour->destination->slug ?? '#') }}" class="hover:text-white transition-colors">{{ $tour->destination->name ?? 'Destination' }}</a>
        <i class="fa-solid fa-chevron-right text-[9px] text-slate-600"></i>
        <span class="text-white font-semibold truncate">{{ $tour->title }}</span>
    </div>
</div>

<!-- Tour Hero Header -->
<div class="bg-slate-950 text-white py-12 relative border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        <div class="flex flex-wrap items-center gap-3 text-xs">
            <span class="px-3 py-1 bg-brand-500/20 text-brand-400 font-extrabold rounded-full border border-brand-500/30 uppercase tracking-widest text-[10px]">
                {{ $tour->destination->name ?? 'Worldwide' }}
            </span>
            <span class="px-3 py-1 bg-slate-800 text-slate-300 font-bold rounded-full text-[10px]">
                {{ $tour->tourType->name ?? 'Package' }}
            </span>
            <span class="flex items-center text-amber-400 text-xs space-x-1">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                <span class="text-white font-bold ml-1">4.9 (48 Reviews)</span>
            </span>
        </div>

        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight font-serif text-white max-w-4xl">{{ $tour->title }}</h1>

        <div class="flex flex-wrap items-center gap-6 text-xs text-slate-300 pt-2 font-medium">
            <span class="flex items-center space-x-2">
                <i class="fa-solid fa-clock text-brand-400"></i>
                <span>{{ $tour->duration_days }} Days / {{ $tour->duration_nights }} Nights</span>
            </span>
            <span class="flex items-center space-x-2">
                <i class="fa-solid fa-users text-brand-400"></i>
                <span>Group Size: {{ $tour->min_travelers }} - {{ $tour->max_travelers }} Persons</span>
            </span>
            <span class="flex items-center space-x-2">
                <i class="fa-solid fa-location-dot text-brand-400"></i>
                <span>Starts & Ends in {{ $tour->destination->name ?? 'Destination' }}</span>
            </span>
        </div>
    </div>
</div>

<!-- Main Details Workspace -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Left Content Area -->
        <div class="lg:col-span-2 space-y-10">
            <!-- Gallery Lightbox Grid -->
            <div class="space-y-3" x-data="{ activeImage: '{{ $tour->cover_image_url }}' }">
                <div class="h-80 sm:h-96 rounded-3xl overflow-hidden bg-slate-100 border border-slate-200 shadow-md">
                    <img :src="activeImage" alt="{{ $tour->title }}" class="w-full h-full object-cover transition-all duration-300">
                </div>

                @if($tour->images->count() > 0)
                    <div class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                        <button @click="activeImage = '{{ $tour->cover_image_url }}'" class="rounded-xl overflow-hidden h-16 border-2 focus:outline-none focus:border-brand-500">
                            <img src="{{ $tour->cover_image_url }}" class="w-full h-full object-cover">
                        </button>
                        @foreach($tour->images as $img)
                            <button @click="activeImage = '{{ asset('storage/' . $img->image_path) }}'" class="rounded-xl overflow-hidden h-16 border-2 focus:outline-none focus:border-brand-500">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Overview -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
                <h2 class="text-xl font-extrabold text-slate-900 font-serif">Package Overview</h2>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed font-normal">
                    {{ $tour->full_description ?? $tour->short_description }}
                </p>
            </div>

            <!-- Day-wise Itinerary Accordion -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-900 font-serif">Day-Wise Detailed Itinerary</h2>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $tour->duration_days }} Days planned with activities, transfers & meals.</p>
                    </div>
                </div>

                <div class="space-y-4" x-data="{ openDay: 1 }">
                    @forelse($tour->itineraries as $itinerary)
                        <div class="border border-slate-200/90 rounded-2xl overflow-hidden transition-all shadow-sm">
                            <button @click="openDay = openDay === {{ $itinerary->day_number }} ? null : {{ $itinerary->day_number }}" 
                                    class="w-full p-5 bg-slate-50 hover:bg-slate-100/80 text-left font-extrabold text-xs sm:text-sm text-slate-900 flex items-center justify-between transition-colors">
                                <div class="flex items-center space-x-3">
                                    <span class="px-3 py-1 bg-brand-600 text-white rounded-lg text-xs font-black">
                                        Day {{ $itinerary->day_number }}
                                    </span>
                                    <span class="truncate">{{ $itinerary->title }}</span>
                                </div>
                                <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="openDay === {{ $itinerary->day_number }} ? 'rotate-180 text-brand-600' : ''"></i>
                            </button>

                            <div x-show="openDay === {{ $itinerary->day_number }}" x-collapse class="p-5 text-xs text-slate-600 space-y-4 border-t border-slate-200/80 bg-white">
                                @if($itinerary->description)
                                    <p class="leading-relaxed text-slate-700 font-medium">{{ $itinerary->description }}</p>
                                @endif

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                                    @if($itinerary->morning_activity)
                                        <div class="p-3 bg-amber-50/60 rounded-xl border border-amber-100">
                                            <span class="text-[10px] font-bold text-amber-700 uppercase tracking-wider block">Morning</span>
                                            <p class="font-bold text-slate-800 text-xs mt-0.5">{{ $itinerary->morning_activity }}</p>
                                        </div>
                                    @endif

                                    @if($itinerary->afternoon_activity)
                                        <div class="p-3 bg-sky-50/60 rounded-xl border border-sky-100">
                                            <span class="text-[10px] font-bold text-sky-700 uppercase tracking-wider block">Afternoon</span>
                                            <p class="font-bold text-slate-800 text-xs mt-0.5">{{ $itinerary->afternoon_activity }}</p>
                                        </div>
                                    @endif

                                    @if($itinerary->evening_activity)
                                        <div class="p-3 bg-indigo-50/60 rounded-xl border border-indigo-100">
                                            <span class="text-[10px] font-bold text-indigo-700 uppercase tracking-wider block">Evening</span>
                                            <p class="font-bold text-slate-800 text-xs mt-0.5">{{ $itinerary->evening_activity }}</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex flex-wrap gap-4 text-[11px] font-semibold text-slate-600 pt-2 border-t border-slate-100">
                                    @if($itinerary->meals)
                                        <span class="flex items-center space-x-1.5 text-emerald-700">
                                            <i class="fa-solid fa-utensils"></i>
                                            <span>Meals: {{ $itinerary->meals }}</span>
                                        </span>
                                    @endif
                                    @if($itinerary->hotel)
                                        <span class="flex items-center space-x-1.5 text-sky-700">
                                            <i class="fa-solid fa-hotel"></i>
                                            <span>Stay: {{ $itinerary->hotel }}</span>
                                        </span>
                                    @endif
                                    @if($itinerary->transportation)
                                        <span class="flex items-center space-x-1.5 text-slate-700">
                                            <i class="fa-solid fa-car"></i>
                                            <span>Transfer: {{ $itinerary->transportation }}</span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400">Itinerary details will be provided upon booking confirmation.</p>
                    @endforelse
                </div>
            </div>

            <!-- Inclusions & Exclusions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Inclusions -->
                <div class="bg-white p-6 rounded-3xl border border-emerald-200/80 shadow-sm space-y-4">
                    <h3 class="font-extrabold text-emerald-900 text-base flex items-center space-x-2">
                        <i class="fa-solid fa-circle-check text-emerald-600"></i>
                        <span>What's Included</span>
                    </h3>
                    <div class="text-xs text-slate-600 leading-relaxed space-y-2 font-medium">
                        {!! nl2br(e($tour->inclusions_text ?? "• 4-Star Resort Accommodations\n• Daily Breakfast & Dinner\n• Private Airport / Volvo Transfers\n• Sightseeing Cab with Fuel & Tolls")) !!}
                    </div>
                </div>

                <!-- Exclusions -->
                <div class="bg-white p-6 rounded-3xl border border-rose-200/80 shadow-sm space-y-4">
                    <h3 class="font-extrabold text-rose-900 text-base flex items-center space-x-2">
                        <i class="fa-solid fa-circle-xmark text-rose-600"></i>
                        <span>What's Excluded</span>
                    </h3>
                    <div class="text-xs text-slate-600 leading-relaxed space-y-2 font-medium">
                        {!! nl2br(e($tour->exclusions_text ?? "• Airfare or Train Tickets\n• Personal Laundry & Shopping\n• Anything not explicitly listed in inclusions")) !!}
                    </div>
                </div>
            </div>

            <!-- Hotel & Transportation Info -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-6">
                <h3 class="font-extrabold text-slate-900 text-lg font-serif">Hotel & Transport Specifications</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                        <h4 class="font-extrabold text-slate-900 flex items-center space-x-2">
                            <i class="fa-solid fa-hotel text-brand-600"></i>
                            <span>Accommodation Info</span>
                        </h4>
                        <p class="text-slate-600 leading-relaxed">{{ $tour->hotel_info ?? '3-Star / 4-Star handpicked luxury partner hotels with breakfast.' }}</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 space-y-2">
                        <h4 class="font-extrabold text-slate-900 flex items-center space-x-2">
                            <i class="fa-solid fa-car text-brand-600"></i>
                            <span>Vehicle & Transport Info</span>
                        </h4>
                        <p class="text-slate-600 leading-relaxed">{{ $tour->transport_info ?? 'Private AC Sedan / SUV cab dedicated for your entire tour duration.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Cancellation Policy & Payment Terms -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <h3 class="font-extrabold text-slate-900 text-lg font-serif flex items-center space-x-2">
                        <i class="fa-solid fa-file-contract text-brand-600"></i>
                        <span>Payment Terms & Cancellation Policy</span>
                    </h3>
                    <p class="text-xs text-slate-500 mt-1">Transparent booking guidelines and refund timelines for your peace of mind.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                    <!-- Payment Terms -->
                    <div class="p-5 rounded-2xl bg-emerald-50/50 border border-emerald-200/80 space-y-3">
                        <h4 class="font-extrabold text-emerald-950 text-sm flex items-center space-x-2">
                            <i class="fa-solid fa-credit-card text-emerald-600"></i>
                            <span>Payment Schedule</span>
                        </h4>
                        <ul class="space-y-2 text-slate-700 font-medium">
                            <li class="flex items-start space-x-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                                <span><strong class="text-slate-900">30% Advance:</strong> Within 3 days after tour confirmation.</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>
                                <span><strong class="text-slate-900">70% Balance:</strong> 7 days before tour departure date.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Cancellation Refund Rules -->
                    <div class="p-5 rounded-2xl bg-amber-50/50 border border-amber-200/80 space-y-3">
                        <h4 class="font-extrabold text-amber-950 text-sm flex items-center space-x-2">
                            <i class="fa-solid fa-rotate-left text-amber-600"></i>
                            <span>Refund Slabs</span>
                        </h4>
                        <div class="space-y-1.5 font-medium text-slate-700">
                            <div class="flex justify-between py-1 border-b border-amber-200/60">
                                <span>Before 30 Days</span>
                                <span class="font-extrabold text-emerald-700">Full Refund (100%)</span>
                            </div>
                            <div class="flex justify-between py-1 border-b border-amber-200/60">
                                <span>30 – 21 Days</span>
                                <span class="font-extrabold text-slate-900">75% Refund</span>
                            </div>
                            <div class="flex justify-between py-1 border-b border-amber-200/60">
                                <span>21 – 14 Days</span>
                                <span class="font-extrabold text-slate-900">50% Refund</span>
                            </div>
                            <div class="flex justify-between py-1 border-b border-amber-200/60">
                                <span>14 – 7 Days</span>
                                <span class="font-extrabold text-amber-700">25% Refund</span>
                            </div>
                            <div class="flex justify-between py-1">
                                <span>Within 7 Days</span>
                                <span class="font-extrabold text-rose-600">No Refund (0%)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs text-slate-600 space-y-1">
                    <p class="font-semibold flex items-center space-x-2 text-slate-800">
                        <i class="fa-solid fa-circle-info text-brand-600"></i>
                        <span>Cancellation Fee Note:</span>
                    </p>
                    <p class="pl-6 text-[11px]">We charge <strong>3% of the total booking amount</strong> as our administrative service fee in case of any cancellation over and above the above cancellation charges.</p>
                </div>
            </div>

            <!-- Mandatory Documents & Inner Line Permit (ILP) -->
            <div class="bg-white p-8 rounded-3xl border border-sky-200/80 shadow-sm space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-2xl bg-sky-100 text-sky-700 flex items-center justify-center text-lg font-black shrink-0">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-base font-serif">Mandatory Travel Documents & Permits</h3>
                        <p class="text-xs text-slate-500">Essential ID requirements for guests traveling in North East India.</p>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-sky-50/70 border border-sky-200 text-xs text-slate-700 leading-relaxed space-y-2">
                    <p class="font-bold text-sky-950 flex items-center space-x-2">
                        <i class="fa-solid fa-shield-halved text-sky-600"></i>
                        <span>Inner Line Permit (ILP) Requirement for Arunachal Pradesh:</span>
                    </p>
                    <p class="text-slate-600 font-medium">
                        ILP (Inner Line Permit) is mandatory for guests traveling to Arunachal Pradesh. For seamless ILP processing, guests need to provide:
                    </p>
                    <ul class="list-disc pl-5 space-y-1 text-slate-800 font-bold">
                        <li>1 Copy Passport Size Photograph</li>
                        <li>1 Copy Govt. Authorized Photo ID (Passport / Aadhaar Card / Voter ID)</li>
                    </ul>
                </div>
            </div>

            <!-- Destination Expert Badge Banner -->
            <div class="bg-gradient-to-r from-slate-950 via-slate-900 to-teal-950 text-white p-6 sm:p-8 rounded-3xl border border-slate-800 shadow-xl space-y-3 relative overflow-hidden">
                <div class="flex items-center space-x-2 text-teal-400 text-xs font-extrabold uppercase tracking-widest">
                    <i class="fa-solid fa-award text-amber-400 text-sm"></i>
                    <span>Certified Regional Travel Specialists</span>
                </div>
                <h4 class="text-lg sm:text-xl font-extrabold font-serif text-white">Destination Expert For:</h4>
                <div class="flex flex-wrap gap-2 text-xs font-black">
                    @foreach(['ASSAM', 'ARUNACHAL', 'MEGHALAYA', 'MANIPUR', 'MIZORAM', 'NAGALAND', 'TRIPURA', 'BHUTAN', 'SIKKIM', 'DARJEELING'] as $region)
                        <span class="px-3 py-1 bg-white/10 backdrop-blur-md rounded-xl border border-white/15 text-teal-200 tracking-wider">
                            {{ $region }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Sticky Booking Card -->
        <div class="space-y-6">
            <div class="sticky top-24 bg-white p-6 rounded-3xl border border-slate-200 shadow-xl space-y-6">
                <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider block">Special Offer Rate</span>
                        <div class="flex items-baseline space-x-2">
                            @if($tour->discounted_price && $tour->discounted_price > 0)
                                <span class="text-3xl font-black text-slate-900">₹{{ number_format($tour->discounted_price) }}</span>
                                <span class="text-sm text-slate-400 line-through font-semibold">₹{{ number_format($tour->starting_price) }}</span>
                            @else
                                <span class="text-3xl font-black text-slate-900">₹{{ number_format($tour->starting_price) }}</span>
                            @endif
                        </div>
                    </div>
                    <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-extrabold rounded-lg border border-emerald-200">Instant Booking</span>
                </div>

                <!-- Booking / Enquiry Tabbed Form -->
                <div x-data="{ tab: 'book' }">
                    <div class="flex border-b border-slate-200 mb-4 text-xs font-bold">
                        <button @click="tab = 'book'" :class="tab === 'book' ? 'border-b-2 border-brand-600 text-brand-600' : 'text-slate-500'" class="flex-1 pb-2 text-center">
                            Book Package
                        </button>
                        <button @click="tab = 'enquire'" :class="tab === 'enquire' ? 'border-b-2 border-brand-600 text-brand-600' : 'text-slate-500'" class="flex-1 pb-2 text-center">
                            Ask Question
                        </button>
                    </div>

                    <!-- Book Package Form -->
                    <form x-show="tab === 'book'" action="{{ route('booking.process', $tour) }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Travel Date</label>
                            <input type="date" name="travel_date" min="{{ date('Y-m-d') }}" required class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:ring-2 focus:ring-brand-500">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Adults (12+ yrs)</label>
                                <input type="number" name="num_adults" min="1" max="{{ $tour->max_travelers }}" value="2" required class="w-full px-3 py-2 text-xs font-bold rounded-xl bg-slate-50 border border-slate-200 text-slate-800">
                            </div>
                            <div>
                                <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Children (2-11 yrs)</label>
                                <input type="number" name="num_children" min="0" value="0" class="w-full px-3 py-2 text-xs font-bold rounded-xl bg-slate-50 border border-slate-200 text-slate-800">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Your Full Name</label>
                            <input type="text" name="customer_name" value="{{ Auth::user()->name ?? '' }}" required placeholder="John Doe" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
                        </div>

                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Email Address</label>
                            <input type="email" name="customer_email" value="{{ Auth::user()->email ?? '' }}" required placeholder="john@example.com" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
                        </div>

                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Phone / WhatsApp</label>
                            <input type="tel" name="customer_phone" value="{{ Auth::user()->phone ?? '' }}" required placeholder="+91 98765 43210" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
                        </div>

                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Promo Coupon Code</label>
                            <input type="text" name="coupon_code" placeholder="e.g. EXPLORE5000" class="w-full px-3.5 py-2 text-xs font-mono uppercase rounded-xl bg-slate-50 border border-slate-200">
                        </div>

                        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-brand-500 to-teal-500 hover:from-brand-600 hover:to-teal-600 text-white font-black text-xs rounded-xl shadow-lg shadow-brand-500/25 transition-all transform active:scale-98">
                            Proceed to Reserve Tour
                        </button>
                    </form>

                    <!-- Ask Question / Quick Enquiry Form -->
                    <form x-show="tab === 'enquire'" action="{{ route('enquiry.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="tour_package_id" value="{{ $tour->id }}">
                        <input type="hidden" name="destination_id" value="{{ $tour->destination_id }}">

                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Your Name</label>
                            <input type="text" name="name" required placeholder="John Doe" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
                        </div>

                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Email</label>
                            <input type="email" name="email" required placeholder="john@example.com" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
                        </div>

                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Phone</label>
                            <input type="tel" name="phone" required placeholder="+91 98765 43210" class="w-full px-3.5 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200">
                        </div>

                        <div>
                            <label class="block text-[10px] font-extrabold uppercase text-slate-500 mb-1">Your Enquiry / Customization Needs</label>
                            <textarea name="message" rows="3" placeholder="Tell us your preferences..." class="w-full px-3.5 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200"></textarea>
                        </div>

                        <button type="submit" class="w-full py-3.5 bg-slate-900 hover:bg-slate-800 text-white font-extrabold text-xs rounded-xl shadow-md transition-all">
                            Submit Quick Enquiry
                        </button>
                    </form>
                </div>

                <!-- Direct WhatsApp CTA Button -->
                <div class="pt-4 border-t border-slate-100">
                    <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number', '919876543210') }}?text=Hello%20SiangExplorer%2C%20I%20am%20interested%20in%20booking%20the%20{{ urlencode($tour->title) }}%20package." 
                       target="_blank" 
                       class="w-full py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs rounded-xl shadow-md flex items-center justify-center space-x-2 transition-all">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>Book Directly via WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
