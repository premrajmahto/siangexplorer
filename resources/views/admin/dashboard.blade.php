@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Header Page Title -->
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Overview & Performance</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Real-time statistics for tour bookings, car/bike rentals, hotel enquiries, revenue, and leads.</p>
    </div>
    <div class="flex flex-wrap items-center gap-3">
        <form action="{{ route('admin.deploy.sync') }}" method="POST" class="inline-block" onsubmit="return confirm('Do you want to pull latest code and re-seed all tours on the live server?');">
            @csrf
            <button type="submit" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md shadow-emerald-600/20 transition-all">
                <i class="fa-solid fa-rotate text-xs"></i>
                <span>Sync Live Server & Database</span>
            </button>
        </form>
        <a href="{{ route('admin.service-enquiries.index') }}" 
           class="inline-flex items-center space-x-2 px-4 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs rounded-xl shadow-md shadow-teal-600/20 transition-all">
            <i class="fa-solid fa-car-side text-xs"></i>
            <span>Cab, Bike & Hotel Bookings</span>
        </a>
        <a href="{{ route('admin.tours.create') }}" 
           class="inline-flex items-center space-x-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md shadow-brand-600/20 transition-all">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Add New Tour</span>
        </a>
    </div>
</div>

<!-- Stat Cards Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6">
    <x-admin.stat-card 
        title="Tour Bookings" 
        value="{{ $totalBookings }}" 
        icon="fa-calendar-check" 
        bg="bg-teal-600" 
        subtitle="{{ $pendingBookings }} pending confirmation" />

    <x-admin.stat-card 
        title="Cab/Bike/Hotel Requests" 
        value="{{ $totalServiceEnquiries }}" 
        icon="fa-car-side" 
        bg="bg-indigo-600" 
        subtitle="{{ $newServiceEnquiries }} new bookings" />

    <x-admin.stat-card 
        title="Total Revenue" 
        value="₹{{ number_format($totalRevenue, 2) }}" 
        icon="fa-indian-rupee-sign" 
        bg="bg-emerald-600" 
        subtitle="₹{{ number_format($pendingPaymentsAmount, 2) }} pending payments" />

    <x-admin.stat-card 
        title="Active Tours" 
        value="{{ $totalTours }}" 
        icon="fa-compass" 
        bg="bg-sky-600" 
        subtitle="{{ $totalDestinations }} destinations mapped" />

    <x-admin.stat-card 
        title="Total Enquiries" 
        value="{{ $totalEnquiries }}" 
        icon="fa-headset" 
        bg="bg-amber-500" 
        subtitle="{{ $newEnquiries }} new leads to follow up" />
</div>

<!-- Revenue Analytics Chart & Popular Tours Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Chart Widget -->
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
            <div>
                <h3 class="font-extrabold text-slate-900 text-sm">Monthly Paid Revenue Trend</h3>
                <p class="text-[11px] text-slate-500">Gross revenue for past 6 months</p>
            </div>
            <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-extrabold rounded-md border border-emerald-200 uppercase">Paid Transactions</span>
        </div>
        <div class="h-64 flex items-end justify-between gap-2 pt-4 px-2">
            @php $maxRevenue = max(array_merge($revenueData, [1])); @endphp
            @foreach($revenueData as $idx => $amount)
                @php $heightPercent = max(10, min(100, round(($amount / $maxRevenue) * 100))); @endphp
                <div class="flex-1 flex flex-col items-center gap-2 group">
                    <span class="text-[10px] font-bold text-slate-600 opacity-0 group-hover:opacity-100 transition-opacity">₹{{ number_format($amount) }}</span>
                    <div class="w-full bg-brand-500/20 group-hover:bg-brand-600 rounded-t-lg transition-all" style="height: {{ $heightPercent }}%;"></div>
                    <span class="text-[10px] font-bold text-slate-500">{{ $months[$idx] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Popular Tours Sidebar Widget -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="font-extrabold text-slate-900 text-sm">Popular Tour Packages</h3>
            <a href="{{ route('admin.tours.index') }}" class="text-xs font-bold text-brand-600 hover:underline">View All</a>
        </div>
        <div class="space-y-3">
            @forelse($popularTours as $tour)
                <div class="flex items-center space-x-3 p-2 rounded-xl hover:bg-slate-50 transition-colors">
                    <img src="{{ $tour->cover_image_url }}" alt="{{ $tour->title }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                    <div class="flex-1 min-w-0">
                        <h4 class="font-extrabold text-xs text-slate-900 truncate">{{ $tour->title }}</h4>
                        <p class="text-[10px] text-slate-500">₹{{ number_format($tour->starting_price, 2) }} • {{ $tour->bookings_count }} Bookings</p>
                    </div>
                </div>
            @empty
                <p class="text-xs text-slate-400 text-center py-4">No popular tours tracked yet.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Cab, Bike & Hotel Service Bookings (Recently Received Requests) -->
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col mb-6">
    <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
        <div>
            <h3 class="font-extrabold text-slate-900 text-sm flex items-center space-x-2">
                <i class="fa-solid fa-car-side text-teal-600"></i>
                <span>Recent Cab, Bike & Hotel Booking Requests</span>
            </h3>
            <p class="text-[11px] text-slate-500">Customer reservations for vehicle rentals, self-drive bikes, and hotel stays</p>
        </div>
        <a href="{{ route('admin.service-enquiries.index') }}" class="text-xs font-extrabold text-teal-600 hover:underline flex items-center space-x-1">
            <span>Manage All Requests</span>
            <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs text-slate-700">
            <thead class="bg-slate-100/70 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3">Service & Requested Item</th>
                    <th class="px-4 py-3">Customer Contact</th>
                    <th class="px-4 py-3">Travel Date & Pickup</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($recentServiceEnquiries as $sReq)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="px-4 py-3">
                            <div class="space-y-0.5">
                                @if($sReq->service_type === 'transportation')
                                    <span class="px-2 py-0.5 bg-teal-50 text-teal-700 text-[10px] font-bold rounded-md">Cab Rental</span>
                                    <span class="font-bold text-slate-900 block">{{ $sReq->service_item->vehicle_name ?? 'Vehicle #' . $sReq->service_id }}</span>
                                @elseif($sReq->service_type === 'bike_rental')
                                    <span class="px-2 py-0.5 bg-amber-50 text-amber-700 text-[10px] font-bold rounded-md">Bike Rental</span>
                                    <span class="font-bold text-slate-900 block">{{ $sReq->service_item->model_name ?? 'Bike #' . $sReq->service_id }}</span>
                                @else
                                    <span class="px-2 py-0.5 bg-brand-50 text-brand-700 text-[10px] font-bold rounded-md">Hotel Stay</span>
                                    <span class="font-bold text-slate-900 block">{{ $sReq->service_item->name ?? 'Hotel #' . $sReq->service_id }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="font-bold block text-slate-800">{{ $sReq->customer_name }}</span>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $sReq->customer_phone) }}" target="_blank" class="text-[10px] text-emerald-600 hover:underline">
                                <i class="fa-brands fa-whatsapp"></i> {{ $sReq->customer_phone }}
                            </a>
                        </td>
                        <td class="px-4 py-3">
                            <span class="font-semibold text-slate-800 block">{{ $sReq->start_date ? $sReq->start_date->format('d M Y') : 'N/A' }}</span>
                            <span class="text-[10px] text-slate-400 block">{{ $sReq->pickup_location ?? 'N/A' }}</span>
                        </td>
                        <td class="px-4 py-3">
                            @if($sReq->status === 'confirmed')
                                <span class="px-2 py-0.5 text-[10px] font-bold text-emerald-700 bg-emerald-50 rounded-full border border-emerald-200">Confirmed</span>
                            @elseif($sReq->status === 'new')
                                <span class="px-2 py-0.5 text-[10px] font-bold text-amber-700 bg-amber-50 rounded-full border border-amber-200">New Request</span>
                            @else
                                <span class="px-2 py-0.5 text-[10px] font-bold text-slate-700 bg-slate-100 rounded-full">{{ ucfirst($sReq->status) }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.service-enquiries.index') }}" class="px-3 py-1 bg-slate-900 hover:bg-brand-600 text-white font-bold text-[10px] rounded-lg transition-colors">
                                View Request
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-slate-400 text-xs">No recent cab, bike or hotel requests recorded.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Tour Bookings & General Enquiries Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Tour Bookings Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div>
                <h3 class="font-extrabold text-slate-900 text-sm">Recent Tour Bookings</h3>
                <p class="text-[11px] text-slate-500">Latest paid & pending tour package reservations</p>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-brand-600 hover:underline">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-100/70 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3">Booking Ref</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Tour Package</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentBookings as $booking)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-4 py-3 font-mono font-bold text-brand-700">{{ $booking->booking_reference }}</td>
                            <td class="px-4 py-3 text-[11px]">
                                <span class="font-bold block text-slate-800">{{ $booking->customer_name }}</span>
                                <span class="text-[10px] text-slate-400">{{ $booking->customer_phone }}</span>
                            </td>
                            <td class="px-4 py-3 max-w-[140px] truncate font-medium">{{ $booking->tourPackage->title ?? 'N/A' }}</td>
                            <td class="px-4 py-3 font-bold text-slate-900">₹{{ number_format($booking->final_amount, 2) }}</td>
                            <td class="px-4 py-3">
                                @if($booking->booking_status === 'confirmed')
                                    <span class="px-2 py-0.5 text-[10px] font-bold text-emerald-700 bg-emerald-50 rounded-full border border-emerald-200">Confirmed</span>
                                @elseif($booking->booking_status === 'pending')
                                    <span class="px-2 py-0.5 text-[10px] font-bold text-amber-700 bg-amber-50 rounded-full border border-amber-200">Pending</span>
                                @elseif($booking->booking_status === 'completed')
                                    <span class="px-2 py-0.5 text-[10px] font-bold text-sky-700 bg-sky-50 rounded-full border border-sky-200">Completed</span>
                                @else
                                    <span class="px-2 py-0.5 text-[10px] font-bold text-rose-700 bg-rose-50 rounded-full border border-rose-200">{{ ucfirst($booking->booking_status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-slate-400 text-xs">No recent bookings recorded.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Enquiries Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div>
                <h3 class="font-extrabold text-slate-900 text-sm">Recent Customer Enquiries</h3>
                <p class="text-[11px] text-slate-500">Incoming trip leads</p>
            </div>
            <a href="{{ route('admin.enquiries.index') }}" class="text-xs font-bold text-brand-600 hover:underline">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-100/70 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3">Lead Name</th>
                        <th class="px-4 py-3">Contact</th>
                        <th class="px-4 py-3">Destination / Tour</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentEnquiries as $enquiry)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-4 py-3 font-bold text-slate-800">{{ $enquiry->name }}</td>
                            <td class="px-4 py-3 text-[11px]">
                                <span class="block text-slate-600">{{ $enquiry->email }}</span>
                                <span class="text-slate-400">{{ $enquiry->phone }}</span>
                            </td>
                            <td class="px-4 py-3 max-w-[140px] truncate font-medium">
                                {{ $enquiry->tourPackage->title ?? $enquiry->destination->name ?? 'General Enquiry' }}
                            </td>
                            <td class="px-4 py-3">
                                @if($enquiry->status === 'new')
                                    <span class="px-2 py-0.5 text-[10px] font-bold text-indigo-700 bg-indigo-50 rounded-full border border-indigo-200">New Lead</span>
                                @elseif($enquiry->status === 'contacted')
                                    <span class="px-2 py-0.5 text-[10px] font-bold text-sky-700 bg-sky-50 rounded-full border border-sky-200">Contacted</span>
                                @elseif($enquiry->status === 'converted')
                                    <span class="px-2 py-0.5 text-[10px] font-bold text-emerald-700 bg-emerald-50 rounded-full border border-emerald-200">Converted</span>
                                @else
                                    <span class="px-2 py-0.5 text-[10px] font-bold text-slate-700 bg-slate-100 rounded-full">{{ ucfirst($enquiry->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-slate-400 text-xs">No recent customer enquiries recorded.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
