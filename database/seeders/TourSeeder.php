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
            ],
            [
                'title' => '3 Nights and 4 Days Shillong',
                'cover_image' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=1200&q=80',
                'short_description' => '03 N / 04 D Shillong tour covering Guwahati, Umiam Lake, Cherrapunjee Nohkalikai Falls, Mawlynnong Asia\'s Cleanest Village, and Dawki Umngot River.',
                'full_description' => 'Explore the Scotland of the East with our 3 Nights / 4 Days Shillong Tour Package. Visit scenic Umiam Lake, the wettest place Cherrapunjee with magnificent Nohkalikai Falls, Asia\'s Cleanest Village Mawlynnong, and crystal-clear Umngot River at Dawki.',
                'destination_id' => $meghalaya?->id,
                'category_id' => $catFamily?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 4,
                'duration_nights' => 3,
                'starting_price' => 15999.00,
                'discounted_price' => 12999.00,
                'max_travelers' => 10,
                'inclusions_text' => "3-Star/4-Star Hotel Stay in Shillong\nDaily Breakfast & Dinner\nPrivate Cab for All Transfers & Sightseeing\nDawki River Boating Pass\nAll Entry Fees, Permits & Parking",
                'exclusions_text' => "Flight / Train tickets\nPersonal expenses & tips\nAdventure activity charges\nGST 5%",
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Shillong (Arrived in Guwahati, to Shillong, Umium Lake, Police bazar)',
                        'description' => 'Welcome to Awesome Assam. Upon reaching Guwahati Airport or Railway Station, you will be transferred to Shillong, which is often referred to as the "Scotland of the East." The distance between Guwahati and Shillong is approximately 100 kilometers, and the journey takes around 3 hours. On the way, you will have the opportunity to visit Umiam Lake, a beautiful and serene lake surrounded by picturesque hills. Check in to your hotel and Overnight stay at Shillong.',
                        'morning_activity' => 'Arrival in Guwahati & Pickup',
                        'afternoon_activity' => 'Visit Umiam Lake (Barapani)',
                        'evening_activity' => 'Police Bazar Shopping & Leisure Walk',
                        'meals' => 'Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 2,
                        'title' => 'Shillong – Cherrapunji – Shillong (65 KM | 1.5 Hrs Per Way)',
                        'description' => 'After having breakfast early in the morning, you will proceed towards Cherrapunjee, which holds the title of being the wettest place on Earth. During the visit, you will have the opportunity to witness the magnificent Nohkalikai waterfall. Visit Eco Park, Nohkalikai Falls, Nohsngithiang Falls (Seven Sisters Falls), Mawsmai Cave, Thangkharang Park. Evening return to Shillong. Visit Elephanta Falls. Overnight stay in Shillong.',
                        'morning_activity' => 'Drive to Cherrapunjee & Nohkalikai Falls',
                        'afternoon_activity' => 'Seven Sisters Falls & Mawsmai Cave',
                        'evening_activity' => 'Elephanta Falls & Return to Shillong',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 3,
                        'title' => 'Shillong – Dawki – Mawlynnong Village – Shillong (90 KM | 2 Hrs Per Way)',
                        'description' => 'After having breakfast early in the morning, you will embark on a drive to Mawlynnong, which is famously known as "Asia\'s Cleanest Village." Mawlynnong boasts various fascinating attractions, including the living root bridge and a peculiar natural phenomenon of a boulder delicately balanced on another small rock. Afterwards, you will proceed to Dawki, a small town situated near the India-Bangladesh border. Here, you can enjoy the awe-inspiring view of the Umangot River. In the evening, you will drive back to Shillong and spend the night at your hotel.',
                        'morning_activity' => 'Mawlynnong Village & Living Root Bridge',
                        'afternoon_activity' => 'Dawki Umngot River Boating & Border Visit',
                        'evening_activity' => 'Return to Shillong & Hotel Stay',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 4,
                        'title' => 'Shillong – Guwahati Departure (100 KM | 3 Hrs)',
                        'description' => 'After breakfast, drive back to Guwahati. Overnight stay at Guwahati or transfer to airport or railway station.',
                        'morning_activity' => 'Breakfast & Check-out from Hotel',
                        'afternoon_activity' => 'Drive back to Guwahati',
                        'evening_activity' => 'Transfer to Airport / Railway Station',
                        'meals' => 'Breakfast',
                        'hotel' => 'N/A (Departure)',
                        'transportation' => 'Private Cab / SUV'
                    ]
                ]
            ],
            [
                'title' => '4 Nights 5 Days: Shillong (3N) – Guwahati (1N)',
                'cover_image' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80',
                'short_description' => '04 N / 05 D Shillong 3N & Guwahati 1N tour covering Umiam Lake, Cherrapunjee, Mawlynnong, Dawki, Ward’s Lake, Brahmaputra River Cruise & Kamakhya Temple.',
                'full_description' => 'Experience the best of Meghalaya and Assam with our 4 Nights / 5 Days Shillong and Guwahati Tour Package. Discover Scotland of the East Shillong, Nohkalikai Falls in Cherrapunjee, Asia’s Cleanest Village Mawlynnong, Dawki Umngot River, Brahmaputra River Cruise, and Kamakhya Temple in Guwahati.',
                'destination_id' => $meghalaya?->id,
                'category_id' => $catFamily?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 5,
                'duration_nights' => 4,
                'starting_price' => 19999.00,
                'discounted_price' => 16999.00,
                'max_travelers' => 12,
                'inclusions_text' => "3 Nights Hotel Stay in Shillong & 1 Night Hotel Stay in Guwahati\nDaily Breakfast & Dinner\nPrivate Cab for All Transfers & Sightseeing\nDawki River Boating Pass\nAll Entry Fees, Tolls & Parking",
                'exclusions_text' => "Flight / Train tickets\nBrahmaputra River Cruise tickets\nPersonal expenses & tips\nGST 5%",
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Shillong (Arrived in Guwahati, to Shillong, Umium Lake, Police bazar)',
                        'description' => 'Welcome to Awesome Assam. Upon reaching Guwahati Airport or Railway Station, you will be transported to Shillong, which is often referred to as the "Scotland of the East" due to its resemblance to the scenic beauty of Scotland. The distance between Guwahati and Shillong is approximately 100 kilometers, and the journey takes around 3 hours. On the way, you will have the opportunity to visit Umiam Lake, a magnificent and peaceful lake surrounded by lush green hills. Upon arrival in Shillong, you will check in to your hotel and spend the night there.',
                        'morning_activity' => 'Arrival in Guwahati & Pickup',
                        'afternoon_activity' => 'Visit Umiam Lake (Barapani)',
                        'evening_activity' => 'Police Bazar Leisure Walk & Shopping',
                        'meals' => 'Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 2,
                        'title' => 'Shillong – Cherrapunji – Shillong (65 KM | 1.5 Hrs Per Way)',
                        'description' => 'Following an early morning meal, you will proceed on a drive to Cherrapunjee, known as the wettest place on Earth, situated at an altitude of 4,400 feet. There, you will have the opportunity to witness the captivating Nohkalikai waterfall. Visit Eco Park, Nohkalikai Falls, Nohsngithiang Falls (Seven Sisters Falls), Mawsmai Cave, Thangkharang Park. Evening return to Shillong. Visit Elephanta Falls. Overnight stay in Shillong.',
                        'morning_activity' => 'Drive to Cherrapunjee & Nohkalikai Falls',
                        'afternoon_activity' => 'Seven Sisters Falls & Mawsmai Cave',
                        'evening_activity' => 'Elephanta Falls Visit & Return to Shillong',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 3,
                        'title' => 'Shillong – Dawki – Mawlynnong Village – Shillong (90 KM | 2 Hrs Per Way)',
                        'description' => 'After enjoying an early breakfast, you will embark on a journey to Mawlynnong, known as "Asia\'s Cleanest Village." Mawlynnong is renowned for its remarkable attractions, including the living root bridge and an intriguing natural phenomenon where a boulder precariously balances on a small rock. Afterward, you will continue your trip to Dawki, a small town located near the India-Bangladesh border. Here, you can revel in the breathtaking view of the Umangot River. In the evening, you will drive back to Shillong and spend the night at your hotel.',
                        'morning_activity' => 'Mawlynnong Village & Living Root Bridge',
                        'afternoon_activity' => 'Dawki Umngot River Boating & Border Visit',
                        'evening_activity' => 'Return to Shillong & Hotel Stay',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 4,
                        'title' => 'Shillong – Guwahati (100 kms / 3 hrs.)',
                        'description' => 'After breakfast visit Don Bosco Museum & Ward’s Lake. Proceed to Guwahati. In the evening you may take a River Cruise (Direct Payment) on the mighty River Brahmaputra. You may also visit the local market. Assam is famous for Assam Silk particularly Golden Muga Silk, Assam Tea, Bamboo and Cane Products. Overnight stay in Guwahati.',
                        'morning_activity' => 'Don Bosco Museum & Ward’s Lake Visit',
                        'afternoon_activity' => 'Drive to Guwahati & Hotel Check-in',
                        'evening_activity' => 'Brahmaputra River Cruise & Silk Market Shopping',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel in Guwahati',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 5,
                        'title' => 'Guwahati Departure',
                        'description' => 'After having breakfast and checking out from the hotel, if time permits, we may opt for a tour of the Kamakhya Temple with cherished memories of our trip, we will then transfer you to Guwahati airport or railway station for your onward journey.',
                        'morning_activity' => 'Breakfast & Kamakhya Temple Pilgrimage',
                        'afternoon_activity' => 'Check-out & Transfer to Airport / Railway Station',
                        'evening_activity' => 'Departure Onward Journey',
                        'meals' => 'Breakfast',
                        'hotel' => 'N/A (Departure)',
                        'transportation' => 'Private Cab / SUV'
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
