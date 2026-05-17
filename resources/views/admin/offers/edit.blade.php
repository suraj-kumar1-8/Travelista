@extends('layouts.admin')
@section('header', 'Edit Offer')
@section('content')
<div class="max-w-3xl">
    <form action="{{ route('admin.offers.update', $offer) }}" method="POST" class="glass p-12 rounded-[3rem] border-white/5 space-y-8">
        @csrf @method('PUT')
        @if($errors->any())<div class="p-4 rounded-xl bg-rose-500/10 text-rose-400 text-sm">{{ $errors->first() }}</div>@endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Offer Title</label><input type="text" name="title" value="{{ $offer->title }}" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Coupon Code (Read Only)</label><input type="text" value="{{ $offer->code }}" readonly class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-slate-400 font-bold focus:ring-0 opacity-50 cursor-not-allowed"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Discount Type</label>
            <select name="discount_type" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600">
                <option value="percentage" {{ $offer->discount_type == 'percentage' ? 'selected' : '' }} class="bg-slate-900">Percentage (%)</option>
                <option value="fixed" {{ $offer->discount_type == 'fixed' ? 'selected' : '' }} class="bg-slate-900">Fixed Amount (₹)</option>
            </select></div>
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Discount Value</label><input type="number" step="0.01" name="discount_value" value="{{ $offer->discount_value }}" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Valid From</label><input type="date" name="valid_from" value="{{ $offer->valid_from->format('Y-m-d') }}" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Valid Until</label><input type="date" name="valid_until" value="{{ $offer->valid_until->format('Y-m-d') }}" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Min. Booking Amount (₹)</label><input type="number" name="min_booking_amount" value="{{ $offer->min_booking_amount }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Status</label>
            <select name="is_active" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600">
                <option value="1" {{ $offer->is_active ? 'selected' : '' }} class="bg-slate-900">Active</option>
                <option value="0" {{ !$offer->is_active ? 'selected' : '' }} class="bg-slate-900">Inactive</option>
            </select></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Banner Text</label><input type="text" name="banner_text" value="{{ $offer->banner_text }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
            <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Highlight Text</label><input type="text" name="highlight_text" value="{{ $offer->highlight_text }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        </div>
        <div>
            <label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Countdown Ends At</label>
            <input type="datetime-local" name="countdown_ends_at" value="{{ $offer->countdown_ends_at ? $offer->countdown_ends_at->format('Y-m-d\TH:i') : '' }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600">
        </div>
        <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Image URL</label><input type="url" name="image_url" value="{{ $offer->image_url }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Description</label><textarea name="description" rows="3" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600">{{ $offer->description }}</textarea></div>
        <button type="submit" class="btn-luxury px-12 py-5">Update Offer</button>
    </form>
</div>
@endsection
