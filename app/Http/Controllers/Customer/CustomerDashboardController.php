<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalBookings = Booking::where('user_id', $user->id)->count();
        $confirmedBookings = Booking::where('user_id', $user->id)->where('booking_status', 'confirmed')->count();
        $pendingBookings = Booking::where('user_id', $user->id)->where('booking_status', 'pending')->count();

        $recentBookings = Booking::with('tourPackage.destination')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact(
            'user',
            'totalBookings',
            'confirmedBookings',
            'pendingBookings',
            'recentBookings'
        ));
    }

    public function bookings()
    {
        $user = Auth::user();
        $bookings = Booking::with('tourPackage.destination')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('customer.bookings.index', compact('bookings'));
    }

    public function showBooking(Booking $booking)
    {
        // Enforce Strict Customer Data Isolation
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to booking records.');
        }

        $booking->load(['tourPackage.destination', 'items', 'payments']);

        return view('customer.bookings.show', compact('booking'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('customer.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:100'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return back()->with('success', 'Profile information updated successfully!');
    }
}
