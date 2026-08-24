<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\TourCategory;
use App\Models\TourItinerary;
use App\Models\TourPackage;
use App\Models\TourType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Categories
        $categories = [
            ['name' => 'Honeymoon Special', 'slug' => 'honeymoon-special', 'description' => 'Romantic luxury getaways for couples.'],
            ['name' => 'Family Holiday', 'slug' => 'family-holiday', 'description' => 'Fun-filled family vacation packages.'],
            ['name' => 'Adventure Trekking', 'slug' => 'adventure-trekking', 'description' => 'Thrilling mountain expeditions and water sports.'],
            ['name' => 'Luxury Escape', 'slug' => 'luxury-escape', 'description' => '5-Star accommodations, private transfers, and concierge.'],
        ];

        foreach ($categories as $cat) {
            TourCategory::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 2. Tour Types
        $types = [
            ['name' => 'Domestic', 'slug' => 'domestic'],
            ['name' => 'International', 'slug' => 'international'],
            ['name' => 'Adventure', 'slug' => 'adventure'],
            ['name' => 'Luxury', 'slug' => 'luxury'],
        ];

        foreach ($types as $type) {
            TourType::firstOrCreate(['slug' => $type['slug']], $type);
        }

        $manali = Destination::where('slug', 'manali-solang-valley')->first();
        $meghalaya = Destination::where('slug', 'meghalaya-abode-of-clouds')->first();
        $assam = Destination::where('slug', 'assam-kaziranga-brahmaputra')->first();
        $arunachal = Destination::where('slug', 'arunachal-pradesh-tawang-monastery')->first();
        $sikkim = Destination::where('slug', 'sikkim-gangtok-nathula-pass')->first();
        $nagaland = Destination::where('slug', 'nagaland-hornbill-cultural-valley')->first();

        $catHoneymoon = TourCategory::where('slug', 'honeymoon-special')->first();
        $catFamily = TourCategory::where('slug', 'family-holiday')->first();
        $catAdventure = TourCategory::where('slug', 'adventure-trekking')->first();
        $catLuxury = TourCategory::where('slug', 'luxury-escape')->first();

        $typeDomestic = TourType::where('slug', 'domestic')->first();

        $packages = [
            [
                'title' => '5-Day Manali & Solang Romantic Escape',
                'cover_image' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Experience snow peaks, Solang adventure, private Volvo transfers, candle-light dinner, and luxury resort stay in Manali.',
                'full_description' => 'Immerse yourself in the picturesque snow-capped mountains of Himachal Pradesh. Enjoy Solang valley ropeway, paragliding, Hadimba temple visits, and romantic candle-light dinners.',
                'destination_id' => $manali?->id,
                'category_id' => $catHoneymoon?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 5,
                'duration_nights' => 4,
                'starting_price' => 18999.00,
                'discounted_price' => 14999.00,
                'max_travelers' => 12,
                'inclusions_text' => '4-Star Hotel Stay, Daily Breakfast & Dinner, Private AC Cab for Local Sightseeing, Candle Light Dinner & Cake, Solang Valley Excursion Pass',
                'exclusions_text' => 'Flight / Train tickets, Adventure activity charges (Paragliding/Ropeway), Personal expenses, GST 5%',
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Arrival in Manali & Hotel Check-in',
                        'description' => 'Pickup from Volvo bus stand and drop at hotel. Afternoon visit to Hadimba Temple, Vashisht Hot Water Springs, and Mall Road evening walk.',
                        'morning_activity' => 'Arrival & Resort Check-in',
                        'afternoon_activity' => 'Hadimba Temple & Vashisht Springs',
                        'evening_activity' => 'Stroll at Mall Road & Shopping',
                        'meals' => 'Dinner',
                        'hotel' => 'Snow Valley Resorts Manali',
                        'transportation' => 'Private Sedan Cab'
                    ]
                ]
            ],
            [
                'title' => '6-Day Meghalaya Living Root Bridges & Dawki Crystal Expedition',
                'cover_image' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Explore Cherrapunji Nohkalikai waterfalls, double-decker living root bridges, Dawki crystal river boating, and Asia’s cleanest village Mawlynnong.',
                'full_description' => 'Journey into the Abode of Clouds! Discover the world famous double decker living root bridges in Tyrna, boat on the glass-transparent waters of the Umngot River in Dawki, and explore Shillong Peak.',
                'destination_id' => $meghalaya?->id,
                'category_id' => $catAdventure?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 6,
                'duration_nights' => 5,
                'starting_price' => 24999.00,
                'discounted_price' => 20999.00,
                'max_travelers' => 10,
                'inclusions_text' => 'Boutique Resort & Homestay Stay, Daily Breakfast & Dinner, Private SUV Transfer (Innova/XYLO), Dawki River Boating Charge, Entry Permits & Guide',
                'exclusions_text' => 'Airfare to Guwahati, Personal expenses, GST 5%',
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Guwahati to Shillong Scenic Hill Drive',
                        'description' => 'Pickup from Guwahati airport and drive to Shillong. Stop at Umiam Lake (Barapani) for watersports and photography.',
                        'morning_activity' => 'Pickup & Drive via Umiam Lake',
                        'afternoon_activity' => 'Shillong Golf Course & Cathedral',
                        'evening_activity' => 'Police Bazar Shopping',
                        'meals' => 'Dinner',
                        'hotel' => 'Ri Kynjai Resort / Polo Towers Shillong',
                        'transportation' => 'Private Innova Crysta'
                    ]
                ]
            ],
            [
                'title' => '6-Day Assam Kaziranga Rhino Safari & Majuli Cultural Tour',
                'cover_image' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'One-horned rhino jeep & elephant safaris at Kaziranga National Park, Brahmaputra ferry to Majuli island, and tea garden walk.',

                'full_description' => 'Embark on an authentic Assamese wilderness safari. Spot the great one-horned rhino in Kaziranga, cross the mighty Brahmaputra river to Majuli (the world’s largest river island), and visit Kamakhya Temple.',
                'destination_id' => $assam?->id,
                'category_id' => $catFamily?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 6,
                'duration_nights' => 5,
                'starting_price' => 22999.00,
                'discounted_price' => 19499.00,
                'max_travelers' => 12,
                'inclusions_text' => '3-Star Wildlife Resort Stay, Jeep & Elephant Safari Pass, Brahmaputra Ferry Ticket, Daily Meals, Private AC Transport',
                'exclusions_text' => 'Camera permits, Airfare, GST 5%',
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Guwahati to Kaziranga Wildlife Park',
                        'description' => 'Arrival in Guwahati, visit Kamakhya Temple, and drive to Kaziranga National Park.',
                        'morning_activity' => 'Guwahati Pickup & Kamakhya Temple',
                        'afternoon_activity' => 'Drive to Kaziranga',
                        'evening_activity' => 'Assamese Bihu Cultural Dance Show',
                        'meals' => 'Dinner',
                        'hotel' => 'Iora The Retreat Kaziranga',
                        'transportation' => 'Private AC Vehicle'
                    ]
                ]
            ],
            [
                'title' => '6-Day Arunachal Tawang Monastery & Sela Pass Alpine Expedition',
                'cover_image' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Cross Sela Pass at 13,700 feet, visit Asia’s 2nd largest Tawang Monastery, Madhuri Lake, and Bomdila valleys.',
                'full_description' => 'A high-altitude Himalayan mountain adventure across Arunachal Pradesh. Experience Sela Pass frozen lake views, Tawang Monastery prayer halls, Jaswant Garh war memorial, and Sangti Valley.',
                'destination_id' => $arunachal?->id,
                'category_id' => $catAdventure?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 6,
                'duration_nights' => 5,
                'starting_price' => 28999.00,
                'discounted_price' => 24999.00,
                'max_travelers' => 8,
                'inclusions_text' => 'High-altitude Resort & Hotel Stay, Daily Meals, 4x4 Sumo/Innova Transport, Inner Line Permit (ILP), Tawang Local Sightseeing',
                'exclusions_text' => 'Flight tickets, Bumla Pass local taxi charge, GST 5%',
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Guwahati to Dirang Valley',
                        'description' => 'Scenic drive through Bhalukpong checkpost into Dirang Valley. Visit Dirang Dzong and apple orchards.',
                        'morning_activity' => 'Pickup & Drive to Dirang',
                        'afternoon_activity' => 'Dirang Monastery & Hot Spring',
                        'evening_activity' => 'Dirang Valley stroll',
                        'meals' => 'Dinner',
                        'hotel' => 'Hotel Norphel Retreat Dirang',
                        'transportation' => '4x4 SUV'
                    ]
                ]
            ],
            [
                'title' => '6-Day Sikkim & Darjeeling Himalayan Magic Tour',
                'cover_image' => 'https://images.unsplash.com/photo-1581793745862-99fde7fa73d2?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Sunrise over Mt. Kanchenjunga from Tiger Hill, UNESCO Toy Train ride, high-altitude Tsomgo Lake, and Nathula Pass.',
                'full_description' => 'Combine the royal hill charm of Darjeeling with the pristine alpine beauty of Gangtok Sikkim. Experience early morning sunrises over Kanchenjunga, tea garden walks, Tsomgo Lake at 12,400 ft, and Rumtek Monastery.',
                'destination_id' => $sikkim?->id,
                'category_id' => $catLuxury?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 6,
                'duration_nights' => 5,
                'starting_price' => 26999.00,
                'discounted_price' => 22499.00,
                'max_travelers' => 10,
                'inclusions_text' => '4-Star Hotel Stay in Gangtok & Darjeeling, Daily Breakfast & Dinner, Private Cab Transfers, Tsomgo Lake Permit Pass, Toy Train Joyride Ticket',
                'exclusions_text' => 'Airfare / Train ticket, Nathula Pass permit fee, GST 5%',
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Bagdogra to Gangtok Transfer',
                        'description' => 'Pickup from Bagdogra airport / NJP railway station and scenic drive along Teesta River to Gangtok.',
                        'morning_activity' => 'Pickup & Teesta River Drive',
                        'afternoon_activity' => 'Hotel Check-in',
                        'evening_activity' => 'Gangtok MG Marg Promenade Walk',
                        'meals' => 'Dinner',
                        'hotel' => 'The Elgin Nor-Khill Gangtok',
                        'transportation' => 'Private SUV'
                    ]
                ]
            ],
            [
                'title' => '5-Day Nagaland Hornbill Cultural Heritage & Dzukou Valley Trek',
                'cover_image' => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?auto=format&fit=crop&w=1200&q=80',
                'short_description' => 'Immerse in Nagaland Hornbill Festival celebrations, Kohima War Memorial, Khonoma Green Village, and Dzukou Valley trek.',
                'full_description' => 'Experience the rich tribal culture of Nagaland. Witness traditional dances, sports, and crafts at Kisama Heritage Village during the Hornbill Festival, and trek into the pristine emerald green Dzukou Valley.',
                'destination_id' => $nagaland?->id,
                'category_id' => $catAdventure?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 5,
                'duration_nights' => 4,
                'starting_price' => 21999.00,
                'discounted_price' => 18499.00,
                'max_travelers' => 12,
                'inclusions_text' => 'Heritage Resort & Homestay Stay, Daily Meals, Private SUV Transport, Hornbill Festival Entry Pass, Naga ILP Permit',
                'exclusions_text' => 'Airfare to Dimapur, Personal expenses, GST 5%',
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Dimapur to Kohima Drive',
                        'description' => 'Pickup from Dimapur and scenic drive up the Naga hills to Kohima.',
                        'morning_activity' => 'Pickup from Dimapur',
                        'afternoon_activity' => 'Kohima War Cemetery',
                        'evening_activity' => 'Naga Night Market Stroll',
                        'meals' => 'Dinner',
                        'hotel' => 'Hotel Polo Towers Kohima',
                        'transportation' => 'Private SUV'
                    ]
                ]
            ]
        ];

        foreach ($packages as $pkgData) {
            $itineraries = $pkgData['itineraries'];
            unset($pkgData['itineraries']);

            $pkgData['slug'] = Str::slug($pkgData['title']);
            $tour = TourPackage::updateOrCreate(['slug' => $pkgData['slug']], $pkgData);

            foreach ($itineraries as $it) {
                $it['tour_package_id'] = $tour->id;
                TourItinerary::firstOrCreate([
                    'tour_package_id' => $tour->id,
                    'day_number' => $it['day_number']
                ], $it);
            }
        }
    }
}
