<x-admin-layout>
    <div class="space-y-12">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8" data-aos="fade-down">
            <div>
                <a href="{{ route('admin.users.index') }}" class="text-[10px] font-black text-blue-500 uppercase tracking-widest hover:text-blue-400 flex items-center mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Directory
                </a>
                <h1 class="text-4xl font-black text-white uppercase tracking-tighter">Traveler <span class="text-blue-600 italic">Dossier</span></h1>
            </div>
            <div class="flex space-x-4">
                <button class="btn-luxury py-3 px-6 text-xs bg-rose-600/20 text-rose-400 hover:bg-rose-600 hover:text-white">Suspend Account</button>
            </div>
        </div>

        <!-- Profile Hero -->
        <div class="glass p-12 rounded-[4rem] border-white/5 relative overflow-hidden" data-aos="zoom-in">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px]"></div>
            
            <div class="flex flex-col md:flex-row gap-8 items-center md:items-start relative z-10">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1e293b&color=3b82f6&size=150" class="w-32 h-32 rounded-3xl shadow-2xl" alt="">
                <div class="flex-grow text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start space-x-4 mb-2">
                        <h2 class="text-3xl font-black text-white tracking-tighter">{{ $user->name }}</h2>
                        <span class="bg-blue-600/20 text-blue-400 text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full">Member</span>
                    </div>
                    <p class="text-slate-400 font-medium mb-6">{{ $user->email }} • Joined {{ $user->created_at->format('M d, Y') }}</p>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mt-6">
                        <div class="glass p-5 rounded-2xl border-white/5 text-center">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Total</p>
                            <p class="text-2xl font-black text-white">{{ $stats['total_bookings'] }}</p>
                        </div>
                        <div class="glass p-5 rounded-2xl border-emerald-500/10 text-center">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Confirmed</p>
                            <p class="text-2xl font-black text-emerald-400">{{ $stats['confirmed_bookings'] }}</p>
                        </div>
                        <div class="glass p-5 rounded-2xl border-blue-500/10 text-center">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Spent</p>
                            <p class="text-xl font-black text-blue-400">₹{{ number_format($stats['total_spent']) }}</p>
                        </div>
                        <div class="glass p-5 rounded-2xl border-amber-500/10 text-center">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Pending</p>
                            <p class="text-2xl font-black text-amber-400">{{ $stats['pending_bookings'] }}</p>
                        </div>
                        <div class="glass p-5 rounded-2xl border-rose-500/10 text-center">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Cancelled</p>
                            <p class="text-2xl font-black text-rose-400">{{ $stats['cancelled_bookings'] }}</p>
                        </div>
                        <div class="glass p-5 rounded-2xl border-purple-500/10 text-center">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Wishlist</p>
                            <p class="text-2xl font-black text-purple-400">{{ $stats['wishlist_count'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking History -->
        <div class="glass p-12 rounded-[4rem] border-white/5" data-aos="fade-up">
            <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-8">Booking <span class="text-emerald-600 italic">Timeline</span></h3>
            
            <div class="space-y-6">
                @forelse($user->bookings as $booking)
                <div class="bg-white/2 hover:bg-white/5 border border-white/5 rounded-3xl p-6 transition-all">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                        <!-- Info -->
                        <div class="flex items-start space-x-6">
                            <div class="w-16 h-16 rounded-2xl overflow-hidden shrink-0">
                                @if(isset($booking->bookable->image_url))
                                    <img src="{{ $booking->bookable->image_url }}" class="w-full h-full object-cover" alt="">
                                @else
                                    <div class="w-full h-full bg-slate-800 flex items-center justify-center text-slate-500 font-bold">N/A</div>
                                @endif
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-1">{{ class_basename($booking->bookable_type) }} • Ref: {{ $booking->booking_reference }}</p>
                                <h4 class="text-xl font-black text-white uppercase tracking-tighter mb-2">{{ $booking->bookable->name ?? 'Unknown' }}</h4>
                                <p class="text-xs text-slate-400 font-medium">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }} • {{ $booking->travelers }} {{ Str::plural('Traveler', $booking->travelers) }}</p>
                            </div>
                        </div>

                        <!-- Status & Actions -->
                        <div class="flex flex-col items-end gap-4 min-w-[200px]">
                            <div class="flex items-center space-x-4">
                                <p class="text-xl font-black text-white tracking-tighter">₹{{ number_format($booking->total_price) }}</p>
                                <span class="text-[9px] font-black {{ $booking->status === 'confirmed' ? 'text-emerald-500 bg-emerald-500/10' : ($booking->status === 'cancelled' ? 'text-rose-500 bg-rose-500/10' : 'text-amber-500 bg-amber-500/10') }} px-3 py-1.5 rounded-full uppercase tracking-widest border border-current">
                                    {{ $booking->status }}
                                </span>
                            </div>

                            <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking) }}" class="flex items-center space-x-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="bg-slate-900 border border-white/10 text-white text-xs font-bold rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full py-2 px-3" onchange="this.form.submit()">
                                    <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                            
                            @if($booking->invoice)
                            <a href="{{ route('bookings.invoice', $booking) }}" target="_blank" class="text-[10px] font-black text-blue-500 hover:text-blue-400 uppercase tracking-widest flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                View Invoice
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-500">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <p class="text-slate-400 font-bold">No bookings recorded for this traveler yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>
