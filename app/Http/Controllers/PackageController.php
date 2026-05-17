<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use App\Models\Destination;
use App\Models\AdminActivityLog;
use App\Models\RecentlyViewedItem;
use App\Traits\NotifiesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    use NotifiesUsers;
    public function index(Request $request)
    {
        if ($request->is('admin/*')) {
            $packages = TourPackage::with('destination')->latest()->paginate(10);
            $destinations = Destination::all();
            return view('admin.packages.index', compact('packages', 'destinations'));
        }

        $query = TourPackage::where('status', 'active');

        // Destination filter
        if ($request->filled('destination')) {
            $query->whereHas('destination', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->destination}%");
            });
        }

        // Category filter (Budget, Premium, Honeymoon, Adventure, Family)
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Price max filter
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Price min filter
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        // Duration filter
        if ($request->filled('duration')) {
            $query->where('duration_days', $request->duration);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        $packages = $query->with('destination')->latest()->paginate(9);
        $categories = TourPackage::distinct()->pluck('category')->filter();

        if ($request->ajax()) {
            return view('packages.partials.list', compact('packages'))->render();
        }

        return view('packages.index', compact('packages', 'categories'));
    }

    public function create()
    {
        $destinations = Destination::all();
        return view('admin.packages.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'category' => 'required|string',
            'status' => 'required|in:active,hidden',
            'upload_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('upload_images');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('upload_images')) {
            $images = [];
            foreach ($request->file('upload_images') as $image) {
                $path = $image->store('packages', 'public');
                $images[] = '/storage/' . $path;
            }
            $data['images'] = json_encode($images);
            if (empty($data['image_url']) && count($images) > 0) {
                $data['image_url'] = $images[0];
            }
        }

        $package = TourPackage::create($data);

        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'package_created',
            'subject_type' => TourPackage::class,
            'subject_id' => $package->id,
            'meta' => ['name' => $request->name],
        ]);

        $this->notifyNewContent('new_package', $package->name, [
            'package_id' => $package->id,
            'slug' => $package->slug
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function show($slug)
    {
        $package = TourPackage::where('slug', $slug)
            ->where('status', 'active')
            ->with(['destination', 'reviews.user'])
            ->firstOrFail();

        if (auth()->check()) {
            RecentlyViewedItem::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'viewable_type' => TourPackage::class,
                    'viewable_id' => $package->id,
                ],
                [
                    'viewed_at' => now(),
                ]
            );
        }
        
        $relatedPackages = TourPackage::where('destination_id', $package->destination_id)
            ->where('id', '!=', $package->id)
            ->take(3)
            ->get();

        return view('packages.show', compact('package', 'relatedPackages'));
    }

    public function edit(TourPackage $package)
    {
        $destinations = Destination::all();
        return view('admin.packages.edit', compact('package', 'destinations'));
    }

    public function update(Request $request, TourPackage $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,hidden',
            'upload_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('upload_images');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('upload_images')) {
            $images = $package->images ? json_decode($package->images, true) : [];
            if (!is_array($images)) $images = [];
            
            foreach ($request->file('upload_images') as $image) {
                $path = $image->store('packages', 'public');
                $images[] = '/storage/' . $path;
            }
            $data['images'] = json_encode($images);
            
            if (empty($data['image_url']) && count($images) > 0) {
                $data['image_url'] = $images[0];
            }
        }

        $package->update($data);

        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'package_updated',
            'subject_type' => TourPackage::class,
            'subject_id' => $package->id,
            'meta' => ['name' => $package->name],
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(TourPackage $package)
    {
        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'package_deleted',
            'subject_type' => TourPackage::class,
            'subject_id' => $package->id,
            'meta' => ['name' => $package->name],
        ]);

        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }
}
