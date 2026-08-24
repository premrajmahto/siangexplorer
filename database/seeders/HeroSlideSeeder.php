<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'tag' => 'Handpicked Vacations',
                'title' => 'Discover The World’s Most Extraordinary <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 via-teal-300 to-amber-300 italic">Destinations</span>',
                'subtitle' => 'Curated luxury tour packages with day-wise itineraries, 5-star accommodations, private transfers, and 24/7 personal travel concierge.',
                'cover_image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=2000&q=80',
                'badge_icon' => 'fa-sparkles',
                'cta_text' => 'Search Tour Packages',
                'cta_link' => '/tours',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'tag' => 'Tropical Coastal Retreats',
                'title' => 'Unwind in Pure Coastal Bliss & <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-brand-300 to-teal-300 italic">Pristine Resorts</span>',
                'subtitle' => 'Experience white sand beaches, luxury heritage villas, Kerala houseboat cruises, and vibrant nightlife packages.',
                'cover_image' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=2000&q=80',
                'badge_icon' => 'fa-umbrella-beach',
                'cta_text' => 'Explore Luxury Hotels',
                'cta_link' => '/hotels',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'tag' => 'Self-Drive & Fleet Services',
                'title' => 'Rent Himalayan Motorbikes & <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 via-amber-300 to-brand-300 italic">Private Luxury Cabs</span>',
                'subtitle' => 'Rent Royal Enfield Himalayan 411cc bikes, Innova Crysta SUVs, and Tempo Travellers for unforgettable mountain road trips.',
                'cover_image' => 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&w=2000&q=80',
                'badge_icon' => 'fa-motorcycle',
                'cta_text' => 'Browse Bike & Cab Fleet',
                'cta_link' => '/bikes',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'tag' => 'International Getaways',
                'title' => 'Explore Global Wonders & <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-teal-300 to-brand-300 italic">Worldwide Tours</span>',
                'subtitle' => 'Discover Dubai skyline safaris, Bali tropical retreats, European mountain trains, and visa-assisted holiday packages.',
                'cover_image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=2000&q=80',
                'badge_icon' => 'fa-plane-departure',
                'cta_text' => 'Explore Destinations',
                'cta_link' => '/destinations',
                'sort_order' => 4,
                'is_active' => true,
            ]
        ];

        foreach ($slides as $slide) {
            HeroSlide::firstOrCreate(['tag' => $slide['tag']], $slide);
        }
    }
}
