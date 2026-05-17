<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Destination;
use App\Models\AdminActivityLog;
use App\Models\RecentlyViewedItem;
use App\Models\HotelRoomCategory;
use App\Traits\NotifiesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    use NotifiesUsers;
    public function index(Request $request)
    {
        if ($request->is('admin/*')) {
            $hotels = Hotel::with('destination')->latest()->paginate(10);
            $destinations = Destination::all();
            return view('admin.hotels.index', compact('hotels', 'destinations'));
        }

        $query = Hotel::where('status', 'active');

        // Type filter (Resort, Villas, Budget, Luxury)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Category filter (Luxury, Budget, Premium, Boutique)
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Price max filter
        if ($request->filled('price_max')) {
            $query->where('price_per_night', '<=', $request->price_max);
        }

        // Price min filter
        if ($request->filled('price_min')) {
            $query->where('price_per_night', '>=', $request->price_min);
        }

        // Rating filter
        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        // Destination filter
        if ($request->filled('destination')) {
            $query->whereHas('destination', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->destination}%");
            });
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        $hotels = $query->with('destination')->latest()->paginate(9);
        $types = Hotel::distinct()->pluck('type')->filter();
        $categories = Hotel::distinct()->pluck('category')->filter();

        if ($request->ajax()) {
            return view('hotels.partials.list', compact('hotels'))->render();
        }

        return view('hotels.index', compact('hotels', 'types', 'categories'));
    }

    public function create()
    {
        $destinations = Destination::all();
        return view('admin.hotels.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
            'description' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'type' => 'required|string',
            'category' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:active,hidden',
            'upload_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('upload_images');
        $data['slug'] = Str::slug($request->name);

        if (empty($data['total_rooms'])) {
            $data['total_rooms'] = 50;
        }
        if (empty($data['available_rooms'])) {
            $data['available_rooms'] = $data['total_rooms'];
        }

        if ($request->hasFile('upload_images')) {
            $images = [];
            foreach ($request->file('upload_images') as $image) {
                $path = $image->store('hotels', 'public');
                $images[] = '/storage/' . $path;
            }
            $data['images'] = json_encode($images);
            // Fallback to first image for legacy image_url if not provided
            if (empty($data['image_url']) && count($images) > 0) {
                $data['image_url'] = $images[0];
            }
        }

        $hotel = Hotel::create($data);

        if ($hotel->roomCategories()->count() === 0) {
            $defaults = [
                ['name' => 'Deluxe Room', 'multiplier' => 1],
                ['name' => 'Premium Suite', 'multiplier' => 1.4],
                ['name' => 'Family Room', 'multiplier' => 1.2],
                ['name' => 'Luxury Villa', 'multiplier' => 2],
            ];

            foreach ($defaults as $default) {
                HotelRoomCategory::create([
                    'hotel_id' => $hotel->id,
                    'name' => $default['name'],
                    'price_per_night' => $hotel->price_per_night * $default['multiplier'],
                    'rooms_total' => 10,
                    'rooms_available' => 10,
                ]);
            }
        }

        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'hotel_created',
            'subject_type' => Hotel::class,
            'subject_id' => $hotel->id,
            'meta' => ['name' => $request->name],
        ]);

        $this->notifyNewContent('new_hotel', $hotel->name, [
            'hotel_id' => $hotel->id,
            'slug' => $hotel->slug
        ]);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel created successfully.');
    }

    public function show($slug)
    {
        $hotel = Hotel::where('slug', $slug)
            ->where('status', 'active')
            ->with(['destination', 'reviews.user', 'roomCategories'])
            ->firstOrFail();

        if (auth()->check()) {
            RecentlyViewedItem::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'viewable_type' => Hotel::class,
                    'viewable_id' => $hotel->id,
                ],
                [
                    'viewed_at' => now(),
                ]
            );
        }
        
        $relatedHotels = Hotel::where('destination_id', $hotel->destination_id)
            ->where('id', '!=', $hotel->id)
            ->take(3)
            ->get();

        return view('hotels.show', compact('hotel', 'relatedHotels'));
    }

    public function edit(Hotel $hotel)
    {
        $destinations = Destination::all();
        return view('admin.hotels.edit', compact('hotel', 'destinations'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
            'price_per_night' => 'required|numeric|min:0',
            'status' => 'required|in:active,hidden',
            'upload_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('upload_images');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('upload_images')) {
            $images = $hotel->images ? json_decode($hotel->images, true) : [];
            if (!is_array($images)) $images = [];
            
            foreach ($request->file('upload_images') as $image) {
                $path = $image->store('hotels', 'public');
                $images[] = '/storage/' . $path;
            }
            $data['images'] = json_encode($images);
            
            if (empty($data['image_url']) && count($images) > 0) {
                $data['image_url'] = $images[0];
            }
        }

        $hotel->update($data);

        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'hotel_updated',
            'subject_type' => Hotel::class,
            'subject_id' => $hotel->id,
            'meta' => ['name' => $hotel->name],
        ]);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully.');
    }

    public function destroy(Hotel $hotel)
    {
        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'hotel_deleted',
            'subject_type' => Hotel::class,
            'subject_id' => $hotel->id,
            'meta' => ['name' => $hotel->name],
        ]);

        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully.');
    }
}
