<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $indianBlogs = [
            [
                'title' => 'Uncovering the Secrets of Old Goa',
                'excerpt' => 'A journey through the colonial architecture and hidden spice plantations of the sunshine state.',
                'content' => 'Old Goa, once the Rome of the East, is home to the most magnificent churches and cathedrals in India. In this guide, we explore the Basilica of Bom Jesus, Se Cathedral, and the lesser-known spice trails that define Goan heritage. From the vibrant Anjuna flea market to the serene Dudhsagar waterfalls, this guide covers everything you need to make your Goa trip unforgettable.',
                'image_url' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&q=80&w=800',
                'category' => 'Culture',
            ],
            [
                'title' => 'Top 10 High Altitude Treks in Ladakh',
                'excerpt' => 'From the Markha Valley to the frozen Zanskar river, here are the expeditions for true thrill-seekers.',
                'content' => 'Ladakh, the land of high passes, offers some of the most challenging and breathtaking trekking routes in the world. Whether you are a beginner or a pro, these trails will leave you speechless. The Chadar Trek across the frozen Zanskar River, the Stok Kangri summit at 6,153m, and the picturesque Markha Valley trek are just the beginning of what this magical land offers.',
                'image_url' => 'https://images.unsplash.com/photo-1581791534721-e599df4417f7?auto=format&fit=crop&q=80&w=800',
                'category' => 'Adventure',
            ],
            [
                'title' => 'The Royal Palaces of Rajasthan: A Modern Perspective',
                'excerpt' => 'Experience how India\'s ancient forts have transformed into the world\'s leading luxury resorts.',
                'content' => 'Rajasthan is a living museum. Today, many of its grandest palaces like the Umaid Bhawan and Rambagh serve as ultra-luxury hotels, offering a glimpse into the lifestyle of the maharajas. The Amber Fort in Jaipur, Mehrangarh in Jodhpur, and the Lake Palace in Udaipur each tell stories of centuries-old royal grandeur that continues to mesmerize modern travelers.',
                'image_url' => 'https://images.unsplash.com/photo-1477587458883-47145ed94245?auto=format&fit=crop&q=80&w=800',
                'category' => 'Luxury',
            ],
            [
                'title' => 'Wellness & Ayurveda in the Heart of Kerala',
                'excerpt' => 'Why the backwaters of Kerala are the ultimate destination for physical and spiritual rejuvenation.',
                'content' => 'Kerala is the birthplace of Ayurveda. We dive into the most exclusive retreats that offer bespoke wellness programs tailored to your body type, surrounded by serene tropical nature. From Panchakarma detox treatments in Kovalam to yoga retreats in Wayanad, Kerala offers the most authentic Ayurvedic healing experiences in the world.',
                'image_url' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&q=80&w=800',
                'category' => 'Wellness',
            ],
            [
                'title' => 'Kashmir: Paradise in Every Season',
                'excerpt' => 'Discover why Kashmir has been called Heaven on Earth for centuries.',
                'content' => 'From the snow-draped valleys of Gulmarg to the floating gardens of Dal Lake, Kashmir offers a visual feast that changes with every season. In spring, the Tulip Garden in Srinagar bursts with millions of colorful blooms. Summer brings shikara rides on serene lakes. Autumn paints the Chinar trees gold, and winter transforms the valley into a ski paradise.',
                'image_url' => 'https://images.unsplash.com/photo-1566833925222-7912066d302e?auto=format&fit=crop&q=80&w=800',
                'category' => 'Travel Guide',
            ],
            [
                'title' => 'The Golden Temple: A Spiritual Journey to Amritsar',
                'excerpt' => 'Experience the profound spirituality and legendary hospitality of India\'s holiest Sikh shrine.',
                'content' => 'The Harmandir Sahib (Golden Temple) in Amritsar is not just a place of worship — it is a symbol of universal brotherhood. The temple serves over 100,000 free meals daily in its langar (community kitchen). The evening Palki Sahib ceremony, the sacred Amrit Sarovar pool, and the nearby Jallianwala Bagh memorial make Amritsar an emotionally powerful destination.',
                'image_url' => 'https://images.unsplash.com/photo-1514222139-b57c44ce4169?auto=format&fit=crop&q=80&w=800',
                'category' => 'Spiritual',
            ],
            [
                'title' => 'Budget Travel Guide: Exploring India Under ₹15,000',
                'excerpt' => 'Proof that incredible travel experiences don\'t have to break the bank.',
                'content' => 'India is one of the most budget-friendly travel destinations in the world. From backpacker hostels in Manali to local homestays in Kerala, this guide shows you how to explore the best of India without emptying your wallet. We cover affordable accommodations, cheap eats, free attractions, and insider tips for stretching your rupees further.',
                'image_url' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?auto=format&fit=crop&q=80&w=800',
                'category' => 'Budget Travel',
            ],
            [
                'title' => 'Tea Gardens & Toy Trains: The Magic of Darjeeling',
                'excerpt' => 'A charming hill station where every sip of tea comes with a view of the Himalayas.',
                'content' => 'Darjeeling is more than just tea — it\'s an experience. Watch the sunrise over Kanchenjunga from Tiger Hill, ride the UNESCO-listed Darjeeling Himalayan Railway, and walk through endless rows of emerald tea bushes. The town\'s Tibetan monasteries, vibrant markets, and colonial-era charm make it one of India\'s most beloved hill stations.',
                'image_url' => 'https://images.unsplash.com/photo-1622308644420-f7ae36d67174?auto=format&fit=crop&q=80&w=800',
                'category' => 'Travel Guide',
            ],
        ];

        foreach ($indianBlogs as $blog) {
            Blog::updateOrCreate(
                ['slug' => Str::slug($blog['title'])],
                [
                    'title' => $blog['title'],
                    'slug' => Str::slug($blog['title']),
                    'excerpt' => $blog['excerpt'],
                    'content' => $blog['content'],
                    'image_url' => $blog['image_url'],
                    'category' => $blog['category'],
                    'author' => 'Travelista Curator',
                ]
            );
        }
    }
}
