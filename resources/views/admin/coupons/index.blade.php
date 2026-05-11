@extends('layouts.admin')

@section('header', 'Coupon Management')

@section('content')
<div class="space-y-12">
    <div class="flex items-center justify-between" data-aos="fade-down">
        <div>
            <h3 class="text-3xl font-black text-white uppercase tracking-tighter">Marketing <span class="text-blue-600 italic">Coupons</span></h3>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-2">{{ $coupons->total() }} total codes</p>
        </div>
        <a href="{{ route('admin.coupons.create') }}" class="btn-luxury py-3 px-8 text-xs">+ Create Coupon</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($coupons as $coupon)
        <div class="glass p-8 rounded-[2.5rem] border border-slate-800 shadow-xl relative overflow-hidden group hover:border-blue-600/30 transition-all duration-500" data-aos="fade-up">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-600/10 rounded-full blur-2xl group-hover:bg-blue-600/20 transition-all"></div>
            
            <div class="flex items-center justify-between mb-8">
                <div class="px-5 py-2 bg-slate-800 border border-slate-700 rounded-2xl">
                    <span class="text-lg font-black text-white tracking-[0.2em] uppercase">{{ $coupon->code }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="w-2 h-2 {{ $coupon->is_active ? 'bg-emerald-500 shadow-[0_0_8px_#10b981]' : 'bg-rose-500' }} rounded-full"></span>
                    <span class="text-[10px] font-black {{ $coupon->is_active ? 'text-emerald-400' : 'text-rose-400' }} uppercase tracking-widest">{{ $coupon->is_active ? 'Active' : 'Inactive' }}</span>
                </div>
            </div>

            <div class="space-y-4 mb-8">
                <div>
                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-1">Discount Value</p>
                    <h4 class="text-4xl font-black tracking-tighter {{ $coupon->discount_percentage ? 'text-emerald-400' : 'text-blue-400' }}">
                        @if($coupon->discount_percentage)
                            {{ $coupon->discount_percentage }}% <span class="text-xl text-white">OFF</span>
                        @else
                            ₹{{ number_format($coupon->discount_amount) }} <span class="text-xl text-white">OFF</span>
                        @endif
                    </h4>
                </div>
                <div>
                    <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-1">Expiry</p>
                    <p class="text-sm font-bold {{ $coupon->expires_at && \Carbon\Carbon::parse($coupon->expires_at)->isPast() ? 'text-rose-400' : 'text-slate-300' }}">
                        {{ $coupon->expires_at ? \Carbon\Carbon::parse($coupon->expires_at)->format('M d, Y') : 'No Expiry' }}
                        @if($coupon->expires_at && \Carbon\Carbon::parse($coupon->expires_at)->isPast())
                            <span class="text-[9px] font-black text-rose-500 uppercase tracking-widest ml-1">(Expired)</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-slate-800">
                <a href="{{ route('admin.coupons.edit', $coupon) }}" class="text-xs font-black text-blue-500 hover:text-blue-400 uppercase tracking-widest transition-colors flex items-center gap-2">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit
                </a>
                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Delete this coupon?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-xs font-black text-rose-500 hover:text-rose-400 uppercase tracking-widest transition-colors flex items-center gap-2">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    @if($coupons->isEmpty())
    <div class="text-center py-24 glass rounded-[3rem] border border-slate-800" data-aos="fade-up">
        <div class="w-20 h-20 bg-slate-900 text-slate-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
        </div>
        <h3 class="text-xl font-bold text-white mb-2">No coupons yet</h3>
        <p class="text-slate-500 max-w-sm mx-auto">Create promotional codes to boost your bookings and reward your travelers.</p>
    </div>
    @endif
</div>
@endsection
