<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HotelController extends Controller
{
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

        Hotel::create($data);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel created successfully.');
    }

    public function show($slug)
    {
        $hotel = Hotel::where('slug', $slug)
            ->where('status', 'active')
            ->with(['destination', 'reviews.user'])
            ->firstOrFail();
        
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

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully.');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully.');
    }
}
