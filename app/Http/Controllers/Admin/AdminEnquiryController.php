<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Enquiry;
use App\Models\EnquiryNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Enquiry::with(['destination', 'tourPackage', 'assignedAdmin']);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $enquiries = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();
        $admins = Admin::where('is_active', true)->get();

        return view('admin.enquiries.index', compact('enquiries', 'admins'));
    }

    public function show(Enquiry $enquiry)
    {
        $enquiry->load(['destination', 'tourPackage', 'assignedAdmin', 'notes.admin']);
        $admins = Admin::where('is_active', true)->get();

        return view('admin.enquiries.show', compact('enquiry', 'admins'));
    }

    public function updateStatus(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'status' => ['required', 'string'],
            'assigned_admin_id' => ['nullable', 'exists:admins,id'],
        ]);

        $enquiry->update([
            'status' => $request->status,
            'assigned_admin_id' => $request->assigned_admin_id,
        ]);

        return back()->with('success', 'Enquiry lead status updated!');
    }

    public function addNote(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'note' => ['required', 'string'],
        ]);

        EnquiryNote::create([
            'enquiry_id' => $enquiry->id,
            'admin_id' => Auth::guard('admin')->id(),
            'note' => $request->note,
        ]);

        return back()->with('success', 'Internal note added to lead record!');
    }
}
