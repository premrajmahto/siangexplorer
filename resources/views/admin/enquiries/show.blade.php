@extends('layouts.admin')

@section('title', 'Lead Details - ' . $enquiry->name)

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Enquiry Lead Details</h1>
        <p class="text-xs text-slate-500 font-medium mt-0.5">Customer lead submitted on {{ $enquiry->created_at->format('d M Y, h:i A') }}</p>
    </div>
    <a href="{{ route('admin.enquiries.index') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-slate-600 hover:text-slate-900 px-3.5 py-2 rounded-xl bg-white border border-slate-200">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Back to Enquiries</span>
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-3">
            <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Lead Message & Inquiry Details</h3>
            <div class="grid grid-cols-2 gap-4 text-xs">
                <p><strong>Customer Name:</strong> {{ $enquiry->name }}</p>
                <p><strong>Email:</strong> {{ $enquiry->email }}</p>
                <p><strong>Phone:</strong> {{ $enquiry->phone }}</p>
                <p><strong>Travel Date:</strong> {{ $enquiry->travel_date ? $enquiry->travel_date->format('d M Y') : 'Flexible' }}</p>
                <p><strong>Travelers:</strong> {{ $enquiry->num_travelers ?? 'N/A' }} Persons</p>
                <p><strong>Budget:</strong> ₹{{ number_format($enquiry->budget ?? 0, 2) }}</p>
            </div>
            <div class="pt-3 border-t border-slate-100">
                <span class="block text-[10px] font-bold uppercase text-slate-400">Message</span>
                <p class="text-xs text-slate-700 font-medium mt-1 leading-relaxed">{{ $enquiry->message ?? 'No additional message provided.' }}</p>
            </div>
        </div>

        <!-- Internal Notes -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Internal Staff Notes</h3>

            <form action="{{ route('admin.enquiries.addNote', $enquiry) }}" method="POST" class="space-y-3">
                @csrf
                <textarea name="note" rows="2" required placeholder="Add follow-up notes, call summaries, or customer preferences..." class="w-full p-3 text-xs rounded-xl border border-slate-300"></textarea>
                <button type="submit" class="px-4 py-2 bg-slate-900 text-white font-bold text-xs rounded-xl shadow-sm">
                    Add Note
                </button>
            </form>

            <div class="divide-y divide-slate-100 pt-3">
                @forelse($enquiry->notes as $note)
                    <div class="py-3 text-xs space-y-1">
                        <div class="flex items-center justify-between font-bold text-slate-900">
                            <span>{{ $note->admin->name ?? 'Staff' }}</span>
                            <span class="text-[10px] font-normal text-slate-400">{{ $note->created_at->format('d M Y, h:i A') }}</span>
                        </div>
                        <p class="text-slate-600 font-normal leading-relaxed">{{ $note->note }}</p>
                    </div>
                @empty
                    <p class="text-xs text-slate-400 pt-2">No internal notes recorded for this lead yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="font-extrabold text-slate-900 text-sm border-b border-slate-100 pb-3">Lead Assignment & Status</h3>
            
            <form action="{{ route('admin.enquiries.updateStatus', $enquiry) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 font-bold">
                        <option value="new" {{ $enquiry->status === 'new' ? 'selected' : '' }}>New Lead</option>
                        <option value="contacted" {{ $enquiry->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                        <option value="follow-up" {{ $enquiry->status === 'follow-up' ? 'selected' : '' }}>Follow-Up</option>
                        <option value="converted" {{ $enquiry->status === 'converted' ? 'selected' : '' }}>Converted</option>
                        <option value="closed" {{ $enquiry->status === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Assign To Staff</label>
                    <select name="assigned_admin_id" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 font-bold">
                        <option value="">Unassigned</option>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}" {{ $enquiry->assigned_admin_id == $admin->id ? 'selected' : '' }}>{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl shadow-md">
                    Update Lead Info
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
