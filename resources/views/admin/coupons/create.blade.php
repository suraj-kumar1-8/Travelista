@extends('layouts.admin')
@section('header', 'Create Coupon')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8" data-aos="fade-down">
        <a href="{{ route('admin.coupons.index') }}" class="text-[10px] font-black text-blue-500 uppercase tracking-widest hover:text-blue-400 flex items-center mb-6">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Coupons
        </a>
        <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Create <span class="text-blue-600 italic">Coupon</span></h2>
        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-2">Generate a new promotional discount code</p>
    </div>

    <form action="{{ route('admin.coupons.store') }}" method="POST" class="glass p-12 rounded-[3rem] border-white/5 space-y-8" data-aos="fade-up">
        @csrf

        @if($errors->any())
            <div class="p-6 rounded-2xl bg-rose-500/10 text-rose-400 text-sm font-bold border border-rose-500/20">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Coupon Code</label>
            <input type="text" name="code" value="{{ old('code') }}" placeholder="e.g. INDIA50" required
                class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-black text-xl tracking-widest uppercase focus:ring-2 focus:ring-blue-600 transition-all">
            <p class="text-[9px] text-slate-500 mt-2 ml-2">Code must be unique. Only letters, numbers, and hyphens.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Discount % (optional)</label>
                <div class="relative">
                    <input type="number" name="discount_percentage" value="{{ old('discount_percentage') }}" min="1" max="100" placeholder="e.g. 20"
                        class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all pr-12">
                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-500 font-black">%</span>
                </div>
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Fixed Amount Off ₹ (optional)</label>
                <div class="relative">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 font-black">₹</span>
                    <input type="number" name="discount_amount" value="{{ old('discount_amount') }}" min="0" placeholder="e.g. 500"
                        class="w-full bg-slate-900 border border-white/5 rounded-2xl pl-10 pr-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
                </div>
            </div>
        </div>

        <div>
            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Expiry Date (optional)</label>
            <input type="date" name="expires_at" value="{{ old('expires_at') }}" min="{{ date('Y-m-d') }}"
                class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
        </div>

        <div class="flex items-center justify-between glass p-6 rounded-2xl border-white/5">
            <div>
                <p class="text-sm font-black text-white">Activate Immediately</p>
                <p class="text-[9px] text-slate-500 mt-0.5">Coupon will be available for use right away</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1" checked class="sr-only peer">
                <div class="w-12 h-6 bg-slate-700 peer-focus:ring-2 peer-focus:ring-blue-600 rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            </label>
        </div>

        <div class="pt-4">
            <button type="submit" class="btn-luxury w-full py-6 text-sm">Create Coupon Code</button>
        </div>
    </form>
</div>
@endsection
