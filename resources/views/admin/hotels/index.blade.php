@extends('layouts.admin')
@section('header', 'Luxury Stays')
@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6" data-aos="fade-down">
        <div>
            <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Luxury <span class="text-amber-500 italic">Stays</span></h2>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-2">{{ $hotels->total() }} properties in system</p>
        </div>
        <a href="{{ route('admin.hotels.create') }}" class="btn-luxury py-3 px-8 text-xs">+ Add Hotel</a>
    </div>

    @if(session('success'))
        <div class="glass p-6 rounded-2xl border-emerald-500/20 text-emerald-400 font-bold text-sm">{{ session('success') }}</div>
    @endif

    <div class="glass rounded-[3rem] border-white/5 overflow-hidden shadow-2xl" data-aos="fade-up">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/2 border-b border-white/5">
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Hotel</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Destination</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Type</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Price/Night</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Rating</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Status</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($hotels as $h)
                    <tr class="group hover:bg-white/2 transition-colors">
                        <td class="px-10 py-8">
                            <div class="flex items-center space-x-4">
                                <div class="w-14 h-10 rounded-xl overflow-hidden border border-white/10 shrink-0">
                                    <img src="{{ $h->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="" onerror="this.src='https://via.placeholder.com/150'">
                                </div>
                                <span class="text-sm font-black text-white">{{ Str::limit($h->name, 28) }}</span>
                            </div>
                        </td>
                        <td class="px-10 py-8 text-xs text-slate-400 font-medium">{{ $h->destination->name ?? '—' }}</td>
                        <td class="px-10 py-8">
                            <span class="px-3 py-1.5 glass rounded-xl text-[9px] font-black text-amber-400 uppercase tracking-widest border border-amber-400/20">{{ $h->type }}</span>
                        </td>
                        <td class="px-10 py-8">
                            <span class="text-base font-black text-white tracking-tighter">₹{{ number_format($h->price_per_night) }}</span>
                            <span class="text-[9px] text-slate-500 ml-1">/night</span>
                        </td>
                        <td class="px-10 py-8">
                            <span class="text-amber-500 font-black">{{ $h->rating }}</span>
                            <span class="text-amber-500">★</span>
                        </td>
                        <td class="px-10 py-8">
                            @if($h->status === 'active')
                                <span class="px-3 py-1.5 text-[9px] font-black rounded-full uppercase tracking-widest bg-emerald-500/10 text-emerald-500 border border-emerald-500/20">Active</span>
                            @else
                                <span class="px-3 py-1.5 text-[9px] font-black rounded-full uppercase tracking-widest bg-slate-500/10 text-slate-400 border border-slate-500/20">Hidden</span>
                            @endif
                        </td>
                        <td class="px-10 py-8 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.hotels.edit', $h) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-blue-600/10 text-blue-500 hover:bg-blue-600 hover:text-white transition-all" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.hotels.destroy', $h) }}" method="POST" class="inline" onsubmit="return confirm('Delete this hotel?')">
                                    @csrf @method('DELETE')
                                    <button class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-rose-600/10 text-rose-500 hover:bg-rose-600 hover:text-white transition-all" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-12 py-24 text-center text-slate-500 font-bold italic">No hotels added yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="pt-4">{{ $hotels->links() }}</div>
</div>
@endsection

