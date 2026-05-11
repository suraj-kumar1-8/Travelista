<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Destination;
use App\Models\TourPackage;
use App\Models\Hotel;
use App\Models\Review;
use App\Models\Offer;
use App\Models\Blog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. USERS
        // ==========================================
        $admin = User::updateOrCreate(
            ['email' => 'admin@travelista.com'],
            [
                'name' => 'Admin Travelista',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        $demoUser = User::updateOrCreate(
            ['email' => 'user@travelista.com'],
            [
                'name' => 'Rahul Sharma',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );

        $user2 = User::updateOrCreate(
            ['email' => 'priya@travelista.com'],
            [
                'name' => 'Priya Patel',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );

        $user3 = User::updateOrCreate(
            ['email' => 'arjun@travelista.com'],
            [
                'name' => 'Arjun Singh',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]
        );

        // ==========================================
        // 2. INDIAN DESTINATIONS (12 Destinations)
        // ==========================================
        $indianDestinations = [
            [
                'name' => 'Kashmir',
                'location' => 'Jammu & Kashmir',
                'category' => 'Mountains',
                'description' => 'Heaven on Earth. Kashmir is world-renowned for its pristine Dal Lake houseboats, magnificent Mughal gardens, snow-capped Himalayan peaks, and the enchanting Gulmarg gondola ride. The valley offers breathtaking tulip gardens, shikaras gliding on emerald waters, and the warmth of Kashmiri hospitality.',
                'image_url' => 'https://images.unsplash.com/photo-1566833925222-7912066d302e?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Cold, snowy winters; pleasant summers (15-30°C)',
                'best_time_to_visit' => 'March - October',
            ],
            [
                'name' => 'Goa',
                'location' => 'West India',
                'category' => 'Beaches',
                'description' => 'The ultimate beach paradise. Goa is India\'s smallest state but packs a powerful punch with its golden sandy beaches, vibrant nightlife, Portuguese colonial architecture, spice plantations, and world-famous seafood cuisine. From the lively shores of Baga to the serene beauty of Palolem.',
                'image_url' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Tropical; warm year-round (25-35°C)',
                'best_time_to_visit' => 'November - March',
            ],
            [
                'name' => 'Manali',
                'location' => 'Himachal Pradesh',
                'category' => 'Mountains',
                'description' => 'A high-altitude Himalayan resort town perched at 2,050m. Manali is a gateway for skiing in Solang Valley, trekking to Hampta Pass, and exploring the ancient Hadimba Temple. The Rohtang Pass offers breathtaking views while the Old Manali village exudes bohemian charm.',
                'image_url' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Cool summers (10-25°C); heavy snowfall in winter',
                'best_time_to_visit' => 'October - June',
            ],
            [
                'name' => 'Kerala',
                'location' => 'South India',
                'category' => 'Nature',
                'description' => 'God\'s Own Country. Kerala enchants with its serene backwaters of Alleppey, lush tea plantations of Munnar, pristine beaches of Varkala, and traditional Ayurvedic wellness retreats. Experience houseboat cruises through palm-fringed canals and the rhythmic beauty of Kathakali dance.',
                'image_url' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Tropical; warm and humid (23-33°C)',
                'best_time_to_visit' => 'September - March',
            ],
            [
                'name' => 'Rajasthan',
                'location' => 'West India',
                'category' => 'Heritage',
                'description' => 'The Land of Kings. Rajasthan mesmerizes with its magnificent palaces, ancient forts, and the vast golden Thar Desert. From the Pink City of Jaipur to the Blue City of Jodhpur, every corner tells tales of royal grandeur, colorful festivals, and legendary Rajput warriors.',
                'image_url' => 'https://images.unsplash.com/photo-1477587458883-47145ed94245?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Hot and dry; extreme summers (25-45°C)',
                'best_time_to_visit' => 'October - March',
            ],
            [
                'name' => 'Jaipur',
                'location' => 'Rajasthan',
                'category' => 'Heritage',
                'description' => 'The Pink City of India. Jaipur dazzles with Amer Fort\'s mirror palace, the iconic Hawa Mahal (Palace of Winds), the astronomical wonder of Jantar Mantar, and bustling bazaars filled with block-printed textiles, blue pottery, and precious gemstones.',
                'image_url' => 'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Semi-arid; hot summers (25-45°C)',
                'best_time_to_visit' => 'October - March',
            ],
            [
                'name' => 'Udaipur',
                'location' => 'Rajasthan',
                'category' => 'Heritage',
                'description' => 'The Venice of the East. Udaipur captivates with the ethereal Lake Pichola, the floating Lake Palace (Taj), the grand City Palace complex, and romantic rooftop restaurants overlooking shimmering waters. Known for its art galleries, puppet shows, and royal Mewar heritage.',
                'image_url' => 'https://images.unsplash.com/photo-1548013146-72479768bbaa?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Moderate; pleasant winters (10-28°C)',
                'best_time_to_visit' => 'September - March',
            ],
            [
                'name' => 'Shimla',
                'location' => 'Himachal Pradesh',
                'category' => 'Mountains',
                'description' => 'Queen of the Hills. Shimla, the former British summer capital, charms with its colonial architecture, the legendary Mall Road, the Kalka-Shimla toy train (UNESCO Heritage), Christ Church, and panoramic views of snow-capped Himalayan ranges from Jakhoo Temple.',
                'image_url' => 'https://images.unsplash.com/photo-1597074866923-dc0589150458?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Cool and pleasant (15-30°C in summer)',
                'best_time_to_visit' => 'March - June, December - February',
            ],
            [
                'name' => 'Leh Ladakh',
                'location' => 'Ladakh',
                'category' => 'Adventure',
                'description' => 'The Land of High Passes. Leh-Ladakh is a stark, high-altitude desert landscape dotted with monasteries, turquoise lakes (Pangong, Tso Moriri), magnetic hills, and the legendary Khardung La pass. A paradise for bikers, trekkers, and spiritual seekers alike.',
                'image_url' => 'https://images.unsplash.com/photo-1581791534721-e599df4417f7?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Harsh winters (-20°C); short pleasant summer',
                'best_time_to_visit' => 'June - September',
            ],
            [
                'name' => 'Darjeeling',
                'location' => 'West Bengal',
                'category' => 'Mountains',
                'description' => 'The Queen of the Himalayas. Darjeeling is synonymous with its world-famous tea gardens, the majestic sunrise view of Kanchenjunga from Tiger Hill, the charming Darjeeling Himalayan Railway (toy train), vibrant Tibetan monasteries, and the serene Japanese Peace Pagoda.',
                'image_url' => 'https://images.unsplash.com/photo-1622308644420-f7ae36d67174?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Cool year-round (5-20°C)',
                'best_time_to_visit' => 'April - June, September - November',
            ],
            [
                'name' => 'Amritsar',
                'location' => 'Punjab',
                'category' => 'Religious',
                'description' => 'The spiritual heart of Sikhism. Amritsar is home to the magnificent Golden Temple (Harmandir Sahib), where the world\'s largest free community kitchen serves 100,000+ meals daily. The emotionally charged Wagah Border ceremony and the historic Jallianwala Bagh make this city unforgettable.',
                'image_url' => 'https://images.unsplash.com/photo-1514222139-b57c44ce4169?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Hot summers, cool winters (5-40°C)',
                'best_time_to_visit' => 'October - March',
            ],
            [
                'name' => 'Ooty',
                'location' => 'Tamil Nadu',
                'category' => 'Nature',
                'description' => 'The Queen of Hill Stations. Ooty (Udhagamandalam) enchants visitors with its sprawling botanical gardens, the scenic Nilgiri Mountain Railway, pristine Ooty Lake, vast tea estates, and the stunning Doddabetta Peak offering panoramic views of the Nilgiri Hills.',
                'image_url' => 'https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Pleasant year-round (5-25°C)',
                'best_time_to_visit' => 'October - June',
            ],
            // NEW ADDITIONS
            [
                'name' => 'Varanasi',
                'location' => 'Uttar Pradesh',
                'category' => 'Religious',
                'description' => 'The spiritual capital of India. Witness the mesmerizing Ganga Aarti, explore ancient temples, and take a boat ride on the sacred Ganges river at dawn.',
                'image_url' => 'https://images.unsplash.com/photo-1561361513-2d000a50f0dc?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Hot summers, cool winters (8-45°C)',
                'best_time_to_visit' => 'October - March',
            ],
            [
                'name' => 'Bodh Gaya',
                'location' => 'Bihar',
                'category' => 'Religious',
                'description' => 'The most holy place for Buddhists, where Lord Buddha attained enlightenment under the Bodhi Tree. A serene town dotted with monasteries from around the world.',
                'image_url' => 'https://images.unsplash.com/photo-1574691456614-2780e9fb5dc2?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Hot summers, pleasant winters (10-40°C)',
                'best_time_to_visit' => 'October - March',
            ],
            [
                'name' => 'Rann of Kutch',
                'location' => 'Gujarat',
                'category' => 'Nature',
                'description' => 'A massive expanse of cracked earth turning into a mesmerizing white salt desert. Famous for the vibrant Rann Utsav and stunning moonlit nights.',
                'image_url' => 'https://images.unsplash.com/photo-1623145450868-b7100b74070a?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Extreme temperatures (12-45°C)',
                'best_time_to_visit' => 'November - February',
            ],
            [
                'name' => 'Mumbai',
                'location' => 'Maharashtra',
                'category' => 'Heritage',
                'description' => 'The City of Dreams. Explore the Gateway of India, Marine Drive, historic colonial architecture, and the bustling Bollywood culture.',
                'image_url' => 'https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Humid and warm year-round (20-35°C)',
                'best_time_to_visit' => 'October - March',
            ],
            [
                'name' => 'Gangtok',
                'location' => 'Sikkim',
                'category' => 'Mountains',
                'description' => 'A pristine Himalayan city offering views of Mount Kanchenjunga, vibrant Buddhist monasteries, and steep winding roads.',
                'image_url' => 'https://images.unsplash.com/photo-1544837568-18e392683935?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Cool and temperate (5-22°C)',
                'best_time_to_visit' => 'September - June',
            ],
            [
                'name' => 'Rishikesh',
                'location' => 'Uttarakhand',
                'category' => 'Adventure',
                'description' => 'The Yoga Capital of the World and a prime destination for white-water rafting on the Ganges.',
                'image_url' => 'https://images.unsplash.com/photo-1595015340058-2936279f8b44?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Pleasant to cold (8-35°C)',
                'best_time_to_visit' => 'September - June',
            ],
            [
                'name' => 'Coorg',
                'location' => 'Karnataka',
                'category' => 'Nature',
                'description' => 'The Scotland of India, famous for its lush coffee plantations, misty hills, and beautiful waterfalls.',
                'image_url' => 'https://images.unsplash.com/photo-1599839619722-39751411ea63?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Cool and pleasant (15-28°C)',
                'best_time_to_visit' => 'October - March',
            ],
            [
                'name' => 'Shillong',
                'location' => 'Meghalaya',
                'category' => 'Mountains',
                'description' => 'The Abode of Clouds, known for its rolling hills, crystal clear rivers, and the spectacular living root bridges.',
                'image_url' => 'https://images.unsplash.com/photo-1599839575945-a9e5af0c3fa5?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Cool and wet (10-24°C)',
                'best_time_to_visit' => 'September - May',
            ],
            [
                'name' => 'Kaziranga',
                'location' => 'Assam',
                'category' => 'Nature',
                'description' => 'A UNESCO World Heritage site and home to the majestic one-horned rhinoceros. A pristine wildlife sanctuary.',
                'image_url' => 'https://images.unsplash.com/photo-1602072214643-ab3187a41ce2?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Tropical (10-35°C)',
                'best_time_to_visit' => 'November - April',
            ],
            [
                'name' => 'Tawang',
                'location' => 'Arunachal Pradesh',
                'category' => 'Mountains',
                'description' => 'A serene Himalayan town known for the massive Tawang Monastery, alpine lakes, and dramatic mountain passes.',
                'image_url' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Cold (-10 to 20°C)',
                'best_time_to_visit' => 'March - October',
            ],
            [
                'name' => 'Havelock Island',
                'location' => 'Andaman',
                'category' => 'Beaches',
                'description' => 'Famous for Radhanagar Beach, crystal-clear turquoise waters, and world-class scuba diving spots among coral reefs.',
                'image_url' => 'https://images.unsplash.com/photo-1590409951631-f76ea8f936b8?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Tropical warm (23-31°C)',
                'best_time_to_visit' => 'October - May',
            ],
            [
                'name' => 'Agatti',
                'location' => 'Lakshadweep',
                'category' => 'Beaches',
                'description' => 'A stunning coral atoll offering pristine white sand beaches, untouched lagoons, and unparalleled snorkeling experiences.',
                'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&q=80&w=1200',
                'weather' => 'Tropical warm (22-32°C)',
                'best_time_to_visit' => 'October - March',
            ],
        ];

        // Destination-specific hotel images
        $hotelImages = [
            'Kashmir' => [
                'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=1200',
                'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=1200'
            ],
            'Goa' => [
                'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&q=80&w=1200',
                'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&q=80&w=1200'
            ],
            'Manali' => [
                'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?auto=format&fit=crop&q=80&w=1200',
                'https://images.unsplash.com/photo-1596178065887-1198b6148b2b?auto=format&fit=crop&q=80&w=1200'
            ],
            'Kerala' => [
                'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?auto=format&fit=crop&q=80&w=1200',
                'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&q=80&w=1200'
            ],
            'Rajasthan' => [
                'https://images.unsplash.com/photo-1455587734955-081b22074882?auto=format&fit=crop&q=80&w=1200',
                'https://images.unsplash.com/photo-1564501049412-61c2a3083791?auto=format&fit=crop&q=80&w=1200'
            ],
            'Jaipur' => [
                'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&q=80&w=1200',
                'https://images.unsplash.com/photo-1549294413-26f195200c16?auto=format&fit=crop&q=80&w=1200'
            ],
            'Udaipur' => [
                'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=1200',
                'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?auto=format&fit=crop&q=80&w=1200'
            ],
            'Shimla' => [
                'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?auto=format&fit=crop&q=80&w=1200',
                'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=1200'
            ],
            'Leh Ladakh' => [
                'https://images.unsplash.com/photo-1596178065887-1198b6148b2b?auto=format&fit=crop&q=80&w=1200',
                'https://images.unsplash.com/photo-1445019980597-93fa8acb246c?auto=format&fit=crop&q=80&w=1200'
            ],
            'Darjeeling' => [
                'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?auto=format&fit=crop&q=80&w=1200',
                'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=1200'
            ],
            'Amritsar' => [
                'https://images.unsplash.com/photo-1455587734955-081b22074882?auto=format&fit=crop&q=80&w=1200',
                'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&q=80&w=1200'
            ],
            'Ooty' => [
                'https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&q=80&w=1200',
                'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&q=80&w=1200'
            ],
        ];

        $hotelTypes = ['Resort', 'Villas', 'Budget', 'Luxury'];
        $hotelCategories = ['Luxury', 'Budget', 'Premium', 'Boutique'];

        foreach ($indianDestinations as $destData) {
            $destination = Destination::updateOrCreate(
                ['name' => $destData['name']],
                [
                    'slug' => Str::slug($destData['name']),
                    'location' => $destData['location'],
                    'category' => $destData['category'],
                    'description' => $destData['description'],
                    'image_url' => $destData['image_url'],
                    'weather' => $destData['weather'],
                    'best_time_to_visit' => $destData['best_time_to_visit'],
                ]
            );

            // Hotels for each destination
            $imgs = $hotelImages[$destData['name']] ?? $hotelImages['Kashmir'];

            Hotel::updateOrCreate(
                ['name' => 'The Grand ' . $destination->name . ' Resort'],
                [
                    'destination_id' => $destination->id,
                    'slug' => Str::slug('The Grand ' . $destination->name . ' Resort'),
                    'description' => 'Experience ultra-luxury at the heart of ' . $destination->name . '. Featuring private pools, world-class dining, premium spa services, and personalized butler service.',
                    'image_url' => $imgs[0],
                    'price_per_night' => rand(15000, 45000),
                    'rating' => 5,
                    'type' => 'Resort',
                    'category' => 'Luxury',
                    'amenities' => json_encode(['Pool', 'Spa', 'Gym', 'Free WiFi', 'Breakfast', 'Restaurant', 'Bar', 'Room Service']),
                ]
            );

            Hotel::updateOrCreate(
                ['name' => $destination->name . ' Heritage Villa'],
                [
                    'destination_id' => $destination->id,
                    'slug' => Str::slug($destination->name . ' Heritage Villa'),
                    'description' => 'A blend of tradition and modern comfort in ' . $destination->name . '. Perfect for families seeking a peaceful, culturally enriching retreat.',
                    'image_url' => $imgs[1],
                    'price_per_night' => rand(5000, 15000),
                    'rating' => 4,
                    'type' => 'Villas',
                    'category' => 'Budget',
                    'amenities' => json_encode(['Garden', 'Kitchen', 'Free WiFi', 'Parking', 'Laundry']),
                ]
            );

            Hotel::updateOrCreate(
                ['name' => $destination->name . ' Boutique Stay'],
                [
                    'destination_id' => $destination->id,
                    'slug' => Str::slug($destination->name . ' Boutique Stay'),
                    'description' => 'A charming boutique property offering an intimate ' . $destination->name . ' experience with handpicked local art and organic cuisine.',
                    'image_url' => $imgs[0],
                    'price_per_night' => rand(8000, 20000),
                    'rating' => 4,
                    'type' => 'Budget',
                    'category' => 'Boutique',
                    'amenities' => json_encode(['Free WiFi', 'Breakfast', 'Terrace', 'Library', 'Yoga']),
                ]
            );

            // Tour Packages for each destination
            $packageCategories = [
                ['cat' => 'Adventure', 'price' => rand(25000, 45000), 'days' => 5],
                ['cat' => 'Family', 'price' => rand(35000, 55000), 'days' => 7],
                ['cat' => 'Honeymoon', 'price' => rand(45000, 75000), 'days' => 6],
                ['cat' => 'Budget', 'price' => rand(15000, 25000), 'days' => 4],
                ['cat' => 'Premium', 'price' => rand(60000, 100000), 'days' => 10],
            ];

            foreach ($packageCategories as $pkg) {
                TourPackage::updateOrCreate(
                    ['name' => $pkg['cat'] . ' ' . $destination->name . ' Expedition'],
                    [
                        'destination_id' => $destination->id,
                        'slug' => Str::slug($pkg['cat'] . ' ' . $destination->name . ' Expedition'),
                        'description' => 'A curated ' . $pkg['days'] . '-day ' . strtolower($pkg['cat']) . ' journey through the most iconic experiences of ' . $destination->name . '. ' . $destination->description,
                        'image_url' => $destination->getRawOriginal('image_url'),
                        'price' => $pkg['price'],
                        'duration_days' => $pkg['days'],
                        'category' => $pkg['cat'],
                        'itinerary' => json_encode([
                            'Day 1: Grand Arrival & Luxury Transfer',
                            'Day 2: Guided Cultural Heritage Tour',
                            'Day 3: Adventure & Outdoor Expedition',
                            'Day 4: Local Cuisine & Artisan Experience',
                            ...(($pkg['days'] > 4) ? ['Day 5: Scenic Nature & Photography Tour'] : []),
                            ...(($pkg['days'] > 5) ? ['Day 6: Signature Fine Dining Evening'] : []),
                            ...(($pkg['days'] > 6) ? ['Day 7: Spa & Wellness Retreat Day'] : []),
                            'Day ' . $pkg['days'] . ': Farewell & Premium Departure',
                        ]),
                        'inclusions' => json_encode([
                            'Luxury Accommodation',
                            'All Meals Included',
                            'Private Expert Guide',
                            'Premium Transport',
                            'Entry Fees & Permits',
                            'Travel Insurance',
                        ]),
                    ]
                );
            }
        }

        // ==========================================
        // 3. REVIEWS (Realistic Indian user reviews)
        // ==========================================
        $reviewComments = [
            5 => [
                'Absolutely breathtaking experience! The views were beyond words. Highly recommended for every traveler.',
                'Best trip of our lives. The arrangements were world-class and the guide was extremely knowledgeable.',
                'Pure magic! Every moment was picture-perfect. Will definitely book again with Travelista.',
                'Outstanding service from start to finish. The hotel was luxurious and the itinerary was perfectly planned.',
            ],
            4 => [
                'Great experience overall. Minor improvements could be made to the transport arrangements.',
                'Beautiful destination with excellent hotel accommodations. The food was authentic and delicious.',
                'Very well organized trip. The guide was friendly and informative. Would recommend to friends.',
            ],
            3 => [
                'Good trip but some activities were rushed. More free time would have been appreciated.',
                'Decent experience. The hotel was okay but the location could have been better.',
            ],
        ];

        $destinations = Destination::all();
        $users = User::where('role', 'user')->get();

        foreach ($destinations as $destination) {
            foreach ($users as $user) {
                $rating = collect([5, 5, 5, 4, 4, 3])->random();
                $comments = $reviewComments[$rating];

                Review::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'reviewable_type' => 'App\Models\Destination',
                        'reviewable_id' => $destination->id,
                    ],
                    [
                        'rating' => $rating,
                        'comment' => $comments[array_rand($comments)],
                    ]
                );
            }
        }

        // ==========================================
        // 4. OFFERS
        // ==========================================
        $offers = [
            [
                'title' => 'Summer Special - 25% Off',
                'description' => 'Get 25% off on all mountain destinations. Valid for Kashmir, Manali, Shimla, and Darjeeling packages.',
                'image_url' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?auto=format&fit=crop&q=80&w=800',
                'code' => 'SUMMER25',
                'discount_type' => 'percentage',
                'discount_value' => 25,
                'min_booking_amount' => 20000,
                'valid_from' => now()->subDays(10),
                'valid_until' => now()->addMonths(3),
            ],
            [
                'title' => 'Honeymoon Paradise - ₹5000 Off',
                'description' => 'Flat ₹5000 discount on all honeymoon packages. Perfect for newlyweds exploring Kerala, Udaipur, and Goa.',
                'image_url' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&q=80&w=800',
                'code' => 'HONEYMOON5K',
                'discount_type' => 'fixed',
                'discount_value' => 5000,
                'min_booking_amount' => 30000,
                'valid_from' => now()->subDays(5),
                'valid_until' => now()->addMonths(6),
            ],
            [
                'title' => 'Adventure Rush - 15% Off',
                'description' => 'Thrill-seekers rejoice! 15% off on all adventure packages to Ladakh, Manali, and Rajasthan.',
                'image_url' => 'https://images.unsplash.com/photo-1581791534721-e599df4417f7?auto=format&fit=crop&q=80&w=800',
                'code' => 'ADVENTURE15',
                'discount_type' => 'percentage',
                'discount_value' => 15,
                'min_booking_amount' => 15000,
                'valid_from' => now(),
                'valid_until' => now()->addMonths(2),
            ],
            [
                'title' => 'Family Bonanza - 20% Off',
                'description' => 'Create unforgettable family memories. 20% off on all family packages across India.',
                'image_url' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&q=80&w=800',
                'code' => 'FAMILY20',
                'discount_type' => 'percentage',
                'discount_value' => 20,
                'min_booking_amount' => 25000,
                'valid_from' => now()->subDays(2),
                'valid_until' => now()->addMonths(4),
            ],
            [
                'title' => 'Heritage India - ₹3000 Off',
                'description' => 'Explore India\'s royal heritage. Flat ₹3000 off on Jaipur, Udaipur, and Rajasthan packages.',
                'image_url' => 'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&q=80&w=800',
                'code' => 'HERITAGE3K',
                'discount_type' => 'fixed',
                'discount_value' => 3000,
                'min_booking_amount' => 20000,
                'valid_from' => now(),
                'valid_until' => now()->addMonths(5),
            ],
        ];

        foreach ($offers as $offer) {
            Offer::updateOrCreate(
                ['code' => $offer['code']],
                array_merge($offer, ['slug' => Str::slug($offer['title'])])
            );
        }

        // ==========================================
        // 5. BLOGS
        // ==========================================
        $this->call(BlogSeeder::class);
    }
}
