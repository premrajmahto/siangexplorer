<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BikeRental;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Destination;
use App\Models\Enquiry;
use App\Models\Hotel;
use App\Models\Payment;
use App\Models\ServiceEnquiry;
use App\Models\TourPackage;
use App\Models\Transportation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('booking_status', 'pending')->count();
        $confirmedBookings = Booking::where('booking_status', 'confirmed')->count();
        $completedBookings = Booking::where('booking_status', 'completed')->count();
        $cancelledBookings = Booking::where('booking_status', 'cancelled')->count();

        $totalEnquiries = Enquiry::count();
        $newEnquiries = Enquiry::where('status', 'new')->count();

        $totalServiceEnquiries = ServiceEnquiry::count();
        $newServiceEnquiries = ServiceEnquiry::where('status', 'new')->count();

        $totalCustomers = User::count();
        $totalTours = TourPackage::count();
        $totalDestinations = Destination::count();

        $totalRevenue = Payment::where('payment_status', 'paid')->sum('amount');
        $pendingPaymentsAmount = Booking::where('payment_status', 'pending')->sum('final_amount');

        $recentBookings = Booking::with(['tourPackage', 'user'])
            ->latest()
            ->take(6)
            ->get();

        $recentEnquiries = Enquiry::with(['destination', 'tourPackage'])
            ->latest()
            ->take(6)
            ->get();

        $recentServiceEnquiries = ServiceEnquiry::latest()->take(6)->get();

        foreach ($recentServiceEnquiries as $enquiry) {
            if ($enquiry->service_type === 'transportation') {
                $enquiry->service_item = Transportation::find($enquiry->service_id);
            } elseif ($enquiry->service_type === 'bike_rental') {
                $enquiry->service_item = BikeRental::find($enquiry->service_id);
            } elseif ($enquiry->service_type === 'hotel') {
                $enquiry->service_item = Hotel::find($enquiry->service_id);
            }
        }

        $popularTours = TourPackage::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(5)
            ->get();

        // Monthly revenue for the past 6 months
        $months = [];
        $revenueData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->format('M Y');
            $months[] = $monthName;

            $rev = Payment::where('payment_status', 'paid')
                ->whereYear('paid_at', $date->year)
                ->whereMonth('paid_at', $date->month)
                ->sum('amount');

            $revenueData[] = (float) $rev;
        }

        return view('admin.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'confirmedBookings',
            'completedBookings',
            'cancelledBookings',
            'totalEnquiries',
            'newEnquiries',
            'totalServiceEnquiries',
            'newServiceEnquiries',
            'totalCustomers',
            'totalTours',
            'totalDestinations',
            'totalRevenue',
            'pendingPaymentsAmount',
            'recentBookings',
            'recentEnquiries',
            'recentServiceEnquiries',
            'popularTours',
            'months',
            'revenueData'
        ));
    }

    public function syncLiveData()
    {
        try {
            $gitOutput = shell_exec('git pull origin main 2>&1') ?? 'Git executed';

            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'TourSeeder', '--force' => true]);
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'PageSeeder', '--force' => true]);
            \Illuminate\Support\Facades\Artisan::call('config:clear');
            \Illuminate\Support\Facades\Artisan::call('cache:clear');
            \Illuminate\Support\Facades\Artisan::call('view:clear');

            return redirect()->back()->with('success', 'Hostinger Live Server Database and Seeders synced successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Sync failed: ' . $e->getMessage());
        }
    }
}
