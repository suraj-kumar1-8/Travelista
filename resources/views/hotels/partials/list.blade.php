@foreach($hotels as $hotel)
<div class="glass group rounded-[3.5rem] overflow-hidden border-white/5 transition-all duration-700 hover:-translate-y-4 shadow-2xl" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
    <div class="relative h-[350px] overflow-hidden">
        <img src="{{ $hotel->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="{{ $hotel->name }}" onerror="this.src='https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&q=80&w=1000'">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/10 to-transparent"></div>
        <div class="absolute top-8 left-8">
            <span class="px-5 py-2 glass rounded-2xl text-[10px] font-black text-white uppercase tracking-widest border border-white/10">Ultra Luxury</span>
        </div>
        <div class="absolute bottom-8 left-8 right-8 flex items-center justify-between">
            <div class="flex text-amber-500">
                @for($i=0; $i<5; $i++)
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                @endfor
            </div>
            <span class="text-[10px] font-black text-white uppercase tracking-widest opacity-80">9.8 Exceptional</span>
        </div>
    </div>
    <div class="p-10 space-y-8">
        <div>
            <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-2">{{ $hotel->destination->name }}</p>
            <h3 class="text-3xl font-black text-white uppercase tracking-tighter group-hover:text-blue-600 transition-colors">{{ $hotel->name }}</h3>
        </div>
        
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Starting from</p>
                <p class="text-3xl font-black text-white tracking-tighter">₹{{ number_format($hotel->price_per_night) }} <span class="text-xs text-slate-500 uppercase tracking-widest">/ nt</span></p>
            </div>
            <a href="{{ route('hotels.show', $hotel->slug) }}" class="w-16 h-16 glass rounded-2xl flex items-center justify-center text-white hover:bg-blue-600 transition-all shadow-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </div>
</div>
@endforeach
