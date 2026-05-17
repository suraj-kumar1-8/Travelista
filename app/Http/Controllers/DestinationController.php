<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\AdminActivityLog;
use App\Models\RecentlyViewedItem;
use App\Traits\NotifiesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    use NotifiesUsers;
    public function index(Request $request)
    {
        if ($request->is('admin/*')) {
            $destinations = Destination::latest()->paginate(10);
            return view('admin.destinations.index', compact('destinations'));
        }

        $query = Destination::where('status', 'active');

        // Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search filter
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('location', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        $destinations = $query->latest()->paginate(12);
        $categories = Destination::distinct()->pluck('category')->filter();

        if ($request->ajax()) {
            return view('destinations.partials.list', compact('destinations'))->render();
        }

        return view('destinations.index', compact('destinations', 'categories'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'category' => 'required|string',
            'status' => 'required|in:active,hidden',
            'upload_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('upload_images');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('upload_images')) {
            $images = [];
            foreach ($request->file('upload_images') as $image) {
                $path = $image->store('destinations', 'public');
                $images[] = '/storage/' . $path;
            }
            $data['images'] = json_encode($images);
            if (empty($data['image_url']) && count($images) > 0) {
                $data['image_url'] = $images[0];
            }
        }

        $destination = Destination::create($data);

            AdminActivityLog::create([
                'admin_id' => auth()->id(),
                'action' => 'destination_created',
                'subject_type' => Destination::class,
                'subject_id' => $destination->id,
                'meta' => ['name' => $request->name],
            ]);

        $this->notifyNewContent('new_destination', $destination->name, [
            'destination_id' => $destination->id,
            'slug' => $destination->slug
        ]);

        return redirect()->route('admin.destinations.index')->with('success', 'Destination created successfully.');
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)
            ->where('status', 'active')
            ->with(['hotels', 'tourPackages', 'reviews.user'])
            ->firstOrFail();

        if (auth()->check()) {
            RecentlyViewedItem::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'viewable_type' => Destination::class,
                    'viewable_id' => $destination->id,
                ],
                [
                    'viewed_at' => now(),
                ]
            );
        }
        
        $relatedDestinations = Destination::where('id', '!=', $destination->id)->take(3)->get();
        
        return view('destinations.show', compact('destination', 'relatedDestinations'));
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:active,hidden',
            'upload_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('upload_images');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('upload_images')) {
            $images = $destination->images ? json_decode($destination->images, true) : [];
            if (!is_array($images)) $images = [];
            
            foreach ($request->file('upload_images') as $image) {
                $path = $image->store('destinations', 'public');
                $images[] = '/storage/' . $path;
            }
            $data['images'] = json_encode($images);
            
            if (empty($data['image_url']) && count($images) > 0) {
                $data['image_url'] = $images[0];
            }
        }

        $destination->update($data);

            AdminActivityLog::create([
                'admin_id' => auth()->id(),
                'action' => 'destination_updated',
                'subject_type' => Destination::class,
                'subject_id' => $destination->id,
                'meta' => ['name' => $destination->name],
            ]);

        return redirect()->route('admin.destinations.index')->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination)
    {
        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'destination_deleted',
            'subject_type' => Destination::class,
            'subject_id' => $destination->id,
            'meta' => ['name' => $destination->name],
        ]);

        $destination->delete();
        return redirect()->route('admin.destinations.index')->with('success', 'Destination deleted successfully.');
    }
}
