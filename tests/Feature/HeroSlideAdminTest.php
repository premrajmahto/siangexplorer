<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\HeroSlide;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HeroSlideAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_hero_slides_index(): void
    {
        $this->seed();
        $admin = Admin::first();

        $response = $this->actingAs($admin, 'admin')->get(route('admin.hero-slides.index'));
        $response->assertStatus(200);
        $response->assertSee('Hero Section Slider Manager');
    }

    public function test_admin_can_create_new_hero_slide(): void
    {
        $this->seed();
        $admin = Admin::first();

        $response = $this->actingAs($admin, 'admin')->post(route('admin.hero-slides.store'), [
            'tag' => 'Special Winter Deal',
            'title' => 'Explore Snow Mountains',
            'subtitle' => 'Exclusive winter discounts available now.',
            'cover_image_url_input' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=2000&q=80',
            'cta_text' => 'Book Winter Tour',
            'cta_link' => '/tours',
            'sort_order' => 1,
            'is_active' => '1',
        ]);

        $this->assertDatabaseHas('hero_slides', [
            'tag' => 'Special Winter Deal',
            'cta_text' => 'Book Winter Tour',
        ]);

        $response->assertRedirect(route('admin.hero-slides.index'));
    }

    public function test_admin_can_update_hero_slide(): void
    {
        $this->seed();
        $admin = Admin::first();

        $slide = HeroSlide::create([
            'tag' => 'Initial Tag',
            'title' => 'Initial Title',
            'subtitle' => 'Initial Subtitle',
            'cover_image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=2000&q=80',
            'cta_text' => 'Initial CTA',
            'cta_link' => '/tours',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin, 'admin')->put(route('admin.hero-slides.update', ['hero_slide' => $slide->id]), [
            'tag' => 'Updated Beach Vacation',
            'title' => 'Updated Title Text',
            'subtitle' => 'Updated Subtitle Text',
            'cta_text' => 'Explore Packages',
            'cta_link' => '/tours',
            'sort_order' => 5,
            'is_active' => '1',
        ]);

        $this->assertDatabaseHas('hero_slides', [
            'id' => $slide->id,
            'tag' => 'Updated Beach Vacation',
        ]);

        $response->assertRedirect(route('admin.hero-slides.index'));
    }
}
