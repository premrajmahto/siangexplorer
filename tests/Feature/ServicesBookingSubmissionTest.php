<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\BikeRental;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Transportation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicesBookingSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_submit_cab_booking_request(): void
    {
        $this->seed();

        $vehicle = Transportation::firstOrCreate([
            'slug' => 'innova-crysta-suv-test',
        ], [
            'vehicle_name' => 'Innova Crysta SUV Test',
            'vehicle_type' => 'SUV',
            'capacity' => 6,
            'price_per_day' => 4500.00,
            'is_ac' => true,
            'is_active' => true,
        ]);

        $response = $this->post(route('transportation.book', $vehicle), [
            'customer_name' => 'Alex Cab Traveler',
            'customer_phone' => '9876543210',
            'customer_email' => 'alex.cab@example.com',
            'start_date' => now()->addDays(2)->format('Y-m-d'),
            'pickup_location' => 'Guwahati Airport to Shillong',
            'notes' => 'Airport pickup with 3 large suitcases.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('service_enquiries', [
            'service_type' => 'transportation',
            'customer_name' => 'Alex Cab Traveler',
        ]);

        $admin = Admin::first();
        $adminResponse = $this->actingAs($admin, 'admin')->get(route('admin.service-enquiries.index'));
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Alex Cab Traveler');
    }

    public function test_customer_can_submit_bike_booking_request(): void
    {
        $this->seed();

        $bike = BikeRental::firstOrCreate([
            'slug' => 'himalayan-411-test',
        ], [
            'model_name' => 'Himalayan 411 Test',
            'bike_type' => 'Motorcycle',
            'engine_capacity' => '411cc',
            'daily_rate' => 1500.00,
            'is_active' => true,
        ]);

        $response = $this->post(route('bikes.book', $bike), [
            'customer_name' => 'Rider Bob',
            'customer_phone' => '9876543211',
            'customer_email' => 'bob.rider@example.com',
            'start_date' => now()->addDays(3)->format('Y-m-d'),
            'pickup_location' => 'Manali Mall Road Hub',
            'notes' => 'Extra riding helmet needed.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('service_enquiries', [
            'service_type' => 'bike_rental',
            'customer_name' => 'Rider Bob',
        ]);

        $admin = Admin::first();
        $adminResponse = $this->actingAs($admin, 'admin')->get(route('admin.service-enquiries.index'));
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Rider Bob');
    }

    public function test_customer_can_submit_hotel_booking_request(): void
    {
        $this->seed();

        $dest = Destination::first();

        $hotel = Hotel::firstOrCreate([
            'slug' => 'grand-himalayan-resort-test',
        ], [
            'destination_id' => $dest->id,
            'name' => 'Grand Himalayan Resort Test',
            'category' => '5-Star Luxury',
            'price_per_night' => 8500.00,
            'is_active' => true,
        ]);

        $response = $this->post(route('hotels.book', $hotel), [
            'customer_name' => 'Sarah Hotel Guest',
            'customer_phone' => '9876543212',
            'customer_email' => 'sarah.guest@example.com',
            'start_date' => now()->addDays(5)->format('Y-m-d'),
            'end_date' => now()->addDays(7)->format('Y-m-d'),
            'num_guests' => 2,
            'notes' => 'King bed room on high floor.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('service_enquiries', [
            'service_type' => 'hotel',
            'customer_name' => 'Sarah Hotel Guest',
        ]);

        $admin = Admin::first();
        $adminResponse = $this->actingAs($admin, 'admin')->get(route('admin.service-enquiries.index'));
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Sarah Hotel Guest');
    }
}
