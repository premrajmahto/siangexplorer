@extends('layouts.admin')

@section('title', 'Customer Enquiries & Leads')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Customer Enquiries & Lead Desk</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Manage customer inquiries, assign staff, and record internal notes.</p>
    </div>
</div>

<div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm">
    <form action="{{ route('admin.enquiries.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search lead name, email..." class="px-3.5 py-2 text-xs rounded-xl bg-slate-100 border border-slate-200">
        
        <select name="status" onchange="this.form.submit()" class="px-3 py-2 text-xs rounded-xl bg-slate-100 border border-slate-200">
            <option value="">All Lead Statuses</option>
            <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New Leads</option>
            <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
            <option value="follow-up" {{ request('status') === 'follow-up' ? 'selected' : '' }}>Follow-Up</option>
            <option value="converted" {{ request('status') === 'converted' ? 'selected' : '' }}>Converted</option>
            <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
        </select>

        <button type="submit" class="px-4 py-2 bg-slate-900 text-white text-xs font-bold rounded-xl">Filter</button>
    </form>
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
    <table class="w-full text-left text-xs text-slate-700">
        <thead class="bg-slate-100/80 text-[10px] font-bold text-slate-500 uppercase">
            <tr>
                <th class="px-4 py-3.5">Lead Name</th>
                <th class="px-4 py-3.5">Contact Info</th>
                <th class="px-4 py-3.5">Package / Destination</th>
                <th class="px-4 py-3.5">Status</th>
                <th class="px-4 py-3.5">Assigned To</th>
                <th class="px-4 py-3.5 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($enquiries as $enquiry)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-4 py-3 font-bold text-slate-900">{{ $enquiry->name }}</td>
                    <td class="px-4 py-3">
                        <span class="block font-medium">{{ $enquiry->email }}</span>
                        <span class="text-[10px] text-slate-400">{{ $enquiry->phone }}</span>
                    </td>
                    <td class="px-4 py-3 font-medium max-w-[160px] truncate">
                        {{ $enquiry->tourPackage->title ?? $enquiry->destination->name ?? 'General Inquiry' }}
                    </td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.enquiries.updateStatus', $enquiry) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="text-[10px] font-bold py-1 px-2 rounded-lg border border-slate-200">
                                <option value="new" {{ $enquiry->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="contacted" {{ $enquiry->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="follow-up" {{ $enquiry->status === 'follow-up' ? 'selected' : '' }}>Follow-Up</option>
                                <option value="converted" {{ $enquiry->status === 'converted' ? 'selected' : '' }}>Converted</option>
                                <option value="closed" {{ $enquiry->status === 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3 text-slate-600 font-medium">
                        {{ $enquiry->assignedAdmin->name ?? 'Unassigned' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.enquiries.show', $enquiry) }}" class="px-3 py-1 bg-slate-900 text-white font-bold text-[10px] rounded-lg">
                            View Lead
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-slate-400">No enquiries recorded yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $enquiries->links() }}
</div>
@endsection
