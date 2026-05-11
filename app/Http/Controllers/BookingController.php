<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\TourPackage;
use App\Models\Hotel;
use App\Models\Payment;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'bookable_type' => 'required|string',
            'bookable_id' => 'required|integer',
            'start_date' => 'required|date|after:today',
            'travelers' => 'required|integer|min:1',
        ]);

        $bookable = null;
        $total_price = 0;

        if ($request->bookable_type === 'TourPackage') {
            $bookable = TourPackage::findOrFail($request->bookable_id);
            $total_price = $bookable->price * $request->travelers;
        } elseif ($request->bookable_type === 'Hotel') {
            $bookable = Hotel::findOrFail($request->bookable_id);
            $nights = max(1, $request->input('nights', 1));
            if ($request->start_date && $request->end_date) {
                $nights = \Carbon\Carbon::parse($request->start_date)->diffInDays(\Carbon\Carbon::parse($request->end_date));
                $nights = max(1, $nights);
            }
            $total_price = $bookable->price_per_night * $nights * $request->travelers;
        } elseif ($request->bookable_type === 'Destination') {
            $bookable = \App\Models\Destination::findOrFail($request->bookable_id);
            $total_price = 1000 * $request->travelers; // Mock base reservation fee for destination inquiry
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'bookable_type' => "App\\Models\\" . $request->bookable_type,
            'bookable_id' => $request->bookable_id,
            'start_date' => $request->start_date,
            'end_date' => $request->input('end_date'),
            'travelers' => $request->travelers,
            'total_price' => $total_price,
            'status' => 'pending',
            'booking_reference' => 'TRV-' . strtoupper(Str::random(8)),
        ]);

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
        $booking->load(['bookable', 'payment', 'user']);
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
            
            $this->generateInvoice($booking);
        }

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

        Payment::create([
            'booking_id' => $booking->id,
            'payment_id' => 'SIM-' . strtoupper(Str::random(12)),
            'order_id' => 'ORD-' . strtoupper(Str::random(10)),
            'amount' => $booking->total_price,
            'currency' => 'INR',
            'status' => 'success',
            'method' => $request->input('method', 'upi'),
        ]);

        $this->generateInvoice($booking);

        return redirect()->route('payment.success', ['booking' => $booking->id])
            ->with('success', 'Payment successful! Your booking is confirmed.');
    }

    private function generateInvoice(Booking $booking)
    {
        if (!$booking->invoice) {
            $taxAmount = $booking->total_price * 0.18; // 18% GST simulation
            $subtotal = $booking->total_price - $taxAmount;

            \App\Models\Invoice::create([
                'invoice_number' => 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id,
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'total_amount' => $booking->total_price,
                'status' => 'paid',
                'due_date' => now()->addDays(7)->toDateString(),
            ]);
        }
    }
}
