<x-dashboard-layout>
    <div class="space-y-16">
        <!-- Hero Welcome -->
        <div class="glass p-12 rounded-[4rem] border-white/5 relative overflow-hidden group" data-aos="fade-up">
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-600/10 rounded-full blur-[100px] group-hover:bg-blue-600/20 transition-all duration-1000"></div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div class="flex items-center space-x-8">
                    <div class="relative">
                        <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=3b82f6&color=fff&size=256' }}" class="w-24 h-24 rounded-[2rem] border-2 border-white/10 shadow-2xl object-cover" alt="{{ Auth::user()->name }}">
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center text-white border-2 border-slate-950">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-4xl font-black text-white uppercase tracking-tighter mb-2">Welcome Back, <span class="text-blue-600 italic">{{ Auth::user()->name }}</span></h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Passport Level: Gold Explorer</span>
                            <div class="w-px h-3 bg-white/10"></div>
                            <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">Indian Tourism Focus Active</span>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-64 space-y-4">
                    <div class="flex justify-between items-center px-2">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Expedition Readiness</span>
                        <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest">92%</span>
                    </div>
                    <div class="h-2 bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full" style="width: 92%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comprehensive Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="glass p-8 rounded-[3rem] border-white/5 hover:border-blue-600/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="0">
                <p class="text-slate-500 font-black uppercase tracking-widest text-[10px] mb-2">Total Bookings</p>
                <h3 class="text-4xl font-black text-white tracking-tighter">{{ $stats['total_bookings'] }}</h3>
            </div>
            <div class="glass p-8 rounded-[3rem] border-white/5 hover:border-emerald-600/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                <p class="text-slate-500 font-black uppercase tracking-widest text-[10px] mb-2">Total Investment</p>
                <h3 class="text-3xl font-black text-white tracking-tighter">₹{{ number_format($stats['total_spent']) }}</h3>
            </div>
            <div class="glass p-8 rounded-[3rem] border-white/5 hover:border-amber-600/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="200">
                <p class="text-slate-500 font-black uppercase tracking-widest text-[10px] mb-2">Pending Bookings</p>
                <h3 class="text-4xl font-black text-white tracking-tighter">{{ $stats['pending_bookings'] }}</h3>
            </div>
            <div class="glass p-8 rounded-[3rem] border-white/5 hover:border-purple-600/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="300">
                <p class="text-slate-500 font-black uppercase tracking-widest text-[10px] mb-2">Wishlist Items</p>
                <h3 class="text-4xl font-black text-white tracking-tighter">{{ $stats['wishlist_count'] }}</h3>
            </div>
            <div class="glass p-8 rounded-[3rem] border-white/5 hover:border-emerald-600/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="400">
                <p class="text-slate-500 font-black uppercase tracking-widest text-[10px] mb-2">Wallet Balance</p>
                <h3 class="text-3xl font-black text-white tracking-tighter">₹{{ number_format(Auth::user()->wallet_balance ?? 0) }}</h3>
            </div>
            <div class="glass p-8 rounded-[3rem] border-white/5 hover:border-blue-600/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="500">
                <p class="text-slate-500 font-black uppercase tracking-widest text-[10px] mb-2">Reward Points</p>
                <h3 class="text-3xl font-black text-white tracking-tighter">{{ number_format(Auth::user()->reward_points ?? 0) }}</h3>
            </div>
        </div>

        <!-- Breakdown & Upcoming -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Breakdown -->
            <div class="glass p-10 rounded-[3.5rem] border-white/5 shadow-2xl" data-aos="fade-right">
                <h3 class="text-xl font-black text-white uppercase tracking-tighter mb-8">Booking <span class="text-blue-600 italic">Breakdown</span></h3>
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-indigo-600/20 text-indigo-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <span class="text-xs font-black text-white uppercase tracking-widest">Hotels</span>
                        </div>
                        <span class="text-lg font-black text-indigo-400">{{ $stats['hotel_bookings'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-emerald-600/20 text-emerald-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                            </div>
                            <span class="text-xs font-black text-white uppercase tracking-widest">Packages</span>
                        </div>
                        <span class="text-lg font-black text-emerald-400">{{ $stats['package_bookings'] }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-rose-600/20 text-rose-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <span class="text-xs font-black text-white uppercase tracking-widest">Destinations</span>
                        </div>
                        <span class="text-lg font-black text-rose-400">{{ $stats['destination_bookings'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Upcoming Trips -->
            <div class="lg:col-span-2 glass rounded-[3.5rem] border-white/5 overflow-hidden shadow-2xl" data-aos="fade-left">
                <div class="p-10 border-b border-white/5">
                    <h3 class="text-xl font-black text-white uppercase tracking-tighter">Upcoming <span class="text-emerald-600 italic">Trips</span></h3>
                </div>
                <div class="p-8 space-y-6">
                    @forelse($upcomingTrips as $trip)
                    <div class="bg-white/5 rounded-3xl p-6 border border-white/10 flex flex-col sm:flex-row items-center gap-6 group hover:bg-white/10 transition-colors">
                        <div class="w-full sm:w-32 h-24 rounded-2xl overflow-hidden shrink-0">
                            @if(isset($trip->bookable->image_url))
                                <img src="{{ $trip->bookable->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="">
                            @else
                                <div class="w-full h-full bg-slate-800 flex items-center justify-center">N/A</div>
                            @endif
                        </div>
                        <div class="flex-grow text-center sm:text-left">
                            <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">{{ \Carbon\Carbon::parse($trip->start_date)->diffForHumans() }}</span>
                            <h4 class="text-xl font-black text-white uppercase tracking-tighter mt-1 mb-2">{{ $trip->bookable->name }}</h4>
                            <p class="text-xs font-bold text-slate-400">{{ \Carbon\Carbon::parse($trip->start_date)->format('M d, Y') }} • {{ $trip->travelers }} {{ Str::plural('Traveler', $trip->travelers) }}</p>
                        </div>
                        <div>
                            <a href="{{ route('bookings.show', $trip) }}" class="btn-luxury py-3 px-6 text-[10px]">View Details</a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10 text-slate-500 font-bold italic">No upcoming trips confirmed yet. Book your next adventure!</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Activity & History -->
        <div class="glass rounded-[3.5rem] border-white/5 overflow-hidden shadow-2xl" data-aos="fade-up">
            <div class="p-12 border-b border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <h3 class="text-2xl font-black text-white uppercase tracking-tighter">Booking <span class="text-blue-600 italic">History</span></h3>
                <a href="{{ route('bookings.index') }}" class="text-[10px] font-black text-slate-500 hover:text-white uppercase tracking-widest transition-colors flex items-center">View All History <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/2">
                            <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Gateway</th>
                            <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Details</th>
                            <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Status</th>
                            <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Investment</th>
                            <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Invoice</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($recentBookings as $booking)
                        @if($booking->bookable)
                        <tr class="group hover:bg-white/2 transition-colors">
                            <td class="px-12 py-8">
                                <div class="flex items-center space-x-6">
                                    <div class="w-16 h-12 rounded-xl overflow-hidden shadow-lg border border-white/10 shrink-0">
                                        <img src="{{ $booking->bookable->image_url ?? '' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="">
                                    </div>
                                    <div>
                                        <p class="font-black text-white text-sm uppercase tracking-tighter">{{ $booking->bookable->name }}</p>
                                        <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest">{{ class_basename($booking->bookable_type) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-12 py-8">
                                <p class="text-xs font-bold text-slate-300">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</p>
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-1">Ref: {{ $booking->booking_reference }}</p>
                            </td>
                            <td class="px-12 py-8">
                                <span class="px-4 py-1.5 {{ $booking->status === 'confirmed' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : ($booking->status === 'cancelled' ? 'bg-rose-500/10 text-rose-500 border-rose-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20') }} text-[9px] font-black rounded-full uppercase tracking-widest border">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="px-12 py-8 text-right">
                                <p class="text-lg font-black text-white tracking-tighter">₹{{ number_format($booking->total_price) }}</p>
                            </td>
                            <td class="px-12 py-8 text-right">
                                @if($booking->invoice)
                                <a href="{{ route('bookings.invoice', $booking) }}" class="inline-flex items-center text-[9px] font-black text-blue-500 hover:text-white uppercase tracking-widest transition-colors" target="_blank" title="Download PDF Invoice">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    PDF
                                </a>
                                @else
                                <span class="text-[9px] font-black text-slate-600 uppercase tracking-widest">N/A</span>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td colspan="5" class="px-12 py-24 text-center text-slate-500 font-bold italic">No expeditions recorded. Time for a new adventure?</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Notifications & Recently Viewed -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="glass p-10 rounded-[3.5rem] border-white/5" data-aos="fade-up">
                <h3 class="text-xl font-black text-white uppercase tracking-tighter mb-8">Latest <span class="text-blue-600 italic">Notifications</span></h3>
                <div class="space-y-4">
                    @forelse($recentNotifications as $notification)
                        <div class="bg-white/5 rounded-2xl p-4 border border-white/5">
                            <p class="text-xs font-black text-white uppercase tracking-widest">{{ str_replace('_', ' ', $notification->type) }}</p>
                            <p class="text-[10px] text-slate-500">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p class="text-slate-500 text-sm">No notifications yet.</p>
                    @endforelse
                </div>
                <a href="{{ route('notifications.index') }}" class="btn-luxury w-full mt-6 py-3 text-[10px]">View All Notifications</a>
            </div>

            <div class="glass p-10 rounded-[3.5rem] border-white/5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-xl font-black text-white uppercase tracking-tighter mb-8">Recently <span class="text-emerald-500 italic">Viewed</span></h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <p class="text-slate-500 text-sm">No recently viewed items yet.</p>
                </div>
            </div>
        </div>

        <!-- Referrals & Wallet Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="glass p-10 rounded-[3.5rem] border-white/5" data-aos="fade-up">
                <h3 class="text-xl font-black text-white uppercase tracking-tighter mb-8">Referral <span class="text-amber-500 italic">Rewards</span></h3>
                <p class="text-xs text-slate-400 mb-4">Share your code to earn bonus points.</p>
                <div class="glass p-6 rounded-2xl border-white/5 mb-6">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Your Code</p>
                    <p class="text-2xl font-black text-white">{{ Auth::user()->referral_code ?? 'TRV-XXXXXX' }}</p>
                </div>
                <p class="text-xs text-slate-400">Total Referrals: <span class="text-white font-black">0</span></p>
            </div>

            <div class="glass p-10 rounded-[3.5rem] border-white/5" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-xl font-black text-white uppercase tracking-tighter mb-8">Wallet <span class="text-emerald-500 italic">Activity</span></h3>
                <div class="space-y-4">
                    <p class="text-slate-500 text-sm">No wallet activity yet.</p>
                </div>
            </div>
        </div>

    </div>
</x-dashboard-layout>
