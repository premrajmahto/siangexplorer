@extends('layouts.admin')

@section('title', 'Cab & Fleet Management')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Transportation Fleet Management</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Manage cabs, SUVs, Tempo Travellers, rates, and passenger capacities.</p>
    </div>
    <a href="{{ route('admin.transportation.create') }}" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-xs rounded-xl shadow-md transition-all">
        <i class="fa-solid fa-plus"></i>
        <span>Add New Vehicle</span>
    </a>
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <table class="w-full text-left text-xs text-slate-700">
        <thead class="bg-slate-100/80 text-[10px] font-bold text-slate-500 uppercase">
            <tr>
                <th class="px-4 py-3.5">Vehicle Name</th>
                <th class="px-4 py-3.5">Type</th>
                <th class="px-4 py-3.5">Seats</th>
                <th class="px-4 py-3.5">Daily Rate</th>
                <th class="px-4 py-3.5 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($vehicles as $vehicle)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-4 py-3 font-bold text-slate-900 flex items-center space-x-3">
                        <img src="{{ $vehicle->cover_image_url }}" class="w-10 h-10 rounded-lg object-cover">
                        <span>{{ $vehicle->vehicle_name }}</span>
                    </td>

                    <td class="px-4 py-3 font-medium text-slate-800">{{ $vehicle->vehicle_type }}</td>
                    <td class="px-4 py-3 font-bold">{{ $vehicle->capacity }} Seats</td>
                    <td class="px-4 py-3 font-extrabold text-slate-900">₹{{ number_format($vehicle->price_per_day, 2) }}</td>
                    <td class="px-4 py-3 text-right">
                        <form action="{{ route('admin.transportation.destroy', $vehicle) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-700 font-bold text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-8 text-slate-400">No transportation vehicles added yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $vehicles->links() }}
</div>
@endsection
