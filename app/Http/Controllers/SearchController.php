<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\TourPackage;
use App\Models\Hotel;

class SearchController extends Controller
{
    public function suggestions(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $destinations = Destination::where('name', 'like', "%{$query}%")
            ->orWhere('location', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->take(5)
            ->get(['id', 'name', 'slug', 'image_url', 'location', 'category']);

        $packages = TourPackage::where('name', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->with('destination:id,name')
            ->take(5)
            ->get(['id', 'name', 'slug', 'image_url', 'price', 'destination_id']);

        $hotels = Hotel::where('name', 'like', "%{$query}%")
            ->orWhere('type', 'like', "%{$query}%")
            ->with('destination:id,name')
            ->take(5)
            ->get(['id', 'name', 'slug', 'image_url', 'price_per_night', 'destination_id', 'rating']);

        return response()->json([
            'destinations' => $destinations,
            'packages' => $packages,
            'hotels' => $hotels,
        ]);
    }

    public function results(Request $request)
    {
        $query = $request->get('q', '');

        $destinations = Destination::where('name', 'like', "%{$query}%")
            ->orWhere('location', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();

        $packages = TourPackage::where('name', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->with('destination')
            ->get();

        $hotels = Hotel::where('name', 'like', "%{$query}%")
            ->orWhere('type', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->with('destination')
            ->get();

        $totalResults = $destinations->count() + $packages->count() + $hotels->count();

        return view('search.results', compact('destinations', 'packages', 'hotels', 'query', 'totalResults'));
    }
}
