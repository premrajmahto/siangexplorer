@extends('layouts.admin')

@section('title', 'Cab, Bike & Hotel Service Bookings')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Car, Bike & Hotel Service Bookings</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Track, review, and manage customer booking requests for cabs, self-drive motorcycles, and hotel stays.</p>
    </div>
</div>

<!-- Filter Tabs -->
<div class="flex flex-wrap items-center gap-2 mb-6 text-xs font-extrabold">
    <a href="{{ route('admin.service-enquiries.index') }}" 
       class="px-4 py-2.5 rounded-xl border transition-all {{ !request('type') ? 'bg-slate-900 text-white border-slate-900 shadow-md' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
        <i class="fa-solid fa-layer-group mr-1.5"></i> All Service Bookings
    </a>
    <a href="{{ route('admin.service-enquiries.index', ['type' => 'transportation']) }}" 
       class="px-4 py-2.5 rounded-xl border transition-all {{ request('type') === 'transportation' ? 'bg-teal-600 text-white border-teal-600 shadow-md' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
        <i class="fa-solid fa-car mr-1.5"></i> Cab & Vehicle Rentals
    </a>
    <a href="{{ route('admin.service-enquiries.index', ['type' => 'bike_rental']) }}" 
       class="px-4 py-2.5 rounded-xl border transition-all {{ request('type') === 'bike_rental' ? 'bg-amber-600 text-white border-amber-600 shadow-md' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
        <i class="fa-solid fa-motorcycle mr-1.5"></i> Bike & Scooter Rentals
    </a>
    <a href="{{ route('admin.service-enquiries.index', ['type' => 'hotel']) }}" 
       class="px-4 py-2.5 rounded-xl border transition-all {{ request('type') === 'hotel' ? 'bg-brand-600 text-white border-brand-600 shadow-md' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
        <i class="fa-solid fa-hotel mr-1.5"></i> Hotel & Resort Enquiries
    </a>
</div>

<!-- Search & Status Filter Bar -->
<div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
    <form action="{{ route('admin.service-enquiries.index') }}" method="GET" class="w-full flex flex-col sm:flex-row items-center gap-3">
        @if(request('type'))
            <input type="hidden" name="type" value="{{ request('type') }}">
        @endif

        <div class="relative w-full sm:w-72">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customer name, email, phone..." class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-brand-500">
        </div>

        <select name="status" onchange="this.form.submit()" class="w-full sm:w-44 px-3 py-2 text-xs font-bold rounded-xl border border-slate-200 bg-slate-50 text-slate-700">
            <option value="">All Statuses</option>
            <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New Requests</option>
            <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>

        <button type="submit" class="px-4 py-2 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-brand-600 transition-colors">Filter</button>
        @if(request('search') || request('status') || request('type'))
            <a href="{{ route('admin.service-enquiries.index') }}" class="text-xs text-slate-500 hover:text-slate-900 font-medium">Clear Filters</a>
        @endif
    </form>
</div>

<!-- Service Enquiries Table -->
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-700">
            <thead class="bg-slate-100/80 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3.5">Service & Requested Item</th>
                    <th class="px-4 py-3.5">Customer Contact</th>
                    <th class="px-4 py-3.5">Travel Dates & Location</th>
                    <th class="px-4 py-3.5">Notes</th>
                    <th class="px-4 py-3.5">Status</th>
                    <th class="px-4 py-3.5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($enquiries as $enquiry)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-4 py-3.5">
                            <div class="space-y-1">
                                @if($enquiry->service_type === 'transportation')
                                    <span class="px-2 py-0.5 bg-teal-50 text-teal-700 border border-teal-200 text-[10px] font-extrabold rounded-md inline-flex items-center">
                                        <i class="fa-solid fa-car mr-1"></i> Cab Rental
                                    </span>
                                    <h4 class="font-extrabold text-xs text-slate-900">{{ $enquiry->service_item->vehicle_name ?? 'Vehicle #' . $enquiry->service_id }}</h4>
                                @elseif($enquiry->service_type === 'bike_rental')
                                    <span class="px-2 py-0.5 bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-extrabold rounded-md inline-flex items-center">
                                        <i class="fa-solid fa-motorcycle mr-1"></i> Bike Rental
                                    </span>
                                    <h4 class="font-extrabold text-xs text-slate-900">{{ $enquiry->service_item->model_name ?? 'Bike #' . $enquiry->service_id }}</h4>
                                @else
                                    <span class="px-2 py-0.5 bg-brand-50 text-brand-700 border border-brand-200 text-[10px] font-extrabold rounded-md inline-flex items-center">
                                        <i class="fa-solid fa-hotel mr-1"></i> Hotel Stay
                                    </span>
                                    <h4 class="font-extrabold text-xs text-slate-900">{{ $enquiry->service_item->name ?? 'Hotel #' . $enquiry->service_id }}</h4>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3.5">
                            <div class="space-y-0.5">
                                <h4 class="font-extrabold text-slate-900 text-xs">{{ $enquiry->customer_name }}</h4>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $enquiry->customer_phone) }}" target="_blank" class="text-[11px] font-bold text-emerald-600 hover:underline flex items-center space-x-1">
                                    <i class="fa-brands fa-whatsapp text-emerald-500"></i>
                                    <span>{{ $enquiry->customer_phone }}</span>
                                </a>
                                <p class="text-[10px] text-slate-400">{{ $enquiry->customer_email }}</p>
                            </div>
                        </td>
                        <td class="px-4 py-3.5">
                            <div class="space-y-0.5 text-[11px]">
                                <span class="font-bold text-slate-800 block">
                                    <i class="fa-solid fa-calendar-day text-brand-600 mr-1"></i>
                                    {{ $enquiry->start_date ? $enquiry->start_date->format('d M Y') : 'N/A' }}
                                    @if($enquiry->end_date && $enquiry->end_date->gt($enquiry->start_date))
                                        - {{ $enquiry->end_date->format('d M Y') }}
                                    @endif
                                </span>
                                @if($enquiry->pickup_location)
                                    <span class="text-slate-500 block text-[10px]">
                                        <i class="fa-solid fa-location-dot text-rose-500 mr-1"></i> {{ $enquiry->pickup_location }}
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3.5 max-w-xs text-[11px] text-slate-600">
                            {{ $enquiry->notes ?? 'No special instructions.' }}
                        </td>
                        <td class="px-4 py-3.5">
                            <form action="{{ route('admin.service-enquiries.updateStatus', $enquiry) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="px-2 py-1 text-[10px] font-extrabold uppercase rounded-lg border focus:outline-none 
                                    {{ $enquiry->status === 'confirmed' ? 'bg-emerald-50 text-emerald-700 border-emerald-300' : ($enquiry->status === 'new' ? 'bg-amber-50 text-amber-700 border-amber-300' : 'bg-rose-50 text-rose-700 border-rose-300') }}">
                                    <option value="new" {{ $enquiry->status === 'new' ? 'selected' : '' }}>New</option>
                                    <option value="confirmed" {{ $enquiry->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ $enquiry->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-4 py-3.5 text-right">
                            <form action="{{ route('admin.service-enquiries.destroy', $enquiry) }}" method="POST" onsubmit="return confirm('Delete this booking request record?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Delete Booking">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-slate-500 text-xs">
                            <i class="fa-solid fa-receipt text-3xl text-slate-300 mb-2 block"></i>
                            No cab, bike, or hotel booking requests found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-100">
        {{ $enquiries->links() }}
    </div>
</div>
@endsection
