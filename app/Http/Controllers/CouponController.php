<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Coupon;

class CouponController extends Controller
{
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

        Coupon::create($validated);
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
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
