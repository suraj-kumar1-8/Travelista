<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\TourPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TravelistaSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Bali',
                'location' => 'Indonesia',
                'description' => 'A tropical paradise known for its volcanic mountains, iconic rice paddies, beaches and coral reefs.',
                'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&q=80&w=1200',
                'weather' => '27°C - Tropical',
                'best_time_to_visit' => 'April to October',
                'gallery' => [
                    'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&q=80&w=800',
                    'https://images.unsplash.com/photo-1506929113675-b9299d39bb6b?auto=format&fit=crop&q=80&w=800'
                ],
                'nearby_attractions' => ['Uluwatu Temple', 'Tegallalang Rice Terrace', 'Sacred Monkey Forest'],
                'map_coordinates' => '-8.4095, 115.1889'
            ],
            [
                'name' => 'Swiss Alps',
                'location' => 'Switzerland',
                'description' => 'The highest and most extensive mountain range system that lies entirely in Europe.',
                'image_url' => 'https://images.unsplash.com/photo-1493246507139-91e8bef99c02?auto=format&fit=crop&q=80&w=1200',
                'weather' => '-5°C to 15°C',
                'best_time_to_visit' => 'December to March',
                'gallery' => [
                    'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&q=80&w=800',
                    'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&q=80&w=800'
                ],
                'nearby_attractions' => ['Matterhorn', 'Jungfraujoch', 'Lucerne Lake'],
                'map_coordinates' => '46.5581, 8.5236'
            ],
            [
                'name' => 'Paris',
                'location' => 'France',
                'description' => 'The city of light, world-famous for its art, fashion, gastronomy and culture.',
                'image_url' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&q=80&w=1200',
                'weather' => '12°C - 20°C',
                'best_time_to_visit' => 'June to August',
                'gallery' => [
                    'https://images.unsplash.com/photo-1493246507139-91e8bef99c02?auto=format&fit=crop&q=80&w=800'
                ],
                'nearby_attractions' => ['Eiffel Tower', 'Louvre Museum', 'Notre-Dame'],
                'map_coordinates' => '48.8566, 2.3522'
            ]
        ];

        foreach ($destinations as $destData) {
            $destination = Destination::create([
                'name' => $destData['name'],
                'slug' => Str::slug($destData['name']),
                'location' => $destData['location'],
                'description' => $destData['description'],
                'image_url' => $destData['image_url'],
                'weather' => $destData['weather'],
                'best_time_to_visit' => $destData['best_time_to_visit'],
                'gallery' => $destData['gallery'],
                'nearby_attractions' => $destData['nearby_attractions'],
                'map_coordinates' => $destData['map_coordinates']
            ]);

            // Create Hotels for this Destination
            Hotel::create([
                'destination_id' => $destination->id,
                'name' => 'The Royal ' . $destination->name . ' Resort',
                'slug' => Str::slug('The Royal ' . $destination->name . ' Resort'),
                'description' => 'Experience ultimate luxury at the heart of ' . $destination->name . '.',
                'address' => '123 Luxury Avenue, ' . $destination->name,
                'stars' => 5,
                'image_url' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?auto=format&fit=crop&q=80&w=800',
                'amenities' => ['Private Pool', 'Spa', 'Fine Dining', 'Gym', 'Free WiFi'],
                'price_per_night' => rand(300, 800)
            ]);

            Hotel::create([
                'destination_id' => $destination->id,
                'name' => 'Grand Horizon Hotel',
                'slug' => Str::slug('Grand Horizon Hotel ' . $destination->name),
                'description' => 'Breathtaking views and modern comfort combined.',
                'address' => '456 Skyline Drive, ' . $destination->name,
                'stars' => 4,
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=800',
                'amenities' => ['Rooftop Bar', 'Pool', 'Breakfast Included'],
                'price_per_night' => rand(150, 400)
            ]);

            // Create Tour Packages for this Destination
            TourPackage::create([
                'destination_id' => $destination->id,
                'name' => $destination->name . ' Essential Tour',
                'slug' => Str::slug($destination->name . ' Essential Tour'),
                'description' => 'The perfect introduction to the wonders of ' . $destination->name . '.',
                'duration' => '5 Days',
                'price' => rand(1000, 2500),
                'image_url' => $destination->image_url,
                'itinerary' => [
                    ['day' => 1, 'title' => 'Arrival & Welcome', 'content' => 'Arrival at airport and transfer to luxury resort.'],
                    ['day' => 2, 'title' => 'Local Exploration', 'content' => 'Guided tour of local landmarks and hidden gems.'],
                    ['day' => 3, 'title' => 'Cultural Experience', 'content' => 'Traditional dinner and cultural performance.'],
                ],
                'included_services' => ['Flight', 'Hotel', 'Transfers', 'Guide', 'Daily Breakfast']
            ]);
        }
    }
}
