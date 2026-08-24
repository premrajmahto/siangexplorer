@extends('layouts.admin')

@section('title', 'Customer Accounts')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Registered Customers Directory</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Manage customer accounts, contact information, and trip history.</p>
    </div>
</div>

<div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm">
    <form action="{{ route('admin.customers.index') }}" method="GET" class="flex items-center gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customer name, email, phone..." class="w-full sm:w-80 px-3.5 py-2 text-xs rounded-xl bg-slate-100 border border-slate-200">
        <button type="submit" class="px-4 py-2 bg-slate-900 text-white text-xs font-bold rounded-xl">Search</button>
    </form>
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <table class="w-full text-left text-xs text-slate-700">
        <thead class="bg-slate-100/80 text-[10px] font-bold text-slate-500 uppercase">
            <tr>
                <th class="px-4 py-3.5">Customer Name</th>
                <th class="px-4 py-3.5">Email</th>
                <th class="px-4 py-3.5">Phone</th>
                <th class="px-4 py-3.5">Country</th>
                <th class="px-4 py-3.5">Bookings Count</th>
                <th class="px-4 py-3.5">Joined Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($customers as $customer)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-4 py-3 font-bold text-slate-900">{{ $customer->name }}</td>
                    <td class="px-4 py-3 text-slate-600 font-medium">{{ $customer->email }}</td>
                    <td class="px-4 py-3 font-mono">{{ $customer->phone ?? 'N/A' }}</td>
                    <td class="px-4 py-3 text-slate-600">{{ $customer->country ?? 'India' }}</td>
                    <td class="px-4 py-3 font-extrabold text-brand-600">{{ $customer->bookings_count }} bookings</td>
                    <td class="px-4 py-3 text-slate-400 text-[11px]">{{ $customer->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-slate-400">No customer accounts registered yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $customers->links() }}
</div>
@endsection
