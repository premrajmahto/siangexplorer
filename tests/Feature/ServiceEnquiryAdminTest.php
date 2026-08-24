<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\ServiceEnquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceEnquiryAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_service_enquiries_index(): void
    {
        $this->seed();
        $admin = Admin::first();

        $response = $this->actingAs($admin, 'admin')->get(route('admin.service-enquiries.index'));
        $response->assertStatus(200);
        $response->assertSee('Car, Bike');
    }

    public function test_admin_can_filter_transportation_bookings(): void
    {
        $this->seed();
        $admin = Admin::first();

        ServiceEnquiry::create([
            'service_type' => 'transportation',
            'service_id' => 1,
            'customer_name' => 'John Doe Driver',
            'customer_email' => 'john.driver@example.com',
            'customer_phone' => '9876543210',
            'start_date' => now()->addDays(2),
            'status' => 'new',
        ]);

        $response = $this->actingAs($admin, 'admin')->get(route('admin.service-enquiries.index', ['type' => 'transportation']));
        $response->assertStatus(200);
        $response->assertSee('John Doe Driver');
    }

    public function test_admin_can_update_service_booking_status(): void
    {
        $this->seed();
        $admin = Admin::first();

        $enquiry = ServiceEnquiry::create([
            'service_type' => 'bike_rental',
            'service_id' => 1,
            'customer_name' => 'Rider Jane',
            'customer_email' => 'jane.rider@example.com',
            'customer_phone' => '9876543211',
            'start_date' => now()->addDays(3),
            'status' => 'new',
        ]);

        $response = $this->actingAs($admin, 'admin')->patch(route('admin.service-enquiries.updateStatus', $enquiry), [
            'status' => 'confirmed',
        ]);

        $this->assertDatabaseHas('service_enquiries', [
            'id' => $enquiry->id,
            'status' => 'confirmed',
        ]);
    }
}
