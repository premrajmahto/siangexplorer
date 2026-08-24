<?php

namespace Database\Seeders;

use App\Models\BikeRental;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Transportation;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        $manali = Destination::where('slug', 'manali-solang-valley')->first();
        $goa = Destination::where('slug', 'goa-beaches-nightlife')->first();

        // 1. Hotels
        if ($manali) {
            Hotel::updateOrCreate(['slug' => 'grand-himalayan-resort-spa-manali'], [
                'name' => 'The Grand Himalayan Resort & Spa',
                'destination_id' => $manali->id,
                'category' => '5-Star',
                'city' => 'Manali',
                'price_per_night' => 8500.00,
                'cover_image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
                'amenities' => 'Free WiFi, Swimming Pool, Heated Jacuzzi, Spa & Wellness, Mountain View Balcony, Multi-Cuisine Restaurant',
                'short_description' => 'Luxury 5-Star valley-facing resort surrounded by pine forests and snow-capped mountain peaks.',
                'description' => 'Experience unmatched alpine luxury in Solang Nallah, Manali. Features heated indoor pools, fine dining, bonfire evenings, and private balconies overlooking the Beas river valley.',
                'is_featured' => true,
                'is_active' => true,
            ]);
        }

        if ($goa) {
            Hotel::updateOrCreate(['slug' => 'taj-exotica-resort-spa-goa'], [
                'name' => 'Taj Exotica Beach Resort & Spa',
                'destination_id' => $goa->id,
                'category' => 'Luxury Resort',
                'city' => 'Benaulim, South Goa',
                'price_per_night' => 14500.00,
                'cover_image' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80',
                'amenities' => 'Private Beach Access, Infinity Pool, Water Sports, Spa, Golf Course, Seafood Grill',
                'short_description' => 'Mediterranean-style luxury beach resort spread across 56 acres of lush gardens along the Arabian Sea.',
                'description' => 'Indulge in private villas with personal plunge pools, authentic Goan seafood dining, and direct access to pristine white sand beaches.',
                'is_featured' => true,
                'is_active' => true,
            ]);
        }

        // 2. Transportation Fleet (Sedan Cars, Ertiga, Innova Crysta, Tempo Traveler, Urbania, Coach Bus)
        $vehicles = [
            [
                'slug' => 'sedan-cars-swift-dzire-etios',
                'vehicle_name' => 'Sedan Cars (Swift Dzire / Etios AC)',
                'vehicle_type' => 'Sedan',
                'capacity' => 4,
                'price_per_day' => 2800.00,
                'price_per_km' => 14.00,
                'cover_image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=1200&q=80',
                'features' => 'Full AC, 4 Passengers, Boot Luggage Space, Music System, Experienced Chauffeur',
                'description' => 'Comfortable 4-seater AC Sedan ideal for city transfers, outstation sightseeing, and airport drops.',
                'is_active' => true,
            ],
            [
                'slug' => 'maruti-suzuki-ertiga-ac-muv',
                'vehicle_name' => 'Maruti Suzuki Ertiga (AC MUV)',
                'vehicle_type' => 'MUV',
                'capacity' => 6,
                'price_per_day' => 3600.00,
                'price_per_km' => 16.00,
                'cover_image' => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=1200&q=80',
                'features' => 'Dual AC, 6 Seats, Rear AC Vents, Bluetooth Audio, Roof Luggage Carrier',
                'description' => 'Spacious and economic 6-seater family MUV for mountain tours and highway travel.',
                'is_active' => true,
            ],
            [
                'slug' => 'toyota-innova-crysta-suv',
                'vehicle_name' => 'Toyota Innova Crysta (Luxury AC SUV)',
                'vehicle_type' => 'SUV',
                'capacity' => 7,
                'price_per_day' => 4800.00,
                'price_per_km' => 18.00,
                'cover_image' => 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=1200&q=80',
                'features' => 'Dual AC, Captain Reclining Seats, GPS Navigation, Roof Carrier, Premium Audio',
                'description' => 'Top-tier luxury 7-seater SUV for mountain expeditions, long journeys, and VIP transfers.',
                'is_active' => true,
            ],
            [
                'slug' => 'force-tempo-traveler-deluxe',
                'vehicle_name' => 'Force Tempo Traveler (12/17-Seater Deluxe)',
                'vehicle_type' => 'Tempo Traveler',
                'capacity' => 17,
                'price_per_day' => 7500.00,
                'price_per_km' => 26.00,
                'cover_image' => 'https://images.unsplash.com/photo-1570125909232-eb263c188f7e?auto=format&fit=crop&w=1200&q=80',
                'features' => 'Pushback Reclining Seats, High-power AC, LED TV, Sound System, Ample Luggage Boot',
                'description' => 'Spacious 17-seater executive coach for group tours, wedding trips, and corporate travel.',
                'is_active' => true,
            ],
            [
                'slug' => 'force-urbania-luxury-van',
                'vehicle_name' => 'Force Urbania Luxury Van (13/17-Seater)',
                'vehicle_type' => 'Luxury Van',
                'capacity' => 17,
                'price_per_day' => 9500.00,
                'price_per_km' => 32.00,
                'cover_image' => 'https://images.unsplash.com/photo-1570125909232-eb263c188f7e?auto=format&fit=crop&w=1200&q=80',
                'features' => 'Ultra-luxury Reclining Bucket Seats, Individual AC Vents, USB Charging Ports, Panoramic Windows, Air Suspension',
                'description' => 'Next-generation ultra-luxury 17-seater van offering unmatched ride comfort, ambient lighting, and panoramic views.',
                'is_active' => true,
            ],
            [
                'slug' => 'luxury-coach-bus-26-45-seater',
                'vehicle_name' => 'Luxury Coach Bus (26/45-Seater Volvo/BharatBenz)',
                'vehicle_type' => 'Coach Bus',
                'capacity' => 45,
                'price_per_day' => 16500.00,
                'price_per_km' => 48.00,
                'cover_image' => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=1200&q=80',
                'features' => 'Air Suspension, Reclining Seats, High-Capacity AC, LED Entertainment, Under-floor Luggage Bay',
                'description' => 'High-capacity 26 to 45-seater luxury AC coach for large group tours, school excursions, and corporate events.',
                'is_active' => true,
            ],
        ];

        foreach ($vehicles as $vData) {
            Transportation::updateOrCreate(['slug' => $vData['slug']], $vData);
        }

        // 3. Bike Rentals
        BikeRental::updateOrCreate(['slug' => 'royal-enfield-himalayan-411'], [
            'model_name' => 'Royal Enfield Himalayan 411cc',
            'bike_type' => 'Adventure',
            'engine_capacity' => '411cc',
            'daily_rate' => 1800.00,
            'deposit_amount' => 3000.00,
            'cover_image' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&w=1200&q=80',
            'location' => 'Manali / Leh',
            'is_available' => true,
            'is_active' => true,
        ]);

        BikeRental::updateOrCreate(['slug' => 'royal-enfield-classic-350-stealth'], [
            'model_name' => 'Royal Enfield Classic 350 Stealth Black',
            'bike_type' => 'Royal Enfield',
            'engine_capacity' => '349cc',
            'daily_rate' => 1400.00,
            'deposit_amount' => 2500.00,
            'cover_image' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?auto=format&fit=crop&w=1200&q=80',
            'location' => 'Goa / Manali',
            'is_available' => true,
            'is_active' => true,
        ]);

        BikeRental::updateOrCreate(['slug' => 'honda-activa-6g-scooter'], [
            'model_name' => 'Honda Activa 6G Automatic Scooter',
            'bike_type' => 'Scooter',
            'engine_capacity' => '110cc',
            'daily_rate' => 500.00,
            'deposit_amount' => 1000.00,
            'cover_image' => 'https://images.unsplash.com/photo-1591637333184-19aa84b3e01f?auto=format&fit=crop&w=1200&q=80',
            'location' => 'Goa / Delhi',
            'is_available' => true,
            'is_active' => true,
        ]);
    }
}
