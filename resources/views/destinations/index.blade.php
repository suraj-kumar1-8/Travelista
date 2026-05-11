<x-app-layout>
    <section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="">
            <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm"></div>
        </div>
        <div class="relative z-10 text-center px-4" data-aos="fade-up">
            <span class="inline-block px-6 py-2 glass rounded-full text-[10px] font-black uppercase tracking-[0.5em] text-blue-400 mb-8">Indian Heritage</span>
            <h1 class="text-6xl md:text-8xl font-black text-white uppercase tracking-tighter leading-none mb-6">Elite <br> <span class="text-blue-600 italic">Gateways</span></h1>
            <p class="text-xl text-slate-400 font-medium max-w-2xl mx-auto">Discover India's most breathtaking destinations, from snow-capped mountains to golden beaches.</p>
        </div>
    </section>

    <!-- Dynamic Filters -->
    <section class="py-12 bg-slate-950" x-data="{ activeCategory: '{{ request('category', '') }}' }">
        <div class="max-w-7xl mx-auto px-4">
            <div class="glass p-6 rounded-[2.5rem] border-white/5 flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl">
                <form action="{{ route('destinations.index') }}" method="GET" class="relative w-full md:w-[450px] group">
                    <div class="glass flex items-center p-2 rounded-[2rem] border border-white/10 focus-within:border-blue-500/50 transition-all shadow-lg bg-slate-950/40 backdrop-blur-md">
                        <div class="pl-4 pr-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search gateways..." class="w-full bg-transparent border-none px-2 py-3 text-sm font-bold text-white placeholder-slate-400 focus:ring-0 outline-none">
                        <button type="submit" class="btn-luxury px-6 py-3 rounded-[1.5rem] !text-[10px] shadow-lg shadow-blue-500/20">Find</button>
                    </div>
                </form>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('destinations.index') }}" class="px-6 py-2 rounded-xl {{ !request('category') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'glass text-slate-500 hover:text-white' }} text-[10px] font-black uppercase tracking-widest transition-colors">All</a>
                    @foreach(['Mountains', 'Beaches', 'Nature', 'Heritage', 'Adventure', 'Religious'] as $cat)
                    <a href="{{ route('destinations.index', ['category' => $cat]) }}" class="px-6 py-2 rounded-xl {{ request('category') === $cat ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'glass text-slate-500 hover:text-white' }} text-[10px] font-black uppercase tracking-widest transition-colors">{{ $cat }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Destination Grid -->
    <section class="py-24 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($destinations as $destination)
                <div class="group relative h-[450px] rounded-[3rem] overflow-hidden shadow-2xl transition-all duration-700 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <img src="{{ $destination->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="{{ $destination->name }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1506929113670-b43135c8d33d?auto=format&fit=crop&q=80&w=1000'">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    <div class="absolute inset-0 p-8 flex flex-col justify-end">
                        <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <div class="flex items-center space-x-3 mb-4">
                                <span class="px-3 py-1 glass rounded-xl text-[8px] font-black text-blue-400 uppercase tracking-widest border border-blue-400/20">{{ $destination->category }}</span>
                                <div class="flex items-center text-amber-500">
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span class="text-[8px] font-black text-white ml-2">4.9</span>
                                </div>
                            </div>
                            <h3 class="text-3xl font-black text-white uppercase tracking-tighter mb-2 leading-none group-hover:text-blue-500 transition-colors">{{ $destination->name }}</h3>
                            <p class="text-[10px] font-bold text-slate-400 mb-3 uppercase tracking-widest">{{ $destination->location }}</p>
                            <p class="text-slate-300 text-xs font-medium mb-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500 line-clamp-2">{{ $destination->description }}</p>
                            <div class="flex items-center space-x-6">
                                <a href="{{ route('destinations.show', $destination->slug) }}" class="btn-luxury px-8 py-3 !text-[9px]">Explore Destination</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-24">
                    <p class="text-2xl text-slate-500 font-bold">No destinations found. Try a different filter.</p>
                    <a href="{{ route('destinations.index') }}" class="btn-luxury px-8 py-4 mt-8 inline-block">View All Destinations</a>
                </div>
                @endforelse
            </div>
            <div class="pt-24">{{ $destinations->links() }}</div>
        </div>
    </section>
</x-app-layout>
