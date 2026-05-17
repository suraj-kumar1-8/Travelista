<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Coupon;
use App\Models\AdminActivityLog;
use App\Traits\NotifiesUsers;

class CouponController extends Controller
{
    use NotifiesUsers;
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupons,code',
            'discount_percentage' => 'nullable|integer|min:1|max:100',
            'discount_amount' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date',
        ]);

        $coupon = Coupon::create($validated);

        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'coupon_created',
            'subject_type' => Coupon::class,
            'subject_id' => $coupon->id,
            'meta' => ['code' => $validated['code']],
        ]);

        $this->notifyNewContent('new_coupon', $coupon->code, [
            'coupon_id' => $coupon->id,
            'code' => $coupon->code
        ]);
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully.');
    }
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupons,code,' . $coupon->id,
            'discount_percentage' => 'nullable|integer|min:1|max:100',
            'discount_amount' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $coupon->update($validated);

        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'coupon_updated',
            'subject_type' => Coupon::class,
            'subject_id' => $coupon->id,
            'meta' => ['code' => $coupon->code],
        ]);
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        AdminActivityLog::create([
            'admin_id' => auth()->id(),
            'action' => 'coupon_deleted',
            'subject_type' => Coupon::class,
            'subject_id' => $coupon->id,
            'meta' => ['code' => $coupon->code],
        ]);
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully.');
    }
    public function validateApi(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'amount' => 'required|numeric'
        ]);

        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon || !$coupon->isValid()) {
            return response()->json(['valid' => false, 'message' => 'Invalid or expired coupon code.']);
        }

        $discount = $coupon->calculateDiscount($request->amount);

        return response()->json([
            'valid' => true,
            'discount' => $discount,
            'message' => 'Coupon applied successfully!'
        ]);
    }

}
