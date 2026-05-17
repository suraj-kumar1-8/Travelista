<x-dashboard-layout>
    <div class="space-y-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6" data-aos="fade-down">
            <h3 class="text-3xl font-black text-white uppercase tracking-tighter">My <span class="text-blue-600">Adventures</span></h3>
            <div class="flex items-center space-x-4">
                <div class="glass p-1.5 rounded-2xl flex items-center">
                    <button class="px-6 py-2 bg-blue-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-600/20">All</button>
                    <button class="px-6 py-2 text-slate-500 hover:text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Upcoming</button>
                    <button class="px-6 py-2 text-slate-500 hover:text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Past</button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-10">
            @forelse($bookings as $booking)
            @if($booking->bookable)
            <div class="glass p-10 rounded-[3.5rem] border-white/5 relative overflow-hidden group hover:border-blue-600/30 transition-all duration-500" data-aos="fade-up">
                <div class="flex flex-col lg:flex-row items-center gap-10">
                    <!-- Image -->
                    <div class="w-full lg:w-1/4 h-56 rounded-[2.5rem] overflow-hidden border border-white/10">
                        <img src="{{ $booking->bookable->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" alt="">
                    </div>

                    <!-- Details -->
                    <div class="flex-grow space-y-6">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-2 block">Reference: #{{ $booking->booking_reference }}</span>
                                <h4 class="text-3xl font-black text-white uppercase tracking-tighter">{{ $booking->bookable->name }}</h4>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-black text-white tracking-tighter">₹{{ number_format($booking->total_price) }}</p>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Total Amount</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 py-6 border-y border-white/5">
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Departure</p>
                                <p class="text-sm font-black text-white">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Travelers</p>
                                <p class="text-sm font-black text-white">{{ $booking->travelers }} Adults</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Status</p>
                                <span class="inline-flex px-3 py-1 {{ $booking->status === 'confirmed' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : ($booking->status === 'cancelled' ? 'bg-rose-500/10 text-rose-500 border-rose-500/20' : ($booking->status === 'completed' ? 'bg-blue-500/10 text-blue-500 border-blue-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20')) }} text-[10px] font-black rounded-full uppercase tracking-widest border">{{ $booking->status }}</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Type</p>
                                <span class="inline-flex px-3 py-1 bg-blue-500/10 text-blue-500 text-[10px] font-black rounded-full uppercase tracking-widest border border-blue-500/20">{{ class_basename($booking->bookable_type) }}</span>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-4">
                            <a href="{{ route('bookings.show', $booking->id) }}" class="px-8 py-3 bg-white/5 hover:bg-white/10 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all border border-white/5">View Details</a>
                            <a href="{{ route('bookings.invoice', $booking->id) }}" class="px-8 py-3 bg-white/5 hover:bg-white/10 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all border border-white/5 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Invoice
                            </a>
                            @if(in_array($booking->status, ['pending', 'confirmed']) && !$booking->cancellation_status)
                            <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="ml-auto">
                                @csrf
                                <input type="hidden" name="cancellation_reason" value="User requested cancellation">
                                <button type="submit" class="px-8 py-3 bg-rose-600/10 text-rose-500 hover:bg-rose-600 hover:text-white rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all border border-rose-500/20">Cancel Adventure</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @empty
            <div class="col-span-full py-32 text-center" data-aos="fade-up">
                <div class="w-24 h-24 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-4">No Adventures Found</h3>
                <p class="text-slate-500 mb-12 max-w-sm mx-auto font-medium">You haven't booked any adventures yet. Time to start exploring!</p>
                <a href="{{ route('destinations.index') }}" class="btn-luxury inline-block">Explore Gateways</a>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $bookings->links() }}
        </div>
    </div>
</x-dashboard-layout>
