<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminActivityLog;
use App\Models\Booking;
use App\Models\BookingStatusHistory;
use App\Models\Coupon;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\HotelRoomCategory;
use App\Models\Itinerary;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\TourPackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'bookable_type' => 'required|string',
            'bookable_id' => 'required|integer',
            'start_date' => 'required|date|after:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'travelers' => 'required|integer|min:1',
            'coupon_code' => 'nullable|string|max:50',
            'room_category_id' => 'nullable|integer',
        ]);

        $bookable = null;
        $basePrice = 0;
        $roomsNeeded = 1;
        $roomCategory = null;

        if ($request->bookable_type === 'TourPackage') {
            $bookable = TourPackage::findOrFail($request->bookable_id);
            if ($bookable->available_seats < $request->travelers) {
                return back()->withErrors(['travelers' => 'Not enough seats available for this package.'])->withInput();
            }
            $basePrice = $bookable->price * $request->travelers;
        } elseif ($request->bookable_type === 'Hotel') {
            $bookable = Hotel::findOrFail($request->bookable_id);
            $nights = max(1, $request->input('nights', 1));
            if ($request->start_date && $request->end_date) {
                $nights = \Carbon\Carbon::parse($request->start_date)->diffInDays(\Carbon\Carbon::parse($request->end_date));
                $nights = max(1, $nights);
            }
            $roomsNeeded = max(1, (int) ceil($request->travelers / 2));

            if ($request->filled('room_category_id')) {
                $roomCategory = HotelRoomCategory::where('hotel_id', $bookable->id)
                    ->where('id', $request->room_category_id)
                    ->first();

                if (!$roomCategory || $roomCategory->rooms_available < $roomsNeeded) {
                    return back()->withErrors(['room_category_id' => 'Selected room category is not available.'])->withInput();
                }

                $basePrice = $roomCategory->price_per_night * $nights * $roomsNeeded;
            } else {
                if ($bookable->available_rooms < $roomsNeeded) {
                    return back()->withErrors(['travelers' => 'Not enough rooms available at this hotel.'])->withInput();
                }
                $basePrice = $bookable->price_per_night * $nights * $roomsNeeded;
            }
        } elseif ($request->bookable_type === 'Destination') {
            $bookable = Destination::findOrFail($request->bookable_id);
            $basePrice = 1000 * $request->travelers; // Mock base reservation fee for destination inquiry
        }

        $coupon = null;
        $discount = 0;
        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();
            if (!$coupon || !$coupon->isValid()) {
                return back()->withErrors(['coupon_code' => 'Invalid or expired coupon code.'])->withInput();
            }
            $discount = $coupon->calculateDiscount($basePrice);
        }

        $subtotal = max(0, $basePrice - $discount);
        $taxAmount = round($subtotal * 0.18, 2);
        $totalPrice = $subtotal + $taxAmount;

        $booking = DB::transaction(function () use ($request, $totalPrice, $subtotal, $taxAmount, $discount, $coupon, $roomCategory) {
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'bookable_type' => "App\\Models\\" . $request->bookable_type,
                'bookable_id' => $request->bookable_id,
                'start_date' => $request->start_date,
                'end_date' => $request->input('end_date'),
                'travelers' => $request->travelers,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'booking_reference' => 'TRV-' . strtoupper(Str::random(8)),
                'coupon_id' => $coupon?->id,
                'coupon_code' => $coupon?->code,
                'discount_amount' => $discount,
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'room_category_id' => $roomCategory?->id,
            ]);

            $this->recordStatusHistory($booking, 'pending', 'Booking created');
            $this->generateItinerary($booking);

            return $booking;
        });

        $this->createNotification(auth()->user(), 'booking_created', [
            'booking_id' => $booking->id,
            'reference' => $booking->booking_reference,
            'status' => $booking->status,
        ]);

        $adminUsers = \App\Models\User::where('role', 'admin')->get();
        foreach ($adminUsers as $adminUser) {
            $this->createNotification($adminUser, 'admin_booking_created', [
                'booking_id' => $booking->id,
                'reference' => $booking->booking_reference,
                'user' => auth()->user()->name,
            ]);
        }

        // If AJAX request, return JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully!',
                'booking' => $booking->load('bookable'),
                'redirect' => route('bookings.show', $booking),
            ]);
        }

        return redirect()->route('bookings.show', $booking)->with('success', 'Booking created! Review your summary below.');
    }

    public function index()
    {
        $bookings = auth()->user()->bookings()->with('bookable')->latest()->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }
        $booking->load(['bookable', 'payment', 'user', 'invoice', 'itineraries', 'statusHistories', 'roomCategory']);
        return view('bookings.show', compact('booking'));
    }

    public function invoice(Booking $booking)
    {
        if ($booking->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }
        $booking->load(['bookable', 'payment', 'user', 'invoice']);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('bookings.invoice-pdf', compact('booking'));
        return $pdf->stream('Invoice-' . $booking->booking_reference . '.pdf');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|in:confirmed,cancelled,completed']);
        $booking->update(['status' => $request->status]);
        $this->recordStatusHistory($booking, $request->status, 'Status updated by admin');

        if ($request->status === 'cancelled') {
            $booking->update([
                'cancellation_status' => 'approved',
                'refund_status' => 'processing',
                'cancelled_at' => now(),
            ]);
            $this->releaseAvailability($booking);
        }

        // Create a simulated payment and invoice when confirmed
        if ($request->status === 'confirmed' && !$booking->payment) {
            Payment::create([
                'booking_id' => $booking->id,
                'payment_id' => 'PAY-' . strtoupper(Str::random(12)),
                'order_id' => 'ORD-' . strtoupper(Str::random(10)),
                'amount' => $booking->total_price,
                'currency' => 'INR',
                'status' => 'success',
                'method' => 'simulated',
            ]);

            $this->applyAvailability($booking);
            $this->generateInvoice($booking);
        }

        if ($request->status === 'completed') {
            $this->createNotification($booking->user, 'booking_completed', [
                'booking_id' => $booking->id,
                'reference' => $booking->booking_reference,
            ]);
        }

        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'booking_status_updated',
            'subject_type' => Booking::class,
            'subject_id' => $booking->id,
            'meta' => ['status' => $request->status],
        ]);

        return back()->with('success', 'Booking status updated successfully.');
    }

    /**
     * Simulate payment for a booking (no real gateway)
     */
    public function processPayment(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Simulate payment success
        $booking->update(['status' => 'confirmed']);
        $this->recordStatusHistory($booking, 'confirmed', 'Payment processed');

        Payment::create([
            'booking_id' => $booking->id,
            'payment_id' => 'SIM-' . strtoupper(Str::random(12)),
            'order_id' => 'ORD-' . strtoupper(Str::random(10)),
            'amount' => $booking->total_price,
            'currency' => 'INR',
            'status' => 'success',
            'method' => $request->input('method', 'upi'),
        ]);

        $this->applyAvailability($booking);
        $this->generateInvoice($booking);
        $this->createNotification($booking->user, 'booking_confirmed', [
            'booking_id' => $booking->id,
            'reference' => $booking->booking_reference,
        ]);

        Mail::to($booking->user->email)->send(new \App\Mail\BookingConfirmedMail($booking));

        return redirect()->route('payment.success', ['booking' => $booking->id])
            ->with('success', 'Payment successful! Your booking is confirmed.');
    }

    public function requestCancellation(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'cancellation_reason' => 'required|string|max:2000',
        ]);

        $booking->update([
            'cancellation_status' => 'requested',
            'cancellation_reason' => $request->cancellation_reason,
        ]);

        $this->recordStatusHistory($booking, 'cancellation_requested', 'User requested cancellation');

        $adminUsers = \App\Models\User::where('role', 'admin')->get();
        foreach ($adminUsers as $adminUser) {
            $this->createNotification($adminUser, 'cancellation_requested', [
                'booking_id' => $booking->id,
                'reference' => $booking->booking_reference,
            ]);
        }

        return back()->with('success', 'Cancellation request submitted.');
    }

    public function approveCancellation(Booking $booking)
    {
        $booking->update([
            'status' => 'cancelled',
            'cancellation_status' => 'approved',
            'refund_status' => 'processing',
            'refund_amount' => $booking->total_price,
            'cancelled_at' => now(),
        ]);

        $this->releaseAvailability($booking);

        $this->recordStatusHistory($booking, 'cancelled', 'Cancellation approved');
        $this->createNotification($booking->user, 'cancellation_approved', [
            'booking_id' => $booking->id,
            'reference' => $booking->booking_reference,
        ]);

        return back()->with('success', 'Cancellation approved.');
    }

    public function rejectCancellation(Booking $booking)
    {
        $booking->update([
            'cancellation_status' => 'rejected',
            'refund_status' => 'none',
        ]);

        $this->recordStatusHistory($booking, 'cancellation_rejected', 'Cancellation rejected');
        $this->createNotification($booking->user, 'cancellation_rejected', [
            'booking_id' => $booking->id,
            'reference' => $booking->booking_reference,
        ]);

        return back()->with('success', 'Cancellation rejected.');
    }

    private function generateInvoice(Booking $booking)
    {
        if (!$booking->invoice) {
            $subtotal = $booking->subtotal ?? $booking->total_price;
            $taxAmount = $booking->tax_amount ?? round($subtotal * 0.18, 2);
            $total = $subtotal + $taxAmount;

            \App\Models\Invoice::create([
                'invoice_number' => 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id,
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'total_amount' => $total,
                'status' => 'paid',
                'due_date' => now()->addDays(7)->toDateString(),
            ]);

            Mail::to($booking->user->email)->send(new \App\Mail\InvoiceMail($booking));
        }
    }

    private function applyAvailability(Booking $booking): void
    {
        if ($booking->bookable_type === Hotel::class) {
            if ($booking->room_category_id) {
                $category = HotelRoomCategory::find($booking->room_category_id);
                if ($category) {
                    $roomsNeeded = max(1, (int) ceil($booking->travelers / 2));
                    $category->decrement('rooms_available', $roomsNeeded);
                }
            } else {
                $roomsNeeded = max(1, (int) ceil($booking->travelers / 2));
                $booking->bookable->decrement('available_rooms', $roomsNeeded);
            }
        }

        if ($booking->bookable_type === TourPackage::class) {
            $booking->bookable->decrement('available_seats', $booking->travelers);
        }
    }

    private function releaseAvailability(Booking $booking): void
    {
        if ($booking->bookable_type === Hotel::class) {
            if ($booking->room_category_id) {
                $category = HotelRoomCategory::find($booking->room_category_id);
                if ($category) {
                    $roomsNeeded = max(1, (int) ceil($booking->travelers / 2));
                    $category->increment('rooms_available', $roomsNeeded);
                }
            } else {
                $roomsNeeded = max(1, (int) ceil($booking->travelers / 2));
                $booking->bookable->increment('available_rooms', $roomsNeeded);
            }
        }

        if ($booking->bookable_type === TourPackage::class) {
            $booking->bookable->increment('available_seats', $booking->travelers);
        }
    }

    private function generateItinerary(Booking $booking): void
    {
        if ($booking->itineraries()->exists()) {
            return;
        }

        $days = 3;
        if ($booking->bookable_type === TourPackage::class) {
            $days = $booking->bookable->duration_days ?? 3;
            if (is_array($booking->bookable->itinerary)) {
                foreach ($booking->bookable->itinerary as $index => $title) {
                    Itinerary::create([
                        'booking_id' => $booking->id,
                        'day_number' => $index + 1,
                        'title' => $title,
                        'description' => 'Curated experience for day ' . ($index + 1),
                        'items' => ['Check-in', 'Local sightseeing', 'Signature activities'],
                    ]);
                }
                $booking->update(['itinerary_generated_at' => now()]);
                return;
            }
        }

        if ($booking->bookable_type === Hotel::class && $booking->start_date && $booking->end_date) {
            $days = max(1, \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date)));
        }

        for ($i = 1; $i <= $days; $i++) {
            $title = $i === 1 ? 'Check-in & Local Discovery' : ($i === $days ? 'Checkout & Farewell' : 'Experience Day ' . $i);
            Itinerary::create([
                'booking_id' => $booking->id,
                'day_number' => $i,
                'title' => $title,
                'description' => 'Planned activities and experiences for the day.',
                'items' => ['Hotel check-in', 'Sightseeing', 'Cuisine experience'],
            ]);
        }

        $booking->update(['itinerary_generated_at' => now()]);
    }

    private function recordStatusHistory(Booking $booking, string $status, string $note = null): void
    {
        BookingStatusHistory::create([
            'booking_id' => $booking->id,
            'status' => $status,
            'note' => $note,
            'created_by' => auth()->id(),
        ]);
    }

    private function createNotification($user, string $type, array $data): void
    {
        Notification::create([
            'id' => (string) Str::uuid(),
            'type' => $type,
            'notifiable_type' => get_class($user),
            'notifiable_id' => $user->id,
            'data' => $data,
        ]);
    }
}
