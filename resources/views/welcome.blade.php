<x-app-layout>
    <!-- Cinematic Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden" 
             x-data="{ search: '', suggestions: [], showSuggestions: false, 
                       activeSlide: 0, 
                       slides: [
                           'https://images.unsplash.com/photo-1595815771614-ade9d652a65d?auto=format&fit=crop&q=80&w=2000',
                           'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&q=80&w=2000',
                           'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&q=80&w=2000',
                           'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&q=80&w=2000'
                       ] }"
             x-init="setInterval(() => { activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1 }, 5000)">
        
        <!-- Dynamic Slideshow Background -->
        <div class="absolute inset-0 z-0">
            <template x-for="(slide, index) in slides" :key="index">
                <img :src="slide" 
                     class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out"
                     :class="activeSlide === index ? 'opacity-100 scale-105 transition-transform duration-[15000ms]' : 'opacity-0'" 
                     alt="Indian Landscape">
            </template>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 via-slate-950/60 to-slate-950/90"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-6xl mx-auto w-full mt-20" data-aos="zoom-in">
            <span class="inline-block px-8 py-2.5 glass rounded-full text-[11px] font-black uppercase tracking-[0.6em] text-blue-400 mb-8 border border-blue-400/20 shadow-2xl shadow-blue-500/20">Luxury Indian Expeditions</span>
            <h1 class="text-6xl md:text-8xl lg:text-9xl font-black text-white uppercase tracking-tighter leading-none mb-12 drop-shadow-2xl">
                Crafting <br> <span class="text-blue-500 italic drop-shadow-[0_0_15px_rgba(59,130,246,0.5)]">Narratives</span>
            </h1>
            
            <!-- Premium Live Search Bar -->
            <div class="relative max-w-4xl mx-auto group">
                <div class="glass p-3 rounded-[3rem] border border-white/20 focus-within:border-blue-500/60 transition-all shadow-2xl bg-slate-950/40 backdrop-blur-md">
                    <div class="flex items-center">
                        <div class="pl-8 pr-4">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" 
                               x-model="search" 
                               @input.debounce.300ms="
                                    if (search.length > 1) {
                                        fetch(`/search/suggestions?q=${search}`)
                                            .then(res => res.json())
                                            .then(data => { suggestions = data; showSuggestions = true; })
                                    } else { showSuggestions = false; }
                               "
                               @click.away="showSuggestions = false"
                               placeholder="Where will your next elite journey begin? (e.g. Goa, Kashmir)..." 
                               class="flex-grow bg-transparent border-none text-white placeholder-slate-400 font-black text-lg focus:ring-0 py-6 outline-none">
                        <button class="btn-luxury px-12 rounded-[2.5rem] py-6 text-sm flex items-center shadow-lg shadow-blue-500/30">
                            <span>Explore</span>
                            <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Suggestions Dropdown -->
                <div x-show="showSuggestions" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="absolute top-full left-0 right-0 mt-4 glass rounded-[3rem] border border-white/10 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.8)] p-8 z-50 text-left bg-slate-950/80 backdrop-blur-xl">
                    
                    <template x-if="suggestions.destinations && suggestions.destinations.length">
                        <div class="mb-8">
                            <h4 class="text-[11px] font-black text-blue-500 uppercase tracking-widest mb-6">Gateways</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <template x-for="dest in suggestions.destinations">
                                    <a :href="`/destinations/${dest.slug}`" class="flex items-center space-x-4 group p-3 hover:bg-white/5 rounded-2xl transition-all border border-transparent hover:border-white/10">
                                        <img :src="dest.image_url" class="w-16 h-16 rounded-xl object-cover shadow-lg">
                                        <span class="text-base font-black text-white uppercase tracking-tighter group-hover:text-blue-500 transition-colors" x-text="dest.name"></span>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </template>

                    <template x-if="suggestions.packages && suggestions.packages.length">
                        <div class="mb-4">
                            <h4 class="text-[11px] font-black text-blue-500 uppercase tracking-widest mb-6">Expeditions</h4>
                            <div class="space-y-4">
                                <template x-for="pkg in suggestions.packages">
                                    <a :href="`/packages/${pkg.slug}`" class="flex items-center space-x-4 group p-3 hover:bg-white/5 rounded-2xl transition-all border border-transparent hover:border-white/10">
                                        <img :src="pkg.image_url" class="w-16 h-16 rounded-xl object-cover shadow-lg">
                                        <div>
                                            <span class="block text-base font-black text-white uppercase tracking-tighter group-hover:text-blue-500 transition-colors" x-text="pkg.name"></span>
                                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest" x-text="pkg.duration_days + ' Days • ₹' + pkg.price"></span>
                                        </div>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <!-- Trending Destinations -->
    <section class="py-28 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-end justify-between mb-12" data-aos="fade-up">
                <div>
                    <span class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.4em] mb-4 block">Trending Now</span>
                    <h2 class="text-4xl font-black text-white uppercase tracking-tighter">Most <span class="text-emerald-500 italic">Booked</span></h2>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($trendingDestinations as $trend)
                    @if($trend->bookable)
                    <a href="{{ route('destinations.show', $trend->bookable->slug) }}" class="glass p-8 rounded-[3rem] border-white/5 hover:border-emerald-600/30 transition-all">
                        <h3 class="text-2xl font-black text-white uppercase tracking-tighter">{{ $trend->bookable->name }}</h3>
                        <p class="text-[10px] text-slate-500 uppercase tracking-widest">Bookings: {{ $trend->total }}</p>
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Gateways (Destinations) -->
    <section class="py-32 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-end justify-between mb-20" data-aos="fade-up">
                <div>
                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.4em] mb-4 block">Indian Heritage</span>
                    <h2 class="text-4xl font-black text-white uppercase tracking-tighter">Elite <span class="text-blue-600 italic">Gateways</span></h2>
                </div>
                <a href="{{ route('destinations.index') }}" class="text-xs font-black text-slate-500 uppercase tracking-widest hover:text-white transition-colors border-b border-slate-800 pb-2">View All Destinations</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($destinations as $destination)
                <a href="{{ route('destinations.show', $destination->slug) }}" class="group relative h-[350px] md:h-[400px] rounded-[2.5rem] overflow-hidden shadow-2xl transition-all duration-700 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <img src="{{ $destination->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="{{ $destination->name }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    
                    <div class="absolute bottom-0 left-0 right-0 p-8 transform group-hover:translate-y-0 translate-y-2 transition-transform duration-500">
                        <div class="flex items-center space-x-4 mb-3">
                            <span class="px-3 py-1 glass rounded-xl text-[8px] font-black text-blue-400 uppercase tracking-widest border border-blue-400/20">Signature</span>
                        </div>
                        <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-2 group-hover:text-blue-500 transition-colors">{{ $destination->name }}</h3>
                        <p class="text-slate-300 text-xs font-medium mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500 line-clamp-2">{{ $destination->description }}</p>
                        <div class="flex items-center justify-between opacity-0 group-hover:opacity-100 transition-opacity duration-500 pt-4 border-t border-white/5">
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Explore Discovery</span>
                            <div class="w-10 h-10 glass rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Us (Indian Focus) -->
    <section class="py-32 bg-slate-900/30">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
                <div class="relative" data-aos="fade-right">
                    <div class="grid grid-cols-2 gap-6">
                        <img src="https://images.unsplash.com/photo-1548013146-72479768bbaa?auto=format&fit=crop&q=80&w=600" class="rounded-[3rem] h-80 w-full object-cover shadow-2xl" alt="">
                        <img src="https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&q=80&w=600" class="rounded-[3rem] h-80 w-full object-cover mt-12 shadow-2xl" alt="">
                    </div>
                    <div class="absolute -bottom-10 -right-10 glass p-10 rounded-[3rem] border-white/5 shadow-2xl">
                        <h4 class="text-4xl font-black text-blue-600 mb-2">15+</h4>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Elite Partners</p>
                    </div>
                </div>
                <div data-aos="fade-left">
                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.4em] mb-4 block">Our Philosophy</span>
                    <h2 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter mb-6 leading-tight">Curation <br> Without <span class="text-blue-600 italic">Compromise</span></h2>
                    <p class="text-lg text-slate-400 font-medium leading-relaxed mb-10">
                        We specialize in providing high-end Indian travel experiences, from the royal palaces of Rajasthan to the serene backwaters of Kerala. Our goal is to redefine luxury in the Indian subcontinent.
                    </p>
                    <div class="space-y-6">
                        @foreach(['Curated Private Expeditions', 'Bespoke Luxury Stays', 'Expert Local Curators'] as $feature)
                        <div class="flex items-center space-x-4 group cursor-pointer">
                            <div class="w-12 h-12 glass rounded-2xl flex items-center justify-center text-blue-500 group-hover:bg-blue-600 group-hover:text-white transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-sm font-bold text-white uppercase tracking-widest">{{ $feature }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-32 bg-slate-950" x-data="{ count: 0 }" x-intersect="count = 1">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12">
                @foreach([
                    ['label' => 'Total Users', 'value' => '25K', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                    ['label' => 'Explorers', 'value' => '12K', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'Gateways', 'value' => '150+', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z'],
                    ['label' => 'Bookings', 'value' => '8K', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z']
                ] as $stat)
                <div class="glass p-12 rounded-[3.5rem] border-white/5 text-center group hover:bg-white/5 transition-all" data-aos="fade-up">
                    <div class="w-16 h-16 bg-blue-600/10 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-8 group-hover:bg-blue-600 group-hover:text-white transition-all">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"></path></svg>
                    </div>
                    <h3 class="text-3xl font-black text-white mb-2 tracking-tighter" x-text="count ? '{{ $stat['value'] }}' : '0'"></h3>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Luxury Hotels Section -->
    <section class="py-32 bg-slate-900/30">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.4em] mb-4 block">Elite Stays</span>
            <h2 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter mb-16 leading-none">Indian <span class="text-blue-600 italic">Sanctuaries</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 text-left">
                @foreach(\App\Models\Hotel::take(4)->get() as $hotel)
                <a href="{{ route('hotels.show', $hotel->slug) }}" class="glass group rounded-[4rem] overflow-hidden border-white/5 flex flex-col md:flex-row h-full md:h-[350px] transition-all duration-700 hover:-translate-y-2 shadow-2xl" data-aos="fade-up">
                    <div class="w-full md:w-1/2 relative overflow-hidden">
                        <img src="{{ $hotel->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="">
                    </div>
                    <div class="w-full md:w-1/2 p-10 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">{{ $hotel->destination->name }}</span>
                                <div class="flex text-amber-500">
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <span class="text-[9px] font-black text-white ml-2">4.9</span>
                                </div>
                            </div>
                            <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-3 group-hover:text-blue-500 transition-colors">{{ $hotel->name }}</h3>
                            <p class="text-slate-400 text-xs font-medium line-clamp-2">{{ $hotel->description }}</p>
                        </div>
                        <div class="flex items-center justify-between pt-8 border-t border-white/5">
                            <div>
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest">From</p>
                                <p class="text-2xl font-black text-white tracking-tighter">₹{{ number_format($hotel->price_per_night) }}</p>
                            </div>
                            <div class="w-12 h-12 glass rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-32 bg-slate-950">
        <div class="max-w-4xl mx-auto px-4" x-data="{ active: null }">
            <h2 class="text-4xl font-black text-white text-center uppercase tracking-tighter mb-16" data-aos="fade-up">Discovery <span class="text-blue-600 italic">F.A.Q</span></h2>
            
            <div class="space-y-6">
                @foreach([
                    ['q' => 'How do I customize my Indian expedition?', 'a' => 'Simply contact our concierge desk after booking, and we will tailor every detail to your preference.'],
                    ['q' => 'Are private master guides included?', 'a' => 'Yes, every Signature Expedition includes a certified private master guide local to the region.'],
                    ['q' => 'Do you provide airport fast-track services?', 'a' => 'Indeed. VIP fast-track transfers are a standard inclusion in our Luxury tier packages.'],
                    ['q' => 'Can I book luxury stays separately?', 'a' => 'Absolutely. You can explore our Indian Sanctuaries collection and book stays individually.']
                ] as $index => $faq)
                <div class="glass rounded-3xl border-white/5 overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    <button @click="active = active === {{ $index }} ? null : {{ $index }}" class="w-full p-10 flex items-center justify-between text-left">
                        <span class="text-lg font-black text-white uppercase tracking-tighter">{{ $faq['q'] }}</span>
                        <div class="w-10 h-10 glass rounded-xl flex items-center justify-center text-blue-500 transform transition-transform duration-500" :class="active === {{ $index }} ? 'rotate-180' : ''">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </button>
                    <div x-show="active === {{ $index }}" x-collapse>
                        <div class="px-10 pb-10">
                            <p class="text-slate-400 font-medium leading-relaxed">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Masonry Travel Gallery -->
    <section class="py-32 bg-slate-900/30">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-black text-white text-center uppercase tracking-tighter mb-16" data-aos="fade-up">Visual <span class="text-blue-600 italic">Journal</span></h2>
            <div class="columns-1 md:columns-2 lg:columns-3 gap-10 space-y-10">
                @foreach([
                    'https://images.unsplash.com/photo-1514222139-b57c44ce4169?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1526772662000-3f88f10405ff?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1566833925222-7912066d302e?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&q=80&w=600'
                ] as $image)
                <div class="relative group rounded-[3rem] overflow-hidden shadow-2xl" data-aos="zoom-in">
                    <img src="{{ $image }}" class="w-full h-auto object-cover group-hover:scale-110 transition-transform duration-[2s]" alt="">
                    <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-700 flex items-center justify-center">
                        <div class="w-16 h-16 glass rounded-full flex items-center justify-center text-white">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-32 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4">
            <div class="glass p-24 rounded-[5rem] border-white/5 relative overflow-hidden text-center" data-aos="zoom-in">
                <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>
                <h2 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter mb-6 leading-none">Join the <br> <span class="text-blue-600 italic">Elite Club</span></h2>
                <p class="text-sm text-slate-400 font-medium mb-12 max-w-2xl mx-auto uppercase tracking-widest">Gain access to secret Indian gateways and unpublished private rates.</p>
                <div class="flex flex-col md:flex-row gap-6 max-w-2xl mx-auto">
                    <input type="email" placeholder="Your premium email" class="flex-grow bg-white/5 border-none rounded-[2rem] px-10 py-6 text-white placeholder-slate-600 focus:ring-2 focus:ring-blue-600 font-bold transition-all outline-none">
                    <button class="btn-luxury px-12 rounded-[2rem]">Subscribe</button>
                </div>
            </div>
        </div>
    </section>

    <script>
    </script>
</x-app-layout>
