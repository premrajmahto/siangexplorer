<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_render_dashboard(): void
    {
        $this->seed();
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')->get(route('customer.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Customer Portal');
        $response->assertSee($user->name);
    }

    public function test_customer_can_render_bookings_page(): void
    {
        $this->seed();
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')->get(route('customer.bookings'));
        $response->assertStatus(200);
        $response->assertSee('My Tour Bookings');
    }

    public function test_customer_can_render_profile_page(): void
    {
        $this->seed();
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')->get(route('customer.profile'));
        $response->assertStatus(200);
        $response->assertSee('Manage Profile');
    }
}
