<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = auth()->user()->wishlists()->with('wishable')->latest()->paginate(12);
        return view('wishlist.index', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'wishable_type' => 'required|string',
            'wishable_id' => 'required|integer',
        ]);

        $type = "App\\Models\\" . $request->wishable_type;
        $user = auth()->user();

        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('wishable_type', $type)
            ->where('wishable_id', $request->wishable_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['success' => true, 'status' => 'removed']);
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'wishable_type' => $type,
                'wishable_id' => $request->wishable_id,
            ]);
            return response()->json(['success' => true, 'status' => 'added']);
        }
    }
}
