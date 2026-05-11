<x-app-layout>
    <section class="relative h-[50vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="">
            <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm"></div>
        </div>
        <div class="relative z-10 text-center px-4">
            <h1 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-6">Search <span class="text-blue-600 italic">Results</span></h1>
            <p class="text-xl text-slate-400">{{ $totalResults }} results found for "<span class="text-white font-bold">{{ $query }}</span>"</p>
        </div>
    </section>

    <section class="py-24 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 space-y-20">
            @if($destinations->count())
            <div>
                <h2 class="text-3xl font-black text-white uppercase tracking-tighter mb-10">Destinations <span class="text-blue-600 italic">({{ $destinations->count() }})</span></h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($destinations as $destination)
                    <a href="{{ route('destinations.show', $destination->slug) }}" class="group relative h-[400px] rounded-[3rem] overflow-hidden shadow-2xl hover:-translate-y-2 transition-all duration-500">
                        <img src="{{ $destination->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" alt="{{ $destination->name }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1506929113670-b43135c8d33d?auto=format&fit=crop&q=80&w=1000'">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8">
                            <span class="px-4 py-1.5 glass rounded-xl text-[8px] font-black text-blue-400 uppercase tracking-widest border border-blue-400/20 mb-4 inline-block">{{ $destination->category }}</span>
                            <h3 class="text-3xl font-black text-white uppercase tracking-tighter group-hover:text-blue-500 transition-colors">{{ $destination->name }}</h3>
                            <p class="text-sm text-slate-400 mt-2">{{ $destination->location }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            @if($packages->count())
            <div>
                <h2 class="text-3xl font-black text-white uppercase tracking-tighter mb-10">Packages <span class="text-emerald-500 italic">({{ $packages->count() }})</span></h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($packages as $package)
                    <a href="{{ route('packages.show', $package->slug) }}" class="glass group rounded-[3rem] overflow-hidden border-white/5 hover:-translate-y-2 transition-all duration-500">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $package->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" alt="{{ $package->name }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=1000'">
                            <div class="absolute top-4 right-4 px-4 py-2 glass rounded-xl text-[10px] font-black text-white uppercase tracking-widest">{{ $package->duration_days }} Days</div>
                        </div>
                        <div class="p-8">
                            <span class="text-[10px] font-black text-emerald-500 uppercase tracking-widest">{{ $package->category }} • {{ $package->destination->name ?? '' }}</span>
                            <h3 class="text-2xl font-black text-white uppercase tracking-tighter mt-2 group-hover:text-emerald-500 transition-colors">{{ $package->name }}</h3>
                            <div class="flex items-center justify-between mt-6 pt-6 border-t border-white/5">
                                <p class="text-2xl font-black text-white">₹{{ number_format($package->price) }}</p>
                                <span class="text-[10px] font-black text-slate-500 uppercase">per person</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            @if($hotels->count())
            <div>
                <h2 class="text-3xl font-black text-white uppercase tracking-tighter mb-10">Hotels <span class="text-amber-500 italic">({{ $hotels->count() }})</span></h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($hotels as $hotel)
                    <a href="{{ route('hotels.show', $hotel->slug) }}" class="glass group rounded-[3rem] overflow-hidden border-white/5 hover:-translate-y-2 transition-all duration-500">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $hotel->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" alt="{{ $hotel->name }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=1000'">
                            <div class="absolute top-4 right-4 flex items-center space-x-2 glass px-4 py-2 rounded-xl">
                                <svg class="w-3 h-3 text-amber-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <span class="text-[10px] font-black text-white">{{ $hotel->rating }}.0</span>
                            </div>
                        </div>
                        <div class="p-8">
                            <span class="text-[10px] font-black text-amber-500 uppercase tracking-widest">{{ $hotel->type }} • {{ $hotel->destination->name ?? '' }}</span>
                            <h3 class="text-2xl font-black text-white uppercase tracking-tighter mt-2 group-hover:text-amber-500 transition-colors">{{ $hotel->name }}</h3>
                            <div class="flex items-center justify-between mt-6 pt-6 border-t border-white/5">
                                <p class="text-2xl font-black text-white">₹{{ number_format($hotel->price_per_night) }}</p>
                                <span class="text-[10px] font-black text-slate-500 uppercase">per night</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            @if($totalResults === 0)
            <div class="text-center py-32">
                <div class="w-24 h-24 bg-blue-600/10 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-3xl font-black text-white uppercase tracking-tighter mb-4">No Results Found</h3>
                <p class="text-slate-400 text-lg mb-8">Try searching for Kashmir, Goa, Kerala, Manali or other Indian destinations.</p>
                <a href="{{ route('destinations.index') }}" class="btn-luxury px-10 py-4 inline-block">Browse All Destinations</a>
            </div>
            @endif
        </div>
    </section>
</x-app-layout>
