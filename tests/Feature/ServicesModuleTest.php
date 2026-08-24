<?php

namespace Tests\Feature;

use App\Models\BikeRental;
use App\Models\Hotel;
use App\Models\Transportation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicesModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_hotels_page_can_be_rendered(): void
    {
        $this->seed();

        $response = $this->get('/hotels');
        $response->assertStatus(200);
        $response->assertSee('Hotels');
    }

    public function test_transportation_page_can_be_rendered(): void
    {
        $this->seed();

        $response = $this->get('/transportation');
        $response->assertStatus(200);
        $response->assertSee('Cab & Vehicle Rentals');
    }

    public function test_bike_rentals_page_can_be_rendered(): void
    {
        $this->seed();

        $response = $this->get('/bikes');
        $response->assertStatus(200);
        $response->assertSee('Motorcycle');
    }

    public function test_customer_can_submit_hotel_booking_enquiry(): void
    {
        $this->seed();

        $hotel = Hotel::first();

        $response = $this->post(route('hotels.book', $hotel), [
            'customer_name' => 'Alice Traveler',
            'customer_email' => 'alice@example.com',
            'customer_phone' => '+91 98765 11111',
            'start_date' => date('Y-m-d', strtotime('+3 days')),
            'end_date' => date('Y-m-d', strtotime('+6 days')),
            'num_guests' => 2,
        ]);

        $this->assertDatabaseHas('service_enquiries', [
            'service_type' => 'hotel',
            'customer_email' => 'alice@example.com',
        ]);

        $response->assertSessionHas('success');
    }
}
