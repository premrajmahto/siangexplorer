<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\TourPackage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingEngineTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_create_tour_booking(): void
    {
        $this->seed();

        $tour = TourPackage::first();

        $response = $this->post(route('booking.process', $tour), [
            'travel_date' => date('Y-m-d', strtotime('+7 days')),
            'num_adults' => 2,
            'num_children' => 1,
            'customer_name' => 'Jane Traveler',
            'customer_email' => 'jane@example.com',
            'customer_phone' => '+91 99999 88888',
            'customer_country' => 'India',
        ]);

        $this->assertDatabaseHas('bookings', [
            'customer_email' => 'jane@example.com',
            'num_adults' => 2,
            'num_children' => 1,
        ]);

        $booking = Booking::where('customer_email', 'jane@example.com')->first();
        $response->assertRedirect(route('booking.confirmation', $booking->booking_reference));
    }

    public function test_customer_cannot_access_other_customers_booking(): void
    {
        $this->seed();

        $user1 = User::first();
        $user2 = User::create([
            'name' => 'Second User',
            'email' => 'second@example.com',
            'phone' => '+91 99999 11111',
            'password' => bcrypt('password123'),
        ]);

        $tour = TourPackage::first();
        $booking = Booking::create([
            'booking_reference' => 'TRV-2026-999999',
            'user_id' => $user1->id,
            'tour_package_id' => $tour->id,
            'travel_date' => date('Y-m-d'),
            'num_adults' => 1,
            'base_price' => 10000,
            'final_amount' => 10500,
            'customer_name' => $user1->name,
            'customer_email' => $user1->email,
            'customer_phone' => $user1->phone,
        ]);

        // Login as User 2 and attempt to view User 1's booking
        $this->actingAs($user2);
        $response = $this->get(route('customer.bookings.show', $booking));
        $response->assertStatus(403);
    }
}
