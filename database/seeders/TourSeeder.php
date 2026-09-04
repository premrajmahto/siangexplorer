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
            ],
            [
                'title' => '5 Nights 6 Days - Shillong (3N) Cherrapunji (2N)',
                'cover_image' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=1200&q=80',
                'short_description' => '05 N / 06 D Shillong 3N & Cherrapunji 2N tour covering Umiam Lake, Laitlum Canyons, Krang Suri Waterfalls, Mawsynram, Mawphlang Sacred Forest, Dawki, Mawlynnong, Nohkalikai Falls & Kamakhya Temple.',
                'full_description' => 'Immerse yourself in the breathtaking landscapes of Meghalaya with our 5 Nights / 6 Days Shillong and Cherrapunji package. Experience Laitlum Canyons, natural pools at Krang Suri Falls, Mawsynram (highest rainfall in the world), Mawphlang Sacred Forest, Asia’s cleanest village Mawlynnong, Dawki Umngot River, Cherrapunji Nohkalikai Falls, optional Double Decker Root Bridge trek, and Kamakhya Temple in Guwahati.',
                'destination_id' => $meghalaya?->id,
                'category_id' => $catAdventure?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 6,
                'duration_nights' => 5,
                'starting_price' => 24999.00,
                'discounted_price' => 21999.00,
                'max_travelers' => 12,
                'inclusions_text' => "3 Nights Hotel Stay in Shillong & 2 Nights Hotel Stay in Cherrapunji\nDaily Breakfast & Dinner\nPrivate SUV / Sedan for Transfers & Sightseeing\nDawki Umngot River Boating Pass\nAll Entry Fees, Tolls & Parking Charges",
                'exclusions_text' => "Flight / Train tickets\nGuide charges for Double Decker Root Bridge Trek\nPersonal expenses & tips\nGST 5%",
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Guwahati - Shillong (98 KMS / 3 HRS)',
                        'description' => 'Arrival at Guwahati Airport/Station and drive to Shillong. En route witness the Umiam Lake or Barapani - is the biggest artificial lake in Meghalaya in the midst of sylvan hills adorned by Khasi pines & peerless beauty. Check-in Hotel and after refreshment if time permits visit Cathedral of Mary and Ward’s Lake. Evening free at leisure to explore the region on my own. You may take a walk to the famous Police Bazaar for shopping. Overnight in Shillong.',
                        'morning_activity' => 'Guwahati Arrival & Drive to Shillong',
                        'afternoon_activity' => 'Umiam Lake (Barapani) & Ward’s Lake',
                        'evening_activity' => 'Police Bazar Shopping & Leisure Stroll',
                        'meals' => 'Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 2,
                        'title' => 'Shillong – Laitlum Canyons - Krang Suri Falls – Shillong (90 KM | 2 Hrs Per Way)',
                        'description' => 'Following breakfast, we will make our way to Laitlum Canyons, where you can experience awe-inspiring views. Later, we will visit Krang Suri Falls, which is regarded as one of the finest waterfalls in Meghalaya. Here, you will have the opportunity to swim in a natural pool and witness the waterfall from behind, as the water cascades in front of you. After enjoying lunch, we will return to Shillong. During the remainder of the day, we will visit various attractions including the Don Bosco Centre for Indigenous Cultures, Ward\'s Lake (where boating can be enjoyed), the Cathedral Catholic Church, and Lady Hydari Park. We will spend the night in Shillong.',
                        'morning_activity' => 'Excursion to Laitlum Canyons',
                        'afternoon_activity' => 'Krang Suri Falls Natural Pool Swimming',
                        'evening_activity' => 'Don Bosco Centre & Lady Hydari Park',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 3,
                        'title' => 'Shillong – Mawsynram – Mawphlang Sacred Forest – Shillong (60 KM | 1.5 Hrs Per Way)',
                        'description' => 'After having breakfast, we will head towards Mawsynram, which has recently been identified as the place receiving the highest rainfall in the world according to geological reports. The region is renowned for its numerous caves. Following that, we will visit Mawphlang Sacred Grove, one of the largest sacred groves in Meghalaya. It is a well-preserved forest protected by the local community and governed by the local deities, prohibiting anything from being taken out of the forest. We will also visit a Khasi model village. In the evening, we will return to Shillong and visit Elephanta Falls. We will spend the night in Shillong.',
                        'morning_activity' => 'Drive to Mawsynram (Wettest Place on Earth)',
                        'afternoon_activity' => 'Mawphlang Sacred Grove & Khasi Model Village',
                        'evening_activity' => 'Elephanta Falls Visit & Return to Shillong',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 4,
                        'title' => 'Shillong – Dawki – Mawlynnong Village – Cherrapunji (90 KM | 2 Hrs Per Way)',
                        'description' => 'After enjoying breakfast, we will visit Mawlynnong Village, which is recognized as the cleanest village in India. This charming and vibrant village is renowned for its exceptional cleanliness. It is located approximately 90 kilometers from Shillong and offers various fascinating attractions, including the Living Root Bridge and the peculiar natural phenomenon of a boulder balancing on another rock. Following that, we will proceed to Dawki, a place situated along the Indo-Bangladesh border. Here, you will have the opportunity to indulge in boating in the crystal clear waters of the Umgnot River. In the evening, we will continue our journey to Cherrapunji. We will spend the night in Cherrapunji.',
                        'morning_activity' => 'Mawlynnong Cleanest Village & Living Root Bridge',
                        'afternoon_activity' => 'Dawki Umngot River Boating',
                        'evening_activity' => 'Drive to Cherrapunji & Hotel Check-in',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Resort in Cherrapunji',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 5,
                        'title' => 'Cherrapunji Local Sightseeing & Optional Double Decker Root Bridge Trek',
                        'description' => 'Rise early today to fully immerse yourself in the captivating mornings of Cherrapunji. Explore various attractions including Eco Park, Nohkalikai Falls, Nohsngithiang Falls (Seven Sisters Falls), Mawsmai Cave, and Thangkharang Park. After a day filled with exploration, spend the night in Cherrapunji. Optional – You have the option to embark on a full day trek to the Double Decker Living Root Bridge at Nongriat Village. The trek involves descending approximately 3,200 steps each way to reach the Double Decker Living Root Bridge. For those seeking further adventure, you can continue trekking to the Rainbow Falls, which takes about 60 to 90 minutes from the Double Decker Living Root Bridge. Overnight stay in Cherrapunji.',
                        'morning_activity' => 'Nohkalikai Falls & Seven Sisters Waterfalls',
                        'afternoon_activity' => 'Mawsmai Cave & Eco Park (or Nongriat Double Decker Trek)',
                        'evening_activity' => 'Thangkharang Park Sunset & Cherrapunji Stay',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Resort in Cherrapunji',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 6,
                        'title' => 'Cherrapunji to Guwahati (160 KM | 4.5 HRS)',
                        'description' => 'Following breakfast, we will make our way to Guwahati. Enroute, we will visit the renowned Kamakhya Temple, known for its religious significance. Cherishing the unforgettable memories of our journey, we will then transfer you to the airport or railway station for your onward travel arrangements.',
                        'morning_activity' => 'Breakfast & Drive from Cherrapunji to Guwahati',
                        'afternoon_activity' => 'Kamakhya Temple Pilgrimage Visit',
                        'evening_activity' => 'Transfer to Guwahati Airport / Railway Station',
                        'meals' => 'Breakfast',
                        'hotel' => 'N/A (Departure)',
                        'transportation' => 'Private Cab / SUV'
                    ]
                ]
            ],
            [
                'title' => '6 Nights 7 Days ( Shillong 3 , Cherrapunji 2 , Guwahati 1 )',
                'cover_image' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=1200&q=80',
                'short_description' => '06 N / 07 D Shillong 3N, Cherrapunji 2N & Guwahati 1N grand tour covering Laitlum Canyons, Krang Suri Waterfalls, Mawsynram, Dawki, Mawlynnong, Nohkalikai Falls, Brahmaputra River Cruise & Kamakhya Temple.',
                'full_description' => 'The ultimate 6 Nights / 7 Days Meghalaya and Assam Grand Circuit. Explore Shillong, Laitlum Canyons, natural pools at Krang Suri Falls, Mawsynram, Mawphlang Sacred Forest, Asia’s cleanest village Mawlynnong, Dawki Umngot River, Cherrapunji Nohkalikai Falls, optional Nongriat Double Decker Root Bridge trek, Brahmaputra River Cruise in Guwahati, and Kamakhya Temple.',
                'destination_id' => $meghalaya?->id,
                'category_id' => $catFamily?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 7,
                'duration_nights' => 6,
                'starting_price' => 28999.00,
                'discounted_price' => 24999.00,
                'max_travelers' => 12,
                'inclusions_text' => "3 Nights Hotel Stay in Shillong, 2 Nights in Cherrapunji & 1 Night in Guwahati\nDaily Breakfast & Dinner\nPrivate SUV / Sedan for Transfers & Sightseeing\nDawki Umngot River Boating Pass\nAll Entry Fees, Permits & Parking Charges",
                'exclusions_text' => "Flight / Train tickets\nBrahmaputra River Cruise tickets\nGuide charges for Double Decker Root Bridge Trek\nPersonal expenses & tips\nGST 5%",
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Guwahati arrival and transfers to Shillong (98 KMS/3 HRS)',
                        'description' => 'Arrival at Guwahati Airport/Station and drive to Shillong. En route witness the Umiam Lake or Barapani - is the biggest artificial lake in Meghalaya in the midst of sylvan hills adorned by Khasi pines & peerless beauty. Check-in Hotel and after refreshment if time permits visit Cathedral of Mary and Ward’s Lake. Evening free at leisure to explore the region on my own. You may take a walk to the famous Police Bazaar for shopping. Overnight in Shillong.',
                        'morning_activity' => 'Guwahati Arrival & Drive to Shillong',
                        'afternoon_activity' => 'Umiam Lake (Barapani) & Ward’s Lake',
                        'evening_activity' => 'Police Bazar Shopping & Leisure Walk',
                        'meals' => 'Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 2,
                        'title' => 'Shillong – Laitlum Canyons - Krang Suri Falls – Shillong (90 KM | 2 Hrs Per Way)',
                        'description' => 'Following breakfast, we will make our way to Laitlum Canyons, where you can experience awe-inspiring views. Later, we will visit Krang Suri Falls, which is regarded as one of the finest waterfalls in Meghalaya. Here, you will have the opportunity to swim in a natural pool and witness the waterfall from behind, as the water cascades in front of you. After enjoying lunch, we will return to Shillong. During the remainder of the day, we will visit various attractions including the Don Bosco Centre for Indigenous Cultures, Ward\'s Lake (where boating can be enjoyed), the Cathedral Catholic Church, and Lady Hydari Park. We will spend the night in Shillong.',
                        'morning_activity' => 'Excursion to Laitlum Canyons',
                        'afternoon_activity' => 'Krang Suri Falls Natural Pool Swimming',
                        'evening_activity' => 'Don Bosco Centre & Lady Hydari Park',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 3,
                        'title' => 'Shillong – Mawsynram – Mawphlang Sacred Forest – Shillong (60 KM | 1.5 Hrs Per Way)',
                        'description' => 'After having breakfast, we will head towards Mawsynram, which has recently been identified as the place receiving the highest rainfall in the world according to geological reports. The region is renowned for its numerous caves. Following that, we will visit Mawphlang Sacred Grove, one of the largest sacred groves in Meghalaya. It is a well-preserved forest protected by the local community and governed by the local deities, prohibiting anything from being taken out of the forest. We will also visit a Khasi model village. In the evening, we will return to Shillong and visit Elephanta Falls. We will spend the night in Shillong.',
                        'morning_activity' => 'Drive to Mawsynram (Wettest Place on Earth)',
                        'afternoon_activity' => 'Mawphlang Sacred Grove & Khasi Model Village',
                        'evening_activity' => 'Elephanta Falls Visit & Return to Shillong',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 4,
                        'title' => 'Shillong – Dawki – Mawlynnong Village – Cherrapunji (90 KM | 2 Hrs Per Way)',
                        'description' => 'After enjoying breakfast, we will visit Mawlynnong Village, which is recognized as the cleanest village in India. This charming and vibrant village is renowned for its exceptional cleanliness. It is located approximately 90 kilometers from Shillong and offers various fascinating attractions, including the Living Root Bridge and the peculiar natural phenomenon of a boulder balancing on another rock. Following that, we will proceed to Dawki, a place situated along the Indo-Bangladesh border. Here, you will have the opportunity to indulge in boating in the crystal clear waters of the Umgnot River. In the evening, we will continue our journey to Cherrapunji. We will spend the night in Cherrapunji.',
                        'morning_activity' => 'Mawlynnong Cleanest Village & Living Root Bridge',
                        'afternoon_activity' => 'Dawki Umngot River Boating',
                        'evening_activity' => 'Drive to Cherrapunji & Hotel Check-in',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Resort in Cherrapunji',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 5,
                        'title' => 'Cherrapunji Local Sightseeing & Optional Double Decker Root Bridge Trek',
                        'description' => 'Rise early today to fully immerse yourself in the captivating mornings of Cherrapunji. Explore various attractions including Eco Park, Nohkalikai Falls, Nohsngithiang Falls (Seven Sisters Falls), Mawsmai Cave, and Thangkharang Park. After a day filled with exploration, spend the night in Cherrapunji. Optional – You have the option to embark on a full day trek to the Double Decker Living Root Bridge at Nongriat Village. The trek involves descending approximately 3,500 steps each way to reach the Double Decker Living Root Bridge. For those seeking further adventure, you can continue trekking to the Rainbow Falls, which takes about 60 to 90 minutes from the Double Decker Living Root Bridge. Overnight stay in Cherrapunji.',
                        'morning_activity' => 'Nohkalikai Falls & Seven Sisters Waterfalls',
                        'afternoon_activity' => 'Mawsmai Cave & Eco Park (or Nongriat Double Decker Trek)',
                        'evening_activity' => 'Thangkharang Park Sunset & Cherrapunji Stay',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Resort in Cherrapunji',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 6,
                        'title' => 'Cherrapunji to Guwahati (160 KM | 4.5 HRS)',
                        'description' => 'Following breakfast, we will make our way to Guwahati. Take rest and in the evening you may take a River Cruise (Direct Payment) on the mighty River Brahmaputra. You may also visit the local market. Assam is famous for Assam Silk particularly Golden Muga Silk, Assam Tea, Bamboo and Cane Products. Overnight stay in Guwahati.',
                        'morning_activity' => 'Drive from Cherrapunji to Guwahati',
                        'afternoon_activity' => 'Hotel Check-in & Relaxation',
                        'evening_activity' => 'Brahmaputra River Cruise & Silk Market Shopping',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel in Guwahati',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 7,
                        'title' => 'Guwahati Departure',
                        'description' => 'After having breakfast and checking out from the hotel, if time permits, we may opt for a tour of the Kamakhya Temple and we will then transfer you to Guwahati airport or railway station for your onward journey.',
                        'morning_activity' => 'Breakfast & Kamakhya Temple Pilgrimage Visit',
                        'afternoon_activity' => 'Check-out & Transfer to Airport / Railway Station',
                        'evening_activity' => 'Departure Onward Journey',
                        'meals' => 'Breakfast',
                        'hotel' => 'N/A (Departure)',
                        'transportation' => 'Private Cab / SUV'
                    ]
                ]
            ],
            [
                'title' => '5 N 6 D ( Kaziranga 2, Shillong 3)',
                'cover_image' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80',
                'short_description' => '05 N / 06 D Kaziranga 2N & Shillong 3N wildlife and hill station tour covering Kaziranga Elephant & Jeep Safari, Tea Plantations, Umiam Lake, Cherrapunjee, Dawki & Mawlynnong.',
                'full_description' => 'Combine Assam’s wild natural heritage with Meghalaya’s mountain charm! Experience early morning Elephant Safari & Jeep Safari in Kaziranga National Park to spot One-Horn Rhinos, tea gardens, scenic Umiam Lake, Cherrapunjee Nohkalikai Falls, Mawsmai Cave, crystal boating at Dawki River, Asia’s Cleanest Village Mawlynnong, and Don Bosco Museum in Shillong.',
                'destination_id' => $assam?->id,
                'category_id' => $catFamily?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 6,
                'duration_nights' => 5,
                'starting_price' => 25999.00,
                'discounted_price' => 22499.00,
                'max_travelers' => 12,
                'inclusions_text' => "2 Nights Jungle Resort Stay in Kaziranga & 3 Nights Hotel Stay in Shillong\nDaily Breakfast & Dinner\nKaziranga Elephant & Jeep Safari Passes\nPrivate SUV / Sedan for Transfers & Sightseeing\nDawki Umngot River Boating Pass\nAll Entry Fees, Permits & Parking Charges",
                'exclusions_text' => "Flight / Train tickets\nCamera fees inside Kaziranga National Park\nPersonal expenses & tips\nGST 5%",
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Guwahati – Kaziranga National Park (230 KM | 4.5 Hrs)',
                        'description' => 'Welcome to Awesome Assam. Upon arrival at Guwahati Airport/Railway Station, meet your guide/driver. Proceed Kaziranga National Park. Enjoy the scenic drive through the beautiful landscapes of Assam. Reach Kaziranga National Park. Check into your hotel/resort. Evening you may visit Orchid Park and the nearby Tea Plantations. Overnight stay at Kaziranga National Park.',
                        'morning_activity' => 'Guwahati Arrival & Drive to Kaziranga',
                        'afternoon_activity' => 'Resort Check-in & Relaxation',
                        'evening_activity' => 'Orchid Park & Tea Plantation Walk',
                        'meals' => 'Dinner',
                        'hotel' => 'Jungle Resort in Kaziranga',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 2,
                        'title' => 'Kaziranga National Park Elephant & Jeep Safaris',
                        'description' => 'Experience the wonders of Kaziranga National Park with an early morning elephant safari, allowing you to explore the park\'s diverse wildlife. Besides the endangered One-Horn Indian Rhinoceros, the park boasts a significant population of genetically pure Wild Water Buffaloes, over 1000 Wild elephants, and a dense population of Royal Bengal Tigers. Bird enthusiasts will delight in spotting the park\'s 500 species of birds, including the Crested Serpent Eagle, Palla\'s Fishing Eagle, Greyheaded Fishing Eagle, and many more. After the safari, return to the resort for breakfast. In the afternoon, enjoy a thrilling jeep safari, further immersing yourself in the park\'s natural wonders. As the day concludes, return to the hotel for a comfortable overnight stay within the Kaziranga National Park.',
                        'morning_activity' => 'Early Morning Elephant Safari & Spotting Rhinos',
                        'afternoon_activity' => 'Thrilling Wildlife Jeep Safari',
                        'evening_activity' => 'Assamese Cultural Folk Dance Performance',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Jungle Resort in Kaziranga',
                        'transportation' => 'Safari Jeep & Private SUV'
                    ],
                    [
                        'day_number' => 3,
                        'title' => 'Kaziranga National Park to Shillong (280 Km | 6 Hrs)',
                        'description' => 'Start your day with breakfast, and then embark on a drive towards Shillong, a city often referred to as the \'Scotland of the East.\' As you make your way, you\'ll reach the magnificent Umium Lake, also known as Barapani. Here, you have the option to participate in water sports activities if you desire. Upon reaching Shillong, check in at your designated hotel. In the evening, take the opportunity to explore the bustling Police Bazaar, the largest local market in the city. Enjoy the vibrant atmosphere and indulge in shopping or sampling local cuisine. Afterward, retire for the night at your accommodation in Shillong.',
                        'morning_activity' => 'Breakfast & Scenic Drive to Shillong',
                        'afternoon_activity' => 'Umiam Lake (Barapani) Stopover',
                        'evening_activity' => 'Police Bazar Shopping & Night Market Walk',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 4,
                        'title' => 'Shillong–Cherrapunjee-Shillong (65 km | 1.5 hrs per way)',
                        'description' => 'After breakfast, embark on a day trip to Cherrapunjee (approximately 2-3 hours\' drive from Shillong). Visit the Seven Sisters Falls, Mawsmai Cave, and the Nohkalikai Falls, the tallest plunge waterfall in India, Eco Park, Thangkharang Park. Enjoy the breathtaking views of the landscape and the lush green valleys. Return to Shillong in the evening and relax at your hotel.',
                        'morning_activity' => 'Excursion to Cherrapunjee & Nohkalikai Falls',
                        'afternoon_activity' => 'Seven Sisters Waterfalls & Mawsmai Cave',
                        'evening_activity' => 'Thangkharang Park Sunset & Return to Shillong',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 5,
                        'title' => 'Shillong-Dawki-Mawlynnong-Shillong (90 km | 2 hrs per Way)',
                        'description' => 'Embark on a one-day trip from Shillong to Dawki and Mawlynnong, starting early in the morning. Drive to Dawki and immerse yourself in the beauty of the crystal-clear Umngot River. Take a boat ride to witness the mesmerizing underwater world. After a delicious lunch in Dawki, continue your journey to Mawlynnong, known as the "Cleanest Village in Asia." Explore the village\'s well-maintained streets, visit the Living Root Bridge, and climb the Sky View Point for breathtaking panoramic views. Don\'t miss the fascinating Balancing Rock. After a day filled with natural wonders, return to Shillong in the evening and relax at the hotel.',
                        'morning_activity' => 'Dawki Umngot River Crystal Boating',
                        'afternoon_activity' => 'Mawlynnong Village, Living Root Bridge & Sky View',
                        'evening_activity' => 'Return to Shillong & Relaxation',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 6,
                        'title' => 'Shillong to Guwahati (100 km | 3 hrs)',
                        'description' => 'After having breakfast, as per time permits, begin your day by visiting the Don Bosco Centre for Indigenous Cultures. This cultural center showcases the rich heritage and traditions of the indigenous people. Next, head to Ward\'s Lake, where you can take pleasure in boating activities on the serene lake. Don\'t miss the chance to visit the Cathedral Catholic Church, known for its architectural beauty. Continue your exploration by visiting Lady Hydari Park, a charming green space that offers a tranquil ambiance. Take a leisurely stroll and admire the natural beauty of the park. Later, proceed towards Guwahati, where your unforgettable journey comes to an end. You will be transferred to the airport or railway station for your onward travel, cherishing the everlasting memories created during your trip.',
                        'morning_activity' => 'Don Bosco Centre, Ward’s Lake & Cathedral Visit',
                        'afternoon_activity' => 'Lady Hydari Park & Drive to Guwahati',
                        'evening_activity' => 'Transfer to Guwahati Airport / Railway Station',
                        'meals' => 'Breakfast',
                        'hotel' => 'N/A (Departure)',
                        'transportation' => 'Private Cab / SUV'
                    ]
                ]
            ],
            [
                'title' => '6 N 7 D ( Kaziranga 2,Shillong 3 , Guwahati 1 )',
                'cover_image' => 'https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=1200&q=80',
                'short_description' => '06 N / 07 D Kaziranga 2N, Shillong 3N & Guwahati 1N grand tour covering Kaziranga Safaris, Umiam Lake, Cherrapunjee, Dawki, Mawlynnong, Shillong Culture & Kamakhya Temple.',
                'full_description' => 'Experience the grand circuit of Assam and Meghalaya! Enjoy 2 Nights in Kaziranga with Elephant & Jeep safaris, 3 Nights in Shillong exploring Cherrapunjee Nohkalikai Falls, Dawki River crystal boating, Mawlynnong Cleanest Village, and 1 Night in Guwahati with Kamakhya Temple pilgrimage.',
                'destination_id' => $assam?->id,
                'category_id' => $catFamily?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 7,
                'duration_nights' => 6,
                'starting_price' => 29999.00,
                'discounted_price' => 25999.00,
                'max_travelers' => 12,
                'inclusions_text' => "2 Nights Jungle Resort Stay in Kaziranga, 3 Nights in Shillong & 1 Night in Guwahati\nDaily Breakfast & Dinner\nKaziranga Elephant & Jeep Safari Passes\nPrivate SUV / Sedan for Transfers & Sightseeing\nDawki Umngot River Boating Pass\nAll Entry Fees, Permits & Parking Charges",
                'exclusions_text' => "Flight / Train tickets\nCamera fees inside Kaziranga National Park\nPersonal expenses & tips\nGST 5%",
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Guwahati – Kaziranga National Park (230 KM | 4.5 Hrs)',
                        'description' => 'Welcome to Awesome Assam. Upon arrival at Guwahati Airport/Railway Station, meet your guide/driver. Proceed Kaziranga National Park. Enjoy the scenic drive through the beautiful landscapes of Assam. Reach Kaziranga National Park. Check into your hotel/resort. Evening you may visit Orchid Park and the nearby Tea Plantations. Overnight stay at Kaziranga National Park.',
                        'morning_activity' => 'Guwahati Arrival & Drive to Kaziranga',
                        'afternoon_activity' => 'Resort Check-in & Relaxation',
                        'evening_activity' => 'Orchid Park & Tea Plantation Walk',
                        'meals' => 'Dinner',
                        'hotel' => 'Jungle Resort in Kaziranga',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 2,
                        'title' => 'Kaziranga National Park Elephant & Jeep Safaris',
                        'description' => 'Experience the wonders of Kaziranga National Park with an early morning elephant safari, allowing you to explore the park\'s diverse wildlife. Besides the endangered One-Horn Indian Rhinoceros, the park boasts a significant population of genetically pure Wild Water Buffaloes, over 1000 Wild elephants, and a dense population of Royal Bengal Tigers. Bird enthusiasts will delight in spotting the park\'s 500 species of birds, including the Crested Serpent Eagle, Palla\'s Fishing Eagle, Greyheaded Fishing Eagle, and many more. After the safari, return to the resort for breakfast. In the afternoon, enjoy a thrilling jeep safari, further immersing yourself in the park\'s natural wonders. As the day concludes, return to the hotel for a comfortable overnight stay within the Kaziranga National Park.',
                        'morning_activity' => 'Early Morning Elephant Safari & Spotting Rhinos',
                        'afternoon_activity' => 'Thrilling Wildlife Jeep Safari',
                        'evening_activity' => 'Assamese Cultural Folk Dance Performance',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Jungle Resort in Kaziranga',
                        'transportation' => 'Safari Jeep & Private SUV'
                    ],
                    [
                        'day_number' => 3,
                        'title' => 'Kaziranga National Park to Shillong (280 Km | 6 Hrs)',
                        'description' => 'Start your day with breakfast, and then embark on a drive towards Shillong, a city often referred to as the \'Scotland of the East.\' As you make your way, you\'ll reach the magnificent Umium Lake, also known as Barapani. Here, you have the option to participate in water sports activities if you desire. Upon reaching Shillong, check in at your designated hotel. In the evening, take the opportunity to explore the bustling Police Bazaar, the largest local market in the city. Enjoy the vibrant atmosphere and indulge in shopping or sampling local cuisine. Afterward, retire for the night at your accommodation in Shillong.',
                        'morning_activity' => 'Breakfast & Scenic Drive to Shillong',
                        'afternoon_activity' => 'Umiam Lake (Barapani) Stopover',
                        'evening_activity' => 'Police Bazar Shopping & Night Market Walk',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 4,
                        'title' => 'Shillong–Cherrapunjee-Shillong (65 km | 1.5 hrs per way)',
                        'description' => 'After breakfast, embark on a day trip to Cherrapunjee (approximately 2-3 hours\' drive from Shillong). Visit the Seven Sisters Falls, Mawsmai Cave, and the Nohkalikai Falls, the tallest plunge waterfall in India, Eco Park, Thangkharang Park. Enjoy the breathtaking views of the landscape and the lush green valleys. Return to Shillong in the evening and relax at your hotel.',
                        'morning_activity' => 'Excursion to Cherrapunjee & Nohkalikai Falls',
                        'afternoon_activity' => 'Seven Sisters Waterfalls & Mawsmai Cave',
                        'evening_activity' => 'Thangkharang Park Sunset & Return to Shillong',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 5,
                        'title' => 'Shillong-Dawki-Mawlynnong-Shillong (90 km | 2 hrs per Way)',
                        'description' => 'Embark on a one-day trip from Shillong to Dawki and Mawlynnong, starting early in the morning. Drive to Dawki and immerse yourself in the beauty of the crystal-clear Umngot River. Take a boat ride to witness the mesmerizing underwater world. After a delicious lunch in Dawki, continue your journey to Mawlynnong, known as the "Cleanest Village in Asia." Explore the village\'s well-maintained streets, visit the Living Root Bridge, and climb the Sky View Point for breathtaking panoramic views. Don\'t miss the fascinating Balancing Rock. After a day filled with natural wonders, return to Shillong in the evening and relax at the hotel.',
                        'morning_activity' => 'Dawki Umngot River Crystal Boating',
                        'afternoon_activity' => 'Mawlynnong Village, Living Root Bridge & Sky View',
                        'evening_activity' => 'Return to Shillong & Relaxation',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Shillong',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 6,
                        'title' => 'Shillong to Guwahati (100 km | 3 hrs)',
                        'description' => 'After having breakfast, begin your day by visiting the Don Bosco Centre for Indigenous Cultures. This cultural center showcases the rich heritage and traditions of the indigenous people. Next, head to Ward\'s Lake, where you can take pleasure in boating activities on the serene lake. Don\'t miss the chance to visit the Cathedral Catholic Church, known for its architectural beauty. Continue your exploration by visiting Lady Hydari Park, a charming green space that offers a tranquil ambiance. Later, proceed towards Guwahati. Overnight stay at Guwahati.',
                        'morning_activity' => 'Don Bosco Centre & Ward’s Lake Visit',
                        'afternoon_activity' => 'Cathedral & Lady Hydari Park Walk',
                        'evening_activity' => 'Drive to Guwahati & Hotel Stay',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel in Guwahati',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 7,
                        'title' => 'Guwahati Kamakhya Temple & Departure',
                        'description' => 'After having breakfast and checking out from the hotel. Visit the Kamakhya Temple and we will then transfer you to Guwahati airport or railway station for your onward journey.',
                        'morning_activity' => 'Breakfast & Kamakhya Temple Pilgrimage Visit',
                        'afternoon_activity' => 'Check-out & Transfer to Airport / Railway Station',
                        'evening_activity' => 'Departure Onward Journey',
                        'meals' => 'Breakfast',
                        'hotel' => 'N/A (Departure)',
                        'transportation' => 'Private Cab / SUV'
                    ]
                ]
            ],
            [
                'title' => '6 N 7 D ( Tezpur 1,Dirang 1, Tawang 2 , Bomdila 1 , Guwahati 1 )',
                'cover_image' => 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?auto=format&fit=crop&w=1200&q=80',
                'short_description' => '06 N / 07 D Arunachal Himalayan Explorer covering Tezpur 1N, Dirang 1N, Tawang 2N, Bomdila 1N & Guwahati 1N with Sela Pass, Jaswant Garh, Nuranang Falls, Tawang Monastery & Kamakhya Temple.',
                'full_description' => 'Embark on a breathtaking Himalayan journey across Western Arunachal Pradesh and Assam. Visit Agnigarh Hill in Tezpur, Tipi Orchid Research Centre, Sangti Valley in Dirang, snow-clad Sela Pass (13,700 ft), Jaswant Garh War Memorial, Nuranang Falls, Asia’s 2nd largest Tawang Monastery, optional Bum La Pass & Madhuri Lake expedition, Bomdila Monastery, Brahmaputra River Cruise, and Kamakhya Temple.',
                'destination_id' => $arunachal?->id,
                'category_id' => $catAdventure?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 7,
                'duration_nights' => 6,
                'starting_price' => 32999.00,
                'discounted_price' => 28999.00,
                'max_travelers' => 12,
                'inclusions_text' => "1N Hotel Stay in Tezpur, 1N in Dirang, 2N in Tawang, 1N in Bomdila & 1N in Guwahati\nDaily Breakfast & Dinner\nInner Line Permit (ILP) Assistance for Arunachal Pradesh\nPrivate SUV / Sedan for Transfers & Sightseeing\nAll Entry Fees, Permits & Parking Charges",
                'exclusions_text' => "Flight / Train tickets\nBum La Pass & Madhuri Lake local taxi charges (~₹5,500/vehicle + entry fees)\nBrahmaputra River Cruise tickets\nPersonal expenses & tips\nGST 5%",
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Guwahati– Tezpur (183 km | 3 hr 30 min)',
                        'description' => 'Welcome to Awesome Assam. Meet and be assisted by our representative at the airport/Railway station. Transfer to Tezpur. After reaching Tezpur, check into your accommodation and take some rest. In the afternoon, you can visit some popular attractions in Tezpur like Agnigarh Hill, Cole Park, Bamuni Hills, and Mahabhairav Temple. Enjoy the evening exploring the local markets and trying out local delicacies. Overnight stay in Tezpur.',
                        'morning_activity' => 'Guwahati Airport / Station Pickup & Drive to Tezpur',
                        'afternoon_activity' => 'Agnigarh Hill, Cole Park & Bamuni Hills',
                        'evening_activity' => 'Mahabhairav Temple & Tezpur Local Market',
                        'meals' => 'Dinner',
                        'hotel' => 'Hotel in Tezpur',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 2,
                        'title' => 'Tezpur – Dirang (187 Km | 4-5 Hrs)',
                        'description' => 'After Breakfast Proceed to Dirang. On the way visit Orchid Research Centre Tipi, an orchidarium with about 10,000 orchid plants belonging to various genera and species. Arunachal has the largest range of orchids in the country. Continue your drive and do not forget to keep your cameras handy as you cross beautiful waterfalls and get some spectacular views. Enroute visit Nag Mandir. Arrive and check in to your hotel. After lunch visit the regional apple Nursery, kiwi farm, Sangti Valley. Overnight stay in Dirang.',
                        'morning_activity' => 'Drive to Dirang & Tipi Orchid Research Centre',
                        'afternoon_activity' => 'Nag Mandir Stopover & Dirang Check-in',
                        'evening_activity' => 'Apple Nursery, Kiwi Farm & Sangti Valley Walk',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Dirang',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 3,
                        'title' => 'Dirang – Tawang (140 Km | 6 Hrs)',
                        'description' => 'After having breakfast visit Dirang Monastery and proceed towards Tawang. On the way, make a stop at the war cemetery to pay respects. Resume your journey and reach Sela Pass, which stands at an impressive altitude of 4170 meters (13700 feet). This pass is renowned for its breathtaking lakes and scenic landscapes. Continue driving until you arrive at the Jaswant Garh War Memorial, a tribute to the courageous Indian soldier Jaswant Singh Rawat. Take some time to visit the Nuranang Falls, also known as Jang Falls. Finally, reach Tawang and check in at your hotel for an overnight stay.',
                        'morning_activity' => 'Dirang Monastery Visit & Drive to Sela Pass (13,700 ft)',
                        'afternoon_activity' => 'Jaswant Garh War Memorial & Nuranang Waterfalls (Jang)',
                        'evening_activity' => 'Tawang Arrival & Hotel Check-in',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel in Tawang',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 4,
                        'title' => 'Tawang Local Sightseeing / Optional Bum La Pass & Madhuri Lake',
                        'description' => 'After breakfast, you have two options for the day. Option one is to visit Bum La Pass, which is the Indo-China border. To do so, you will need to obtain a permit from the DC office in Tawang on your own. You can also visit Sangestar Lake, also known as Madhuri Lake, and Pangateng Tso Lake, also called P.Tso Lake. Please note that for these visits, you\'ll need to hire a local taxi in Tawang and pay directly for the service, as our vehicles are not allowed in that area. Extra cost 5,500 INR per vehicle and 100 INR per ticket per person. Alternatively, you can choose option two, which includes visiting Tawang Monastery, also known as Namgey Lhatse, Singsor Ani Gompa, and Tawang War Memorial. Please note that if you decide to visit Bum La Pass and Madhuri Lake, it may not be possible to cover all the places in a single day. In the evening, return to the hotel for an overnight stay in Tawang.',
                        'morning_activity' => 'Tawang Monastery (Namgey Lhatse) & Singsor Ani Gompa',
                        'afternoon_activity' => 'Tawang War Memorial & Craft Centre (or Bum La Pass / Madhuri Lake Trek)',
                        'evening_activity' => 'Local Handicraft Shopping & Tawang Leisure Stroll',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel in Tawang',
                        'transportation' => 'Private Cab / SUV (or Local Taxi for Bum La)'
                    ],
                    [
                        'day_number' => 5,
                        'title' => 'Tawang – Bomdila (190 KM | 7 HRS)',
                        'description' => 'After enjoying your breakfast, proceed to Bomdila and complete the check-in process at your hotel upon arrival. Take the opportunity to visit the prominent attractions in Bomdila, such as the Bomdila Monastery In the evening, you can explore the local market and immerse yourself in the vibrant atmosphere. Conclude the day with a comfortable overnight stay in Bomdila.',
                        'morning_activity' => 'Breakfast & Drive from Tawang to Bomdila',
                        'afternoon_activity' => 'Bomdila Hotel Check-in & Bomdila Monastery Visit',
                        'evening_activity' => 'Bomdila Local Market & Handicraft Exploration',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel in Bomdila',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 6,
                        'title' => 'Bomdila – Guwahati (335 KM | 6 – 7 HRS)',
                        'description' => 'After Breakfast, transfer to Guwahati. Check in to your hotel. Evening you may take a River Cruise (Direct Payment) on the mighty River Brahmaputra. You may also visit the local market. Assam is famous for Assam Silk particularly Golden Muga Silk, Assam Tea, Bamboo and Cane Products. Overnight stay in Guwahati.',
                        'morning_activity' => 'Drive from Bomdila down to Guwahati',
                        'afternoon_activity' => 'Hotel Check-in & Relaxation',
                        'evening_activity' => 'Brahmaputra River Cruise & Silk Market Shopping',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel in Guwahati',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 7,
                        'title' => 'Guwahati Kamakhya Temple & Departure',
                        'description' => 'After breakfast check out from the hotel. Visit the Kamakhya Temple With everlasting memories transfer to Guwahati airport/railway station for onward journey.',
                        'morning_activity' => 'Breakfast & Kamakhya Temple Pilgrimage Visit',
                        'afternoon_activity' => 'Check-out & Transfer to Airport / Railway Station',
                        'evening_activity' => 'Departure Onward Journey',
                        'meals' => 'Breakfast',
                        'hotel' => 'N/A (Departure)',
                        'transportation' => 'Private Cab / SUV'
                    ]
                ]
            ],
            [
                'title' => '7 N 8 D (  Tezpur 1,Dirang 1, Tawang 3 , Bomdila 1, Guwahati 1 )',
                'cover_image' => 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?auto=format&fit=crop&w=1200&q=80',
                'short_description' => '07 N / 08 D Extended Arunachal & Assam Expedition covering Tezpur 1N, Dirang 1N, Tawang 3N, Bomdila 1N & Guwahati 1N with Sela Pass, Bum La Pass, Madhuri Lake & Kamakhya Temple.',
                'full_description' => 'Experience the grand 8-day Himalayan odyssey across Western Arunachal Pradesh. Explore Tezpur Agnigarh Hill, Tipi Orchid Research Centre, Dirang Hot Water Spring, Sangti Valley, snow-bound Sela Pass (13,700 ft), Nuranang Falls, Tawang Monastery, full day dedicated excursion to Bum La Pass (Indo-China Border) & Madhuri Lake, Bomdila Monastery, Brahmaputra River Cruise, and Kamakhya Temple in Guwahati.',
                'destination_id' => $arunachal?->id,
                'category_id' => $catAdventure?->id,
                'tour_type_id' => $typeDomestic?->id,
                'duration_days' => 8,
                'duration_nights' => 7,
                'starting_price' => 36999.00,
                'discounted_price' => 32999.00,
                'max_travelers' => 12,
                'inclusions_text' => "1N Stay in Tezpur, 1N in Dirang, 3N in Tawang, 1N in Bomdila & 1N in Guwahati\nDaily Breakfast & Dinner\nInner Line Permit (ILP) Assistance for Arunachal Pradesh\nPrivate SUV / Sedan for Transfers & Sightseeing\nAll Entry Fees, Permits & Parking Charges",
                'exclusions_text' => "Flight / Train tickets\nBum La Pass & Madhuri Lake local taxi charges (~₹5,500/vehicle + entry fees)\nBrahmaputra River Cruise tickets\nPersonal expenses & tips\nGST 5%",
                'is_featured' => true,
                'is_active' => true,
                'itineraries' => [
                    [
                        'day_number' => 1,
                        'title' => 'Guwahati– Tezpur (200 KM | 4 Hrs)',
                        'description' => 'Welcome to Awesome Assam. Meet and be assisted by our representative at the airport/Railway station. Transfer to Tezpur. Start your journey from Guwahati in the morning. After reaching Tezpur, check into your accommodation and take some rest. In the afternoon, you can visit some popular attractions in Tezpur like Agnigarh Hill, Cole Park and Mahabhairav Temple. Enjoy the evening exploring the local markets and trying out local delicacies. Overnight stay in Tezpur.',
                        'morning_activity' => 'Guwahati Airport / Station Pickup & Drive to Tezpur',
                        'afternoon_activity' => 'Agnigarh Hill, Cole Park & Mahabhairav Temple',
                        'evening_activity' => 'Tezpur Local Market & Food Exploration',
                        'meals' => 'Dinner',
                        'hotel' => 'Hotel in Tezpur',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 2,
                        'title' => 'Tezpur – Dirang (187 Km | 4-5 Hrs)',
                        'description' => 'After Breakfast Proceed to Dirang. On the way visit Orchid Research Centre Tipi, an orchidarium with about 10,000 orchid plants belonging to various genera and species. Arunachal has the largest range of orchids in the country. Continue your drive and do not forget to keep your cameras handy as you cross beautiful waterfalls and get some spectacular views. Enroute visit Nag Mandir. Arrive and check in to your hotel. After lunch visit the regional apple Nursery, kiwi farm, hot water spring, Sangti Valley. Overnight stay in Dirang.',
                        'morning_activity' => 'Drive to Dirang & Tipi Orchid Research Centre',
                        'afternoon_activity' => 'Nag Mandir Stopover & Dirang Check-in',
                        'evening_activity' => 'Apple Nursery, Kiwi Farm, Hot Spring & Sangti Valley',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel / Resort in Dirang',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 3,
                        'title' => 'Dirang – Tawang (140 Km | 6 Hrs)',
                        'description' => 'After having breakfast visit Dirang Monastery and proceed towards Tawang. On the way, make a stop at the war cemetery to pay respects. Resume your journey and reach Sela Pass, which stands at an impressive altitude of 4170 meters (13700 feet). This pass is renowned for its breathtaking lakes and scenic landscapes. Continue driving until you arrive at the Jaswant Garh War Memorial, a tribute to the courageous Indian soldier Jaswant Singh Rawat. Take some time to visit the Nuranang Falls, also known as Jang Falls. Finally, reach Tawang and check in at your hotel for an overnight stay.',
                        'morning_activity' => 'Dirang Monastery Visit & Drive to Sela Pass (13,700 ft)',
                        'afternoon_activity' => 'Jaswant Garh War Memorial & Nuranang Waterfalls (Jang)',
                        'evening_activity' => 'Tawang Arrival & Hotel Check-in',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel in Tawang',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 4,
                        'title' => 'Tawang Local Sightseeing',
                        'description' => 'After breakfast visit Tawang Monastery (Namgey Lhatse), Singsor Ani Gompa, and Tawang War Memorial. Evening return back to the hotel. Overnight stay in Tawang.',
                        'morning_activity' => 'Tawang Monastery (Namgey Lhatse) Visit',
                        'afternoon_activity' => 'Singsor Ani Gompa & Tawang War Memorial',
                        'evening_activity' => 'Tawang Local Craft Market & Evening Walk',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel in Tawang',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 5,
                        'title' => 'Tawang – Bumla Pass (China Border) – Madhuri Lake - Tawang',
                        'description' => 'After breakfast, visit Bum La Pass (Indo-China Border) for which you will have to take a permit from the DC office at Tawang on your own, Sangestar Lake (Madhuri Lake) and Pangateng Tso Lake (P.Tso Lake). Please note that for these visits, you\'ll need to hire a local taxi in Tawang and pay directly for the service, as our vehicles are not allowed in that area. Extra cost 5,500 INR per vehicle and 100 INR per ticket per person.',
                        'morning_activity' => 'Excursion to Bum La Pass (Indo-China Border - 15,200 ft)',
                        'afternoon_activity' => 'Sangestar Lake (Madhuri Lake) & P.Tso Lake',
                        'evening_activity' => 'Return to Tawang Hotel & Relaxation',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel in Tawang',
                        'transportation' => 'Local Tawang Sumo Taxi'
                    ],
                    [
                        'day_number' => 6,
                        'title' => 'Tawang– Bomdila (190 KM | 7-8 HRS)',
                        'description' => 'After enjoying your breakfast, proceed to Bomdila and complete the check-in process at your hotel upon arrival. Take the opportunity to visit the prominent attractions in Bomdila, such as the Bomdila Monastery. In the evening, you can explore the local market and immerse yourself in the vibrant atmosphere. Conclude the day with a comfortable overnight stay in Bomdila.',
                        'morning_activity' => 'Breakfast & Drive from Tawang to Bomdila',
                        'afternoon_activity' => 'Bomdila Hotel Check-in & Bomdila Monastery Visit',
                        'evening_activity' => 'Bomdila Local Market & Handicraft Shopping',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel in Bomdila',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 7,
                        'title' => 'Bomdila– Guwahati (335 KM | 6 – 7 HRS)',
                        'description' => 'After Breakfast transfer to Guwahati. Check in to your hotel. Evening you may take a River Cruise (Direct Payment) on the mighty River Brahmaputra. You may also visit the local market. Assam is famous for Assam Silk particularly Golden Muga Silk, Assam Tea, Bamboo and Cane Products. Overnight stay in Guwahati.',
                        'morning_activity' => 'Drive from Bomdila down to Guwahati',
                        'afternoon_activity' => 'Hotel Check-in & Relaxation',
                        'evening_activity' => 'Brahmaputra River Cruise & Silk Market Shopping',
                        'meals' => 'Breakfast & Dinner',
                        'hotel' => 'Hotel in Guwahati',
                        'transportation' => 'Private Cab / SUV'
                    ],
                    [
                        'day_number' => 8,
                        'title' => 'Guwahati Kamakhya Temple & Departure',
                        'description' => 'After breakfast check out from the hotel. Visit the Kamakhya Temple With everlasting memories transfer to Guwahati airport/railway station for onward journey.',
                        'morning_activity' => 'Breakfast & Kamakhya Temple Pilgrimage Visit',
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
