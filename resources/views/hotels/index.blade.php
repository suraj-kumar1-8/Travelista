<x-app-layout>
    <section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="">
            <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm"></div>
        </div>
        <div class="relative z-10 text-center px-4" data-aos="fade-up">
            <span class="inline-block px-6 py-2 glass rounded-full text-[10px] font-black uppercase tracking-[0.5em] text-amber-400 mb-8">Elite Accommodations</span>
            <h1 class="text-6xl md:text-8xl font-black text-white uppercase tracking-tighter leading-none mb-6">Indian <br> <span class="text-amber-500 italic">Sanctuaries</span></h1>
        </div>
    </section>

    <section class="py-24 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-16">
                <!-- Sidebar Filters -->
                <aside class="w-full lg:w-1/4" data-aos="fade-right">
                    <form action="{{ route('hotels.index') }}" method="GET" class="glass p-10 rounded-[3rem] border-white/5 sticky top-32 space-y-10">
                        <h3 class="text-xl font-black text-white uppercase tracking-tighter mb-6">Filter <span class="text-amber-500 italic">Stays</span></h3>

                        <!-- Search Box -->
                        <div class="space-y-4 mb-6">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block px-2">Search</label>
                            <div class="glass flex items-center p-2 rounded-2xl border border-white/10 focus-within:border-amber-500/50 transition-all bg-white/5">
                                <div class="pl-2 pr-2 text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Hotel name or location..." class="w-full bg-transparent border-none px-2 py-2 text-xs font-bold text-white placeholder-slate-500 focus:ring-0 outline-none">
                            </div>
                        </div>
                        <!-- Type Filter -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block px-2">Property Type</label>
                            <div class="space-y-3">
                                @foreach(['Resort', 'Villas', 'Budget', 'Luxury'] as $type)
                                <label class="flex items-center space-x-3 cursor-pointer group">
                                    <input type="radio" name="type" value="{{ $type }}" {{ request('type') === $type ? 'checked' : '' }} class="w-5 h-5 rounded-lg bg-white/5 border-none text-amber-500 focus:ring-amber-600">
                                    <span class="text-xs font-bold text-slate-400 group-hover:text-white transition-colors uppercase tracking-widest">{{ $type }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block px-2">Category</label>
                            <select name="category" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-sm font-bold text-white focus:ring-1 focus:ring-amber-600">
                                <option value="" class="bg-slate-900">All</option>
                                @foreach(['Luxury', 'Budget', 'Premium', 'Boutique'] as $cat)
                                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }} class="bg-slate-900">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block px-2">Max Price/Night (₹)</label>
                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="e.g. 20000" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-sm font-bold text-white placeholder-slate-600 focus:ring-1 focus:ring-amber-600">
                        </div>

                        <!-- Rating -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block px-2">Min Rating</label>
                            <div class="space-y-3">
                                @foreach([5, 4, 3] as $star)
                                <label class="flex items-center space-x-3 cursor-pointer group">
                                    <input type="radio" name="rating" value="{{ $star }}" {{ request('rating') == $star ? 'checked' : '' }} class="w-5 h-5 rounded-lg bg-white/5 border-none text-amber-500 focus:ring-amber-600">
                                    <div class="flex text-amber-500">
                                        @for($i=0; $i<$star; $i++)
                                        <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @endfor
                                    </div>
                                    <span class="text-xs font-bold text-slate-400 uppercase">& Up</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn-luxury w-full py-5 !bg-amber-600 hover:!bg-amber-500 shadow-amber-600/20">Apply Filters</button>
                        <a href="{{ route('hotels.index') }}" class="block text-center text-[10px] font-black text-slate-500 uppercase tracking-widest hover:text-white transition-colors mt-4">Clear All</a>
                    </form>
                </aside>

                <!-- Hotel Grid -->
                <main class="w-full lg:w-3/4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        @forelse($hotels as $hotel)
                        <a href="{{ route('hotels.show', $hotel->slug) }}" class="glass group rounded-[2.5rem] overflow-hidden border-white/5 transition-all duration-700 hover:-translate-y-2 hover:border-amber-500/30 flex flex-col h-full" data-aos="fade-up">
                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ $hotel->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="{{ $hotel->name }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=1000'">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-80"></div>
                                <div class="absolute top-4 right-4 flex items-center space-x-2 glass px-3 py-1.5 rounded-xl shadow-lg">
                                    <svg class="w-3 h-3 text-amber-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span class="text-[10px] font-black text-white">{{ $hotel->rating }}.0</span>
                                </div>
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 glass rounded-xl text-[8px] font-black text-amber-400 uppercase tracking-widest border border-amber-400/20 shadow-lg">{{ $hotel->type }}</span>
                                </div>
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-1">{{ $hotel->destination->name ?? '' }} • {{ $hotel->category }}</p>
                                <h3 class="text-xl font-black text-white uppercase tracking-tighter mb-2 group-hover:text-amber-500 transition-colors">{{ $hotel->name }}</h3>
                                <p class="text-slate-400 text-[11px] font-medium line-clamp-2 mb-4 flex-grow">{{ $hotel->description }}</p>
                                
                                <!-- Amenities Mini-Icons -->
                                <div class="flex items-center space-x-3 mb-6">
                                    <div class="flex items-center text-slate-500" title="High-Speed Wi-Fi">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                                    </div>
                                    <div class="flex items-center text-slate-500" title="Luxury Pool">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                                    </div>
                                    <div class="flex items-center text-slate-500" title="Spa & Wellness">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-5 border-t border-white/5">
                                    <div>
                                        <p class="text-[8px] font-black text-slate-500 uppercase tracking-widest">Per Night</p>
                                        <p class="text-xl font-black text-white tracking-tighter">₹{{ number_format($hotel->price_per_night) }}</p>
                                    </div>
                                    <span class="btn-luxury px-6 py-2.5 !text-[9px] shadow-lg shadow-amber-500/10">View Details</span>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="col-span-2 text-center py-24">
                            <p class="text-2xl text-slate-500 font-bold">No hotels found matching your criteria.</p>
                            <a href="{{ route('hotels.index') }}" class="btn-luxury px-8 py-4 mt-8 inline-block">View All Hotels</a>
                        </div>
                        @endforelse
                    </div>
                    <div class="pt-16">{{ $hotels->appends(request()->query())->links() }}</div>
                </main>
            </div>
        </div>
    </section>
</x-app-layout>
