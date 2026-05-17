<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\TourPackage;
use App\Models\Hotel;
use App\Models\Review;
use App\Models\Blog;
use App\Models\Offer;
use App\Models\AdminActivityLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            // USER ANALYTICS
            'total_users' => User::where('role', 'user')->count(),
            'active_users' => User::where('role', 'user')->has('bookings')->count(),
            'recent_users' => User::where('role', 'user')->where('created_at', '>=', now()->subDays(7))->count(),
            
            // BOOKING ANALYTICS
            'total_bookings' => Booking::count(),
            'hotel_bookings' => Booking::where('bookable_type', Hotel::class)->count(),
            'package_bookings' => Booking::where('bookable_type', TourPackage::class)->count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'cancelled_bookings' => Booking::where('status', 'cancelled')->count(),
            
            // PAYMENT ANALYTICS
            'total_revenue' => Booking::where('status', 'confirmed')->sum('total_price'),
            
            // ENTITY ANALYTICS
            'total_packages' => TourPackage::count(),
            'total_hotels' => Hotel::count(),
            'total_destinations' => Destination::count(),
        ];

        // Chart Data (Last 6 Months Revenue & Bookings)
        $months = collect(range(5, 0))->map(fn($i) => now()->subMonths($i)->format('M'));
        
        $revenueData = [];
        $bookingData = [];
        
        foreach(range(5, 0) as $i) {
            $monthStart = now()->subMonths($i)->startOfMonth();
            $monthEnd = now()->subMonths($i)->endOfMonth();
            
            $revenueData[] = Booking::where('status', 'confirmed')
                ->whereBetween('created_at', [$monthStart, $monthEnd])
                ->sum('total_price');
                
            $bookingData[] = Booking::whereBetween('created_at', [$monthStart, $monthEnd])->count();
        }

        $chartData = [
            'labels' => $months->toArray(),
            'revenue' => $revenueData,
            'bookings' => $bookingData,
        ];

        $recentBookings = Booking::with(['user', 'bookable'])->latest()->take(6)->get();
        $recentUsers = User::where('role', 'user')->latest()->take(5)->get();
        $recentActivities = AdminActivityLog::with('admin')->latest()->take(8)->get();

        $topDestinations = Booking::select('bookable_id', 'bookable_type', DB::raw('count(*) as total'))
            ->where('bookable_type', Destination::class)
            ->groupBy('bookable_id', 'bookable_type')
            ->orderByDesc('total')
            ->with('bookable')
            ->take(5)
            ->get();

        $topPackages = Booking::select('bookable_id', 'bookable_type', DB::raw('count(*) as total'))
            ->where('bookable_type', TourPackage::class)
            ->groupBy('bookable_id', 'bookable_type')
            ->orderByDesc('total')
            ->with('bookable')
            ->take(5)
            ->get();

        $topHotels = Booking::select('bookable_id', 'bookable_type', DB::raw('count(*) as total'))
            ->where('bookable_type', Hotel::class)
            ->groupBy('bookable_id', 'bookable_type')
            ->orderByDesc('total')
            ->with('bookable')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentBookings',
            'chartData',
            'recentUsers',
            'recentActivities',
            'topDestinations',
            'topPackages',
            'topHotels'
        ));
    }

    public function bookings(Request $request)
    {
        $query = Booking::with(['user', 'bookable', 'invoice']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('booking_reference', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->paginate(15)->withQueryString();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function payments()
    {
        $payments = \App\Models\Payment::with(['booking.user', 'booking.invoice'])->latest()->paginate(10);
        
        $stats = [
            'total_revenue' => \App\Models\Payment::where('status', 'success')->sum('amount'),
            'successful_payments' => \App\Models\Payment::where('status', 'success')->count(),
            'pending_payments' => \App\Models\Payment::where('status', 'pending')->count(),
            'failed_payments' => \App\Models\Payment::where('status', 'failed')->count(),
        ];
        
        return view('admin.payments.index', compact('payments', 'stats'));
    }

    public function users(Request $request)
    {
        $query = User::withCount('bookings')->with('bookings');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(15)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function showUser(User $user)
    {
        $user->load(['bookings.bookable', 'bookings.payment', 'bookings.invoice', 'wishlists']);
        
        $stats = [
            'total_bookings'    => $user->bookings->count(),
            'total_spent'       => $user->bookings->where('status', 'confirmed')->sum('total_price'),
            'confirmed_bookings'=> $user->bookings->where('status', 'confirmed')->count(),
            'cancelled_bookings'=> $user->bookings->where('status', 'cancelled')->count(),
            'pending_bookings'  => $user->bookings->where('status', 'pending')->count(),
            'wishlist_count'    => $user->wishlists->count(),
        ];
        
        return view('admin.users.show', compact('user', 'stats'));
    }

    public function offers()
    {
        $offers = Offer::latest()->paginate(10);
        return view('admin.offers.index', compact('offers'));
    }

    public function createOffer()
    {
        return view('admin.offers.create');
    }

    public function storeOffer(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'code' => 'required|string|unique:offers,code',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'banner_text' => 'nullable|string|max:255',
            'highlight_text' => 'nullable|string|max:255',
            'countdown_ends_at' => 'nullable|date',
        ]);

        $offer = Offer::create(array_merge($request->all(), [
            'slug' => Str::slug($request->title),
        ]));

        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'offer_created',
            'subject_type' => Offer::class,
            'subject_id' => $offer->id,
            'meta' => ['title' => $request->title],
        ]);

        $users = User::where('role', 'user')->get();
        foreach ($users as $user) {
            \App\Models\Notification::create([
                'id' => (string) Str::uuid(),
                'type' => 'offer_announced',
                'notifiable_type' => get_class($user),
                'notifiable_id' => $user->id,
                'data' => [
                    'offer_id' => $offer->id,
                    'title' => $offer->title,
                    'code' => $offer->code,
                ],
            ]);

            Mail::to($user->email)->send(new \App\Mail\OfferAnnouncementMail($offer));
        }

        return redirect()->route('admin.offers.index')->with('success', 'Offer created successfully.');
    }

    public function editOffer(Offer $offer)
    {
        return view('admin.offers.edit', compact('offer'));
    }

    public function updateOffer(Request $request, Offer $offer)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'banner_text' => 'nullable|string|max:255',
            'highlight_text' => 'nullable|string|max:255',
            'countdown_ends_at' => 'nullable|date',
        ]);

        $offer->update(array_merge($request->all(), [
            'slug' => Str::slug($request->title),
        ]));

        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'offer_updated',
            'subject_type' => Offer::class,
            'subject_id' => $offer->id,
            'meta' => ['title' => $offer->title],
        ]);

        return redirect()->route('admin.offers.index')->with('success', 'Offer updated successfully.');
    }

    public function destroyOffer(Offer $offer)
    {
        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'offer_deleted',
            'subject_type' => Offer::class,
            'subject_id' => $offer->id,
            'meta' => ['title' => $offer->title],
        ]);
        $offer->delete();
        return redirect()->route('admin.offers.index')->with('success', 'Offer deleted successfully.');
    }
}
