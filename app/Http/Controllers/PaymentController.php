<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class PaymentController extends Controller
{
    public function verify(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $booking = Booking::findOrFail($request->booking_id);
            $booking->update(['status' => 'confirmed']);

            Payment::create([
                'booking_id' => $booking->id,
                'payment_id' => $request->razorpay_payment_id,
                'order_id' => $request->razorpay_order_id,
                'amount' => $booking->total_price,
                'status' => 'success',
                'method' => 'razorpay'
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Payment verified successfully',
                'redirect' => route('payment.success')
            ]);

        } catch (SignatureVerificationError $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Payment verification failed',
                'redirect_url' => route('payment.failure')
            ], 400);
        }
    }
}
