@extends('layouts.admin')
@section('header', 'Reservation Ledger')
@section('content')
<div class="space-y-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6" data-aos="fade-down">
        <div>
            <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Reservation <span class="text-emerald-500 italic">Ledger</span></h2>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-2">{{ $bookings->total() }} total bookings</p>
        </div>
        <!-- Filters -->
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="flex flex-wrap items-center gap-4">
            <div class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"></path></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search user or ref..." class="bg-slate-900 border border-white/10 text-white text-sm font-bold rounded-2xl pl-12 pr-6 py-3 focus:ring-2 focus:ring-blue-600 w-56">
            </div>
            <select name="status" class="bg-slate-900 border border-white/10 text-white text-sm font-bold rounded-2xl px-6 py-3 focus:ring-2 focus:ring-blue-600">
                <option value="">All Statuses</option>
                @foreach(['pending', 'confirmed', 'completed', 'cancelled'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }} class="bg-slate-900">{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-luxury py-3 px-6 text-xs">Filter</button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.bookings.index') }}" class="text-[10px] font-black text-slate-500 hover:text-white uppercase tracking-widest transition-colors">Clear</a>
            @endif
        </form>
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
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Reference</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">User</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Booking Item</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Travel Date</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Amount</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Status</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($bookings as $booking)
                    <tr class="group hover:bg-white/2 transition-colors">
                        <td class="px-10 py-8">
                            <span class="px-4 py-1.5 glass rounded-xl text-[9px] font-black text-slate-400 uppercase tracking-widest border border-white/5">{{ $booking->booking_reference }}</span>
                        </td>
                        <td class="px-10 py-8">
                            @if($booking->user)
                            <a href="{{ route('admin.users.show', $booking->user) }}" class="flex items-center space-x-3 group/link">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->user->name) }}&background=1e293b&color=3b82f6" class="w-9 h-9 rounded-xl border border-white/10" alt="">
                                <span class="text-sm font-black text-white group-hover/link:text-blue-400 transition-colors">{{ $booking->user->name }}</span>
                            </a>
                            @else
                                <span class="text-xs text-slate-500 italic">Deleted User</span>
                            @endif
                        </td>
                        <td class="px-10 py-8">
                            <div>
                                <p class="text-sm font-black text-white">{{ Str::limit($booking->bookable->name ?? 'Deleted Item', 28) }}</p>
                                <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest">{{ class_basename($booking->bookable_type) }}</span>
                            </div>
                        </td>
                        <td class="px-10 py-8">
                            <p class="text-xs font-bold text-white">{{ \Carbon\Carbon::parse($booking->start_date)->format('d M, Y') }}</p>
                            @if($booking->end_date)
                                <p class="text-[9px] text-slate-500 mt-0.5">→ {{ \Carbon\Carbon::parse($booking->end_date)->format('d M, Y') }}</p>
                            @endif
                        </td>
                        <td class="px-10 py-8">
                            <p class="text-base font-black text-white tracking-tighter">₹{{ number_format($booking->total_price) }}</p>
                            <p class="text-[9px] text-slate-500 mt-0.5">{{ $booking->travelers }} {{ Str::plural('traveler', $booking->travelers) }}</p>
                        </td>
                        <td class="px-10 py-8">
                            @php
                                $badge = [
                                    'pending'   => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                    'confirmed' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                    'cancelled' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
                                    'completed' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                                ];
                            @endphp
                            <span class="px-3 py-1.5 text-[9px] font-black rounded-full uppercase tracking-widest border {{ $badge[$booking->status] ?? 'bg-slate-500/10 text-slate-400 border-slate-500/20' }}">{{ $booking->status }}</span>
                        </td>
                        <td class="px-10 py-8 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST" class="inline-flex">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="bg-slate-900 border border-white/10 rounded-xl px-3 py-2 text-[10px] font-black text-white uppercase tracking-widest focus:ring-0 cursor-pointer">
                                        @foreach(['pending', 'confirmed', 'completed', 'cancelled'] as $status)
                                            <option value="{{ $status }}" {{ $booking->status === $status ? 'selected' : '' }} class="bg-slate-900">{{ ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                </form>
                                @if($booking->invoice)
                                    <a href="{{ route('bookings.invoice', $booking) }}" target="_blank" class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-blue-600/10 text-blue-500 hover:bg-blue-600 hover:text-white transition-all" title="Download Invoice">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-12 py-24 text-center text-slate-500 font-bold italic">No bookings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="pt-4">{{ $bookings->links() }}</div>
</div>
@endsection

