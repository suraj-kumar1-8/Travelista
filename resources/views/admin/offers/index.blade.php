@extends('layouts.admin')
@section('header', 'Travel Offers')
@section('content')
<div class="space-y-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6" data-aos="fade-down">
        <div>
            <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Travel <span class="text-emerald-500 italic">Offers</span></h2>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-2">{{ $offers->total() }} promotional offers</p>
        </div>
        <a href="{{ route('admin.offers.create') }}" class="btn-luxury py-3 px-8 text-xs">+ Add Offer</a>
    </div>

    @if(session('success'))
        <div class="glass p-6 rounded-2xl border-emerald-500/20 text-emerald-400 font-bold text-sm">{{ session('success') }}</div>
    @endif

    <!-- Table -->
    <div class="glass rounded-[3rem] border-white/5 overflow-hidden shadow-2xl" data-aos="fade-up">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/2 border-b border-white/5">
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Offer</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Code</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Discount</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Valid Period</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Status</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($offers as $offer)
                    <tr class="group hover:bg-white/2 transition-colors">
                        <td class="px-10 py-8">
                            <p class="text-sm font-black text-white">{{ $offer->title }}</p>
                            @if($offer->description)
                                <p class="text-[9px] text-slate-500 mt-0.5">{{ Str::limit($offer->description, 40) }}</p>
                            @endif
                        </td>
                        <td class="px-10 py-8">
                            <span class="px-4 py-1.5 glass rounded-xl text-[9px] font-black text-blue-400 uppercase tracking-[0.2em] border border-blue-400/20">{{ $offer->code }}</span>
                        </td>
                        <td class="px-10 py-8">
                            <span class="text-lg font-black text-emerald-400">
                                {{ $offer->discount_type === 'percentage' ? $offer->discount_value.'%' : '₹'.number_format($offer->discount_value) }}
                            </span>
                            <span class="text-[9px] text-slate-500 ml-1 uppercase tracking-widest">off</span>
                        </td>
                        <td class="px-10 py-8">
                            <p class="text-xs font-bold text-white">{{ $offer->valid_from->format('d M Y') }}</p>
                            <p class="text-[9px] text-slate-500 mt-0.5">→ {{ $offer->valid_until->format('d M Y') }}</p>
                        </td>
                        <td class="px-10 py-8">
                            @if($offer->isValid())
                                <span class="px-3 py-1.5 text-[9px] font-black rounded-full uppercase tracking-widest bg-emerald-500/10 text-emerald-500 border border-emerald-500/20">Active</span>
                            @else
                                <span class="px-3 py-1.5 text-[9px] font-black rounded-full uppercase tracking-widest bg-rose-500/10 text-rose-500 border border-rose-500/20">Expired</span>
                            @endif
                        </td>
                        <td class="px-10 py-8 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.offers.edit', $offer) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-blue-600/10 text-blue-500 hover:bg-blue-600 hover:text-white transition-all" title="Edit Offer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.offers.destroy', $offer) }}" method="POST" class="inline" onsubmit="return confirm('Delete this offer?')">
                                    @csrf @method('DELETE')
                                    <button class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-rose-600/10 text-rose-500 hover:bg-rose-600 hover:text-white transition-all" title="Delete Offer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-12 py-24 text-center text-slate-500 font-bold italic">No offers created yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="pt-4">{{ $offers->links() }}</div>
</div>
@endsection

