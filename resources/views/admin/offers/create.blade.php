@extends('layouts.admin')
@section('header', 'Add Offer')
@section('content')
<div class="max-w-3xl">
    <form action="{{ route('admin.offers.store') }}" method="POST" class="glass p-12 rounded-[3rem] border-white/5 space-y-8">
        @csrf
        @if($errors->any())<div class="p-4 rounded-xl bg-rose-500/10 text-rose-400 text-sm">{{ $errors->first() }}</div>@endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Offer Title</label><input type="text" name="title" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Coupon Code</label><input type="text" name="code" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 uppercase"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Discount Type</label>
            <select name="discount_type" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600">
                <option value="percentage" class="bg-slate-900">Percentage (%)</option>
                <option value="fixed" class="bg-slate-900">Fixed Amount (₹)</option>
            </select></div>
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Discount Value</label><input type="number" step="0.01" name="discount_value" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Valid From</label><input type="date" name="valid_from" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Valid Until</label><input type="date" name="valid_until" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Min. Booking Amount (₹)</label><input type="number" name="min_booking_amount" value="0" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Image URL</label><input type="url" name="image_url" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Banner Text</label><input type="text" name="banner_text" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Highlight Text</label><input type="text" name="highlight_text" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        </div>
        <div>
            <label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Countdown Ends At</label>
            <input type="datetime-local" name="countdown_ends_at" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600">
        </div>
        <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Description</label><textarea name="description" rows="3" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></textarea></div>
        <button type="submit" class="btn-luxury px-12 py-5">Create Offer</button>
    </form>
</div>
@endsection
