@foreach($packages as $package)
<a href="{{ route('packages.show', $package->slug) }}" class="block glass group rounded-[4rem] overflow-hidden border-white/5 transition-all duration-700 hover:border-emerald-600/30 flex flex-col md:flex-row h-full md:h-[450px]" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
    <div class="w-full md:w-2/5 relative overflow-hidden">
        <img src="{{ $package->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="{{ $package->name }}" onerror="this.src='https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=1000'">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-transparent to-transparent hidden md:block"></div>
    </div>
    <div class="w-full md:w-3/5 p-12 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-6">
                <span class="px-5 py-2 glass rounded-xl text-[10px] font-black text-emerald-500 uppercase tracking-widest border border-emerald-500/20">{{ $package->duration_days }} Days Expedition</span>
                <div class="flex text-amber-500">
                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                </div>
            </div>
            <h3 class="text-4xl font-black text-white uppercase tracking-tighter mb-6 group-hover:text-emerald-500 transition-colors leading-tight">{{ $package->name }}</h3>
            <p class="text-slate-500 text-sm font-medium leading-relaxed mb-8 line-clamp-3">{{ $package->description }}</p>
        </div>
        
        <div class="flex items-center justify-between pt-10 border-t border-white/5">
            <div>
                <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Total Investment</p>
                <p class="text-4xl font-black text-white tracking-tighter">₹{{ number_format($package->price) }} <span class="text-xs text-slate-500 uppercase tracking-widest">/ pp</span></p>
            </div>
            <span class="btn-luxury px-10 py-5 !bg-white/5 border-white/10 group-hover:!bg-emerald-600 shadow-none group-hover:shadow-emerald-600/20 inline-block text-center cursor-pointer">Reserve Now</span>
        </div>
    </div>
</a>
@endforeach
