<x-app-layout>
    <div class="min-h-screen bg-slate-950 py-32 px-4 relative overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-purple-600/10 rounded-full blur-[120px]"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <!-- Profile Header Card -->
            <div class="glass p-16 rounded-[4rem] border-white/5 mb-16 text-center md:text-left flex flex-col md:flex-row items-center gap-12" data-aos="fade-up">
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=3b82f6&color=fff&size=512" class="w-48 h-48 rounded-[3.5rem] border-4 border-white/10 shadow-2xl" alt="">
                    <div class="absolute -bottom-4 -right-4 w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white border-4 border-slate-950 shadow-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                </div>
                <div class="flex-grow space-y-6">
                    <div>
                        <h1 class="text-6xl font-black text-white uppercase tracking-tighter mb-2">{{ Auth::user()->name }}</h1>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ Auth::user()->email }} • Member since {{ Auth::user()->created_at->format('M Y') }}</p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <span class="px-5 py-2 glass rounded-2xl text-[10px] font-black text-blue-500 uppercase tracking-widest border border-blue-500/20">Elite Explorer</span>
                        <span class="px-5 py-2 glass rounded-2xl text-[10px] font-black text-emerald-500 uppercase tracking-widest border border-emerald-500/20">Verified Identity</span>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 w-full md:w-auto">
                    <div class="glass p-8 rounded-3xl text-center border-white/5">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Expeditions</p>
                        <p class="text-3xl font-black text-white tracking-tighter">{{ Auth::user()->bookings()->count() }}</p>
                    </div>
                    <div class="glass p-8 rounded-3xl text-center border-white/5">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Points</p>
                        <p class="text-3xl font-black text-blue-600 tracking-tighter">4.2K</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <!-- Management Forms -->
                <div class="lg:col-span-1 space-y-12">
                    <div class="glass p-12 rounded-[4rem] border-white/5" data-aos="fade-right">
                        <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-10">Identity <span class="text-blue-600 italic">Settings</span></h3>
                        <div class="space-y-12">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="glass p-12 rounded-[4rem] border-white/5" data-aos="fade-right" data-aos-delay="100">
                        <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-10">Access <span class="text-purple-600 italic">Security</span></h3>
                        <div class="space-y-12">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Personal Statistics & Activity -->
                <div class="lg:col-span-2 space-y-12">
                    <!-- Stats Card -->
                    <div class="glass p-12 rounded-[4rem] border-white/5 bg-gradient-to-br from-blue-600/5 to-purple-600/5" data-aos="fade-left">
                        <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-12">Explorer <span class="text-blue-600 italic">Insight</span></h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                            @foreach([
                                ['label' => 'Total Investment', 'value' => '₹' . number_format(Auth::user()->bookings()->sum('total_price'))],
                                ['label' => 'States Explored', 'value' => '12'],
                                ['label' => 'Active Wishlist', 'value' => Auth::user()->wishlists()->count()]
                            ] as $stat)
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">{{ $stat['label'] }}</p>
                                <p class="text-4xl font-black text-white tracking-tighter">{{ $stat['value'] }}</p>
                                <div class="mt-4 h-1.5 w-full bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-blue-600 w-2/3"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recent Payment History -->
                    <div class="glass rounded-[4rem] border-white/5 overflow-hidden" data-aos="fade-up">
                        <div class="p-12 border-b border-white/5">
                            <h3 class="text-2xl font-black text-white uppercase tracking-tighter">Transaction <span class="text-emerald-600 italic">Ledger</span></h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-white/2">
                                    <tr>
                                        <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">ID</th>
                                        <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Date</th>
                                        <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Gateway</th>
                                        <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Investment</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-white/5">
                                    @foreach(Auth::user()->bookings()->latest()->take(5)->get() as $booking)
                                    <tr class="group hover:bg-white/2 transition-colors">
                                        <td class="px-12 py-8 text-[10px] font-black text-slate-500 tracking-widest uppercase">{{ $booking->booking_reference }}</td>
                                        <td class="px-12 py-8 text-[10px] font-black text-white uppercase tracking-widest">{{ $booking->created_at->format('M d, Y') }}</td>
                                        <td class="px-12 py-8 text-[10px] font-black text-blue-500 uppercase tracking-widest">{{ $booking->bookable->name }}</td>
                                        <td class="px-12 py-8 text-right text-lg font-black text-white tracking-tighter">₹{{ number_format($booking->total_price) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
