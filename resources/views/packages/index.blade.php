<x-app-layout>
    <section class="relative h-[50vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="">
            <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm"></div>
        </div>
        <div class="relative z-10 text-center px-4" data-aos="fade-up">
            <span class="inline-block px-6 py-2 glass rounded-full text-[10px] font-black uppercase tracking-[0.5em] text-emerald-400 mb-8">Curated Expeditions</span>
            <h1 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter leading-none mb-6">Signature <br> <span class="text-emerald-500 italic">Journeys</span></h1>
        </div>
    </section>

    <section class="py-24 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-16">
                <!-- Sidebar Filters -->
                <aside class="w-full lg:w-1/4 space-y-10" data-aos="fade-right">
                    <form action="{{ route('packages.index') }}" method="GET" class="glass p-10 rounded-[3rem] border-white/5 sticky top-32 space-y-10">
                        <h3 class="text-xl font-black text-white uppercase tracking-tighter">Refine <span class="text-emerald-500 italic">Search</span></h3>

                        <!-- Category Filter -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block px-2">Category</label>
                            <select name="category" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-sm font-bold text-white focus:ring-1 focus:ring-emerald-600 transition-all">
                                <option value="" class="bg-slate-900">All Categories</option>
                                @foreach(['Adventure', 'Family', 'Honeymoon', 'Budget', 'Premium'] as $cat)
                                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }} class="bg-slate-900">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block px-2">Max Budget (₹)</label>
                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="e.g. 50000" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-sm font-bold text-white placeholder-slate-600 focus:ring-1 focus:ring-emerald-600 transition-all">
                        </div>

                        <!-- Duration -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block px-2">Duration (Days)</label>
                            <select name="duration" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-sm font-bold text-white focus:ring-1 focus:ring-emerald-600 transition-all">
                                <option value="" class="bg-slate-900">Any Duration</option>
                                @foreach([4, 5, 6, 7, 10] as $d)
                                <option value="{{ $d }}" {{ request('duration') == $d ? 'selected' : '' }} class="bg-slate-900">{{ $d }} Days</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Search -->
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block px-2">Search</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search packages..." class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-sm font-bold text-white placeholder-slate-600 focus:ring-1 focus:ring-emerald-600 transition-all">
                        </div>

                        <button type="submit" class="btn-luxury w-full py-5 !bg-emerald-600 hover:!bg-emerald-500 shadow-emerald-600/20">Apply Filters</button>
                        <a href="{{ route('packages.index') }}" class="block text-center text-[10px] font-black text-slate-500 uppercase tracking-widest hover:text-white transition-colors mt-4">Clear All Filters</a>
                    </form>
                </aside>

                <!-- Package Grid -->
                <main class="w-full lg:w-3/4 space-y-12">
                    @forelse($packages as $package)
                    <a href="{{ route('packages.show', $package->slug) }}" class="block glass group rounded-[2.5rem] overflow-hidden border-white/5 transition-all duration-700 hover:border-emerald-600/30 flex flex-col md:flex-row min-h-[280px]" data-aos="fade-up">
                        <div class="w-full md:w-2/5 relative overflow-hidden h-64 md:h-auto">
                            <img src="{{ $package->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="{{ $package->name }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=1000'">
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-transparent to-transparent hidden md:block"></div>
                        </div>
                        <div class="w-full md:w-3/5 p-8 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="px-4 py-1.5 glass rounded-xl text-[9px] font-black text-emerald-500 uppercase tracking-widest border border-emerald-500/20">{{ $package->category }} • {{ $package->duration_days }} Days</span>
                                </div>
                                <h3 class="text-xl font-black text-white uppercase tracking-tighter mb-2 group-hover:text-emerald-500 transition-colors leading-tight">{{ $package->name }}</h3>
                                <p class="text-[9px] font-bold text-blue-400 mb-3 uppercase tracking-widest">{{ $package->destination->name ?? '' }}</p>
                                <p class="text-slate-400 text-xs font-medium leading-relaxed line-clamp-2">{{ $package->description }}</p>
                            </div>
                            <div class="flex items-center justify-between pt-6 border-t border-white/5 mt-6">
                                <div>
                                    <p class="text-[8px] font-black text-slate-500 uppercase tracking-widest mb-1">Investment</p>
                                    <p class="text-xl font-black text-white tracking-tighter">₹{{ number_format($package->price) }} <span class="text-[9px] text-slate-500 uppercase font-bold">/ pp</span></p>
                                </div>
                                <span class="btn-luxury px-8 py-3 !bg-white/5 border-white/10 group-hover:!bg-emerald-600 text-[9px] shadow-lg inline-block">Reserve</span>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="text-center py-24">
                        <p class="text-2xl text-slate-500 font-bold">No packages found matching your criteria.</p>
                        <a href="{{ route('packages.index') }}" class="btn-luxury px-8 py-4 mt-8 inline-block">View All Packages</a>
                    </div>
                    @endforelse
                    <div class="pt-12">{{ $packages->appends(request()->query())->links() }}</div>
                </main>
            </div>
        </div>
    </section>
</x-app-layout>
