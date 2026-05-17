<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\TripPlannerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\TravelPhotoController;
use App\Http\Controllers\WeatherController;
use App\Models\Offer;
use Illuminate\Support\Facades\Route;

// Search Routes
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/search', [SearchController::class, 'results'])->name('search.results');

// Public Landing Page (Guest only, redirects to explore if authenticated)
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    $destinations = \App\Models\Destination::where('status', 'active')->take(8)->get();
    return view('landing', compact('destinations'));
})->name('landing');

// Explore Platform Page (Protected)
Route::get('/explore', function () {
    $destinations = \App\Models\Destination::where('status', 'active')->latest()->take(6)->get();
    $offers = Offer::active()->take(3)->get();
    $trendingDestinations = \App\Models\Booking::select('bookable_id', 'bookable_type', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
        ->where('bookable_type', \App\Models\Destination::class)
        ->groupBy('bookable_id', 'bookable_type')
        ->orderByDesc('total')
        ->with('bookable')
        ->take(6)
        ->get();

    return view('welcome', compact('destinations', 'offers', 'trendingDestinations'));
})->name('home')->middleware(['auth', 'verified']);

// Destination Routes
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{slug}', [DestinationController::class, 'show'])->name('destinations.show');

// Package Routes
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{slug}', [PackageController::class, 'show'])->name('packages.show');

// Hotel Routes
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{slug}', [HotelController::class, 'show'])->name('hotels.show');

// Static Pages
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::post('/contact-send', [\App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

// Blog Routes (Public)
Route::get('/blog', function () {
    $blogs = \App\Models\Blog::where('is_published', true)->latest()->paginate(9);
    return view('blog.index', compact('blogs'));
})->name('blog.index');

Route::get('/blog/{slug}', function ($slug) {
    $blog = \App\Models\Blog::where('slug', $slug)->firstOrFail();
    $relatedBlogs = \App\Models\Blog::where('id', '!=', $blog->id)->take(3)->get();
    return view('blog.show', compact('blog', 'relatedBlogs'));
})->name('blog.show');

// Offers (Public)
Route::get('/offers', function () {
    $offers = Offer::active()->get();
    return view('offers.index', compact('offers'));
})->name('offers.index');



// Weather API
Route::get('/weather', [WeatherController::class, 'show'])->name('weather.show');

// User Dashboard & Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Trip Planner & Calculator (Protected)
    Route::get('/trip-planner', [TripPlannerController::class, 'index'])->name('trip-planner.index');
    Route::post('/trip-planner/suggest', [TripPlannerController::class, 'suggest'])->name('trip-planner.suggest');
    Route::post('/trip-planner/store', [TripPlannerController::class, 'store'])->name('trip-planner.store');
    Route::post('/trip-planner/calculate', [TripPlannerController::class, 'calculateExpense'])->name('trip-planner.calculate');

    Route::get('/dashboard', function () {
        $user = auth()->user();
        $stats = [
            'total_bookings' => $user->bookings()->count(),
            'total_spent' => $user->bookings()->where('status', 'confirmed')->sum('total_price'),
            'wishlist_count' => $user->wishlists()->count(),
            'pending_bookings' => $user->bookings()->where('status', 'pending')->count(),
            'hotel_bookings' => $user->bookings()->where('bookable_type', App\Models\Hotel::class)->count(),
            'package_bookings' => $user->bookings()->where('bookable_type', App\Models\TourPackage::class)->count(),
            'destination_bookings' => $user->bookings()->where('bookable_type', App\Models\Destination::class)->count(),
        ];
        $recentBookings = $user->bookings()->with(['bookable', 'invoice'])->latest()->take(5)->get();
        $upcomingTrips = $user->bookings()->with('bookable')->where('start_date', '>', now())->where('status', 'confirmed')->orderBy('start_date', 'asc')->take(3)->get();
        $offers = App\Models\Offer::active()->take(3)->get();
        $recentNotifications = $user->notifications()->latest()->take(5)->get();

        return view('dashboard', compact(
            'stats',
            'recentBookings',
            'upcomingTrips',
            'offers',
            'recentNotifications'
        ));
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/invoice', [BookingController::class, 'invoice'])->name('bookings.invoice');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/{booking}/pay', [BookingController::class, 'processPayment'])->name('bookings.pay');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'requestCancellation'])->name('bookings.cancel');

    // Payments
    Route::post('/payments/verify', [PaymentController::class, 'verify'])->name('payments.verify');
    Route::get('/payment/success', function() { 
        return view('payments.success'); 
    })->name('payment.success');
    Route::get('/payment/failure', function() { 
        return view('payments.failure'); 
    })->name('payment.failure');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

    // Reviews
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-all', [NotificationController::class, 'markAllRead'])->name('notifications.markAll');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');

    // Support
    Route::get('/support', [SupportTicketController::class, 'index'])->name('support.index');
    Route::post('/support', [SupportTicketController::class, 'store'])->name('support.store');
    Route::get('/support/{ticket}', [SupportTicketController::class, 'show'])->name('support.show');
    Route::post('/support/{ticket}/reply', [SupportTicketController::class, 'reply'])->name('support.reply');

    // Travel Photos
    Route::get('/travel-photos', [TravelPhotoController::class, 'index'])->name('travel-photos.index');
    Route::post('/travel-photos', [TravelPhotoController::class, 'store'])->name('travel-photos.store');
    Route::delete('/travel-photos/{photo}', [TravelPhotoController::class, 'destroy'])->name('travel-photos.destroy');


    // Coupons validation
    Route::post('/coupons/validate', [CouponController::class, 'validateApi'])->name('coupons.validate');
});

// Admin Auth Routes
Route::prefix('admin')->middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
});
Route::middleware('auth')->post('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard & Management
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings.index');
    Route::get('/payments', [AdminController::class, 'payments'])->name('payments.index');
    Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');

    // Resource Routes
    Route::resource('destinations', DestinationController::class);
    Route::resource('packages', PackageController::class);
    Route::resource('hotels', HotelController::class);
    Route::resource('reviews', ReviewController::class)->only(['index', 'destroy']);
    Route::resource('blogs', BlogController::class);
    Route::resource('coupons', CouponController::class);

    // Cancellation Management
    Route::post('/bookings/{booking}/approve-cancellation', [BookingController::class, 'approveCancellation'])->name('bookings.approveCancellation');
    Route::post('/bookings/{booking}/reject-cancellation', [BookingController::class, 'rejectCancellation'])->name('bookings.rejectCancellation');

    // Support Tickets
    Route::get('/support', [SupportTicketController::class, 'adminIndex'])->name('support.adminIndex');
    Route::post('/support/{ticket}/status', [SupportTicketController::class, 'updateStatus'])->name('support.updateStatus');

    // Offers Management
    Route::get('/offers', [AdminController::class, 'offers'])->name('offers.index');
    Route::get('/offers/create', [AdminController::class, 'createOffer'])->name('offers.create');
    Route::post('/offers', [AdminController::class, 'storeOffer'])->name('offers.store');
    Route::get('/offers/{offer}/edit', [AdminController::class, 'editOffer'])->name('offers.edit');
    Route::put('/offers/{offer}', [AdminController::class, 'updateOffer'])->name('offers.update');
    Route::delete('/offers/{offer}', [AdminController::class, 'destroyOffer'])->name('offers.destroy');
});

use App\Http\Controllers\Auth\GoogleController;

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

require __DIR__.'/auth.php';
