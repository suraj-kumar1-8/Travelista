<x-app-layout>
    <section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="">
            <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm"></div>
        </div>
        <div class="relative z-10 text-center px-4" data-aos="fade-up">
            <span class="inline-block px-6 py-2 glass rounded-full text-[10px] font-black uppercase tracking-[0.5em] text-emerald-400 mb-8">Exclusive Benefits</span>
            <h1 class="text-6xl md:text-8xl font-black text-white uppercase tracking-tighter leading-none mb-6">Travelista <br> <span class="text-emerald-500 italic">Offers</span></h1>
        </div>
    </section>

    <section class="py-24 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4">
            
            <!-- Featured Flash Deal with Countdown -->
            @if($offers->count() > 0)
            @php $featured = $offers->first(); @endphp
            <div class="mb-24 relative rounded-[4rem] overflow-hidden group shadow-[0_0_50px_-12px_rgba(16,185,129,0.3)]" data-aos="zoom-in">
                <div class="absolute inset-0">
                    <img src="{{ $featured->image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[10s]" alt="" onerror="this.src='https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&q=80&w=2000'">
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/80 to-transparent"></div>
                </div>
                
                <div class="relative z-10 p-12 md:p-20 flex flex-col md:flex-row items-center justify-between">
                    <div class="max-w-2xl mb-12 md:mb-0">
                        <span class="inline-block px-4 py-1 bg-red-600 text-white rounded-full text-[10px] font-black uppercase tracking-widest mb-6 shadow-[0_0_15px_rgba(220,38,38,0.6)] animate-pulse">Flash Deal</span>
                        <h2 class="text-5xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4">{{ $featured->title }}</h2>
                        <p class="text-lg text-slate-300 font-medium mb-8 leading-relaxed">{{ $featured->description }}</p>
                        
                        <!-- Alpine Countdown -->
                        <div x-data="countdown('{{ $featured->valid_until->format('M d, Y H:i:s') }}')" class="flex items-center space-x-6 mb-10">
                            <div class="text-center">
                                <div class="glass w-16 h-16 rounded-2xl flex items-center justify-center border-white/10 mb-2">
                                    <span class="text-2xl font-black text-emerald-400" x-text="days">00</span>
                                </div>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Days</span>
                            </div>
                            <div class="text-center">
                                <div class="glass w-16 h-16 rounded-2xl flex items-center justify-center border-white/10 mb-2">
                                    <span class="text-2xl font-black text-emerald-400" x-text="hours">00</span>
                                </div>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Hours</span>
                            </div>
                            <div class="text-center">
                                <div class="glass w-16 h-16 rounded-2xl flex items-center justify-center border-white/10 mb-2">
                                    <span class="text-2xl font-black text-emerald-400" x-text="minutes">00</span>
                                </div>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Mins</span>
                            </div>
                            <div class="text-center">
                                <div class="glass w-16 h-16 rounded-2xl flex items-center justify-center border-white/10 mb-2 border-emerald-500/30 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                                    <span class="text-2xl font-black text-white" x-text="seconds">00</span>
                                </div>
                                <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest">Secs</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Code Card -->
                    <div class="glass p-8 rounded-[3rem] border-white/10 text-center w-full md:w-80 backdrop-blur-2xl bg-slate-900/50">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Your Exclusive Code</p>
                        <div class="border-2 border-dashed border-emerald-500/50 rounded-2xl p-6 mb-6 bg-emerald-500/5 cursor-pointer hover:bg-emerald-500/10 transition-colors" onclick="navigator.clipboard.writeText('{{ $featured->code }}'); alert('Code copied!');">
                            <span class="text-3xl font-black text-emerald-400 tracking-widest">{{ $featured->code }}</span>
                        </div>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Min Spend: ₹{{ number_format($featured->min_booking_amount) }}</p>
                        <a href="{{ route('packages.index') }}" class="btn-luxury w-full py-4 text-[10px] !bg-emerald-600 hover:!bg-emerald-500">Redeem Now</a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Regular Offers Grid -->
            <div class="flex items-center justify-between mb-12" data-aos="fade-up">
                <h3 class="text-3xl font-black text-white uppercase tracking-tighter">Seasonal <span class="text-emerald-500 italic">Discounts</span></h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($offers->skip(1) as $offer)
                <div class="glass group rounded-[3rem] overflow-hidden border-white/5 transition-all duration-500 hover:-translate-y-2 hover:border-emerald-500/30 flex flex-col h-full" data-aos="fade-up">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $offer->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&q=80&w=1000'">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-80"></div>
                        <div class="absolute top-6 left-6">
                            <span class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-600/30">
                                {{ $offer->discount_type === 'percentage' ? $offer->discount_value.'% OFF' : '₹'.number_format($offer->discount_value).' OFF' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-10 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-black text-white uppercase tracking-tighter mb-4 group-hover:text-emerald-400 transition-colors">{{ $offer->title }}</h3>
                            <p class="text-slate-400 text-xs font-medium mb-6 line-clamp-3">{{ $offer->description }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-2">Use Code at Checkout</p>
                            <div class="glass p-4 rounded-2xl border-white/10 text-center border-dashed cursor-copy hover:bg-white/5 transition-colors group/code" onclick="navigator.clipboard.writeText('{{ $offer->code }}'); alert('Code {{ $offer->code }} copied!');">
                                <span class="text-lg font-black text-emerald-400 tracking-widest group-hover/code:text-white transition-colors">{{ $offer->code }}</span>
                            </div>
                            <p class="text-center mt-4 text-[9px] font-bold text-slate-500 uppercase tracking-widest">Valid until {{ $offer->valid_until->format('d M, Y') }} • Min. ₹{{ number_format($offer->min_booking_amount) }}</p>
                        </div>
                    </div>
                </div>
                @empty
                @if($offers->count() === 0)
                <div class="col-span-3 text-center py-24">
                    <p class="text-2xl text-slate-500 font-bold">No exclusive offers available at the moment. Check back soon!</p>
                </div>
                @endif
                @endforelse
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('countdown', (targetDate) => ({
                days: '00', hours: '00', minutes: '00', seconds: '00',
                init() {
                    const target = new Date(targetDate).getTime();
                    setInterval(() => {
                        const now = new Date().getTime();
                        const distance = target - now;
                        if (distance < 0) return;
                        this.days = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                        this.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                        this.minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                        this.seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                    }, 1000);
                }
            }));
        });
    </script>
</x-app-layout>
