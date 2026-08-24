<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicFrontendTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_can_be_rendered(): void
    {
        $this->seed();

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('SiangExplorer');
    }

    public function test_tour_listing_page_can_be_rendered(): void
    {
        $this->seed();

        $response = $this->get('/tours');
        $response->assertStatus(200);
        $response->assertSee('All Tour Packages');
    }

    public function test_destinations_listing_page_can_be_rendered(): void
    {
        $this->seed();

        $response = $this->get('/destinations');
        $response->assertStatus(200);
        $response->assertSee('Explore All Destinations');
    }

    public function test_contact_page_can_be_rendered(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Contact Our Concierge');
    }
}
