<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BikeRental;
use App\Models\Hotel;
use App\Models\ServiceEnquiry;
use App\Models\Transportation;
use Illuminate\Http\Request;

class AdminServiceEnquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceEnquiry::query();

        if ($request->filled('type')) {
            $query->where('service_type', $request->input('type'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $enquiries = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Eagerly resolve service item details
        foreach ($enquiries as $enquiry) {
            if ($enquiry->service_type === 'transportation') {
                $enquiry->service_item = Transportation::find($enquiry->service_id);
            } elseif ($enquiry->service_type === 'bike_rental') {
                $enquiry->service_item = BikeRental::find($enquiry->service_id);
            } elseif ($enquiry->service_type === 'hotel') {
                $enquiry->service_item = Hotel::find($enquiry->service_id);
            }
        }

        return view('admin.service_enquiries.index', compact('enquiries'));
    }

    public function updateStatus(Request $request, ServiceEnquiry $serviceEnquiry)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:new,confirmed,cancelled'],
        ]);

        $serviceEnquiry->update(['status' => $validated['status']]);

        return back()->with('success', 'Service booking status updated to ' . ucfirst($validated['status']) . '!');
    }

    public function destroy(ServiceEnquiry $serviceEnquiry)
    {
        $serviceEnquiry->delete();
        return back()->with('success', 'Service booking record deleted.');
    }
}
