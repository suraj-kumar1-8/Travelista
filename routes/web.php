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
use App\Models\Offer;
use Illuminate\Support\Facades\Route;

// Search Routes
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/search', [SearchController::class, 'results'])->name('search.results');

// Home
Route::get('/', function () {
    $destinations = \App\Models\Destination::where('status', 'active')->latest()->take(6)->get();
    $offers = Offer::active()->take(3)->get();
    return view('welcome', compact('destinations', 'offers'));
})->name('home');

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

// User Dashboard & Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
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
        return view('dashboard', compact('stats', 'recentBookings', 'upcomingTrips', 'offers'));
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

    // Offers Management
    Route::get('/offers', [AdminController::class, 'offers'])->name('offers.index');
    Route::get('/offers/create', [AdminController::class, 'createOffer'])->name('offers.create');
    Route::post('/offers', [AdminController::class, 'storeOffer'])->name('offers.store');
    Route::get('/offers/{offer}/edit', [AdminController::class, 'editOffer'])->name('offers.edit');
    Route::put('/offers/{offer}', [AdminController::class, 'updateOffer'])->name('offers.update');
    Route::delete('/offers/{offer}', [AdminController::class, 'destroyOffer'])->name('offers.destroy');
});

require __DIR__.'/auth.php';
