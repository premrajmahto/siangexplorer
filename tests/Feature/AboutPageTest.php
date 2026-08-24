<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_page_can_be_rendered(): void
    {
        $this->seed();

        $response = $this->get('/about');
        $response->assertStatus(200);
        $response->assertSee('Specialized in North East India');
        $response->assertSee('Guwahati');
    }

    public function test_about_us_slug_redirects_to_about_route(): void
    {
        $this->seed();

        $response = $this->get('/pages/about-us');
        $response->assertRedirect(route('about'));
    }
}
