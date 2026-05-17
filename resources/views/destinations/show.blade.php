<x-app-layout>
    <!-- Cinematic Header -->
    <div class="relative h-[80vh] overflow-hidden">
        <img src="{{ $destination->image_url }}" class="w-full h-full object-cover animate-slow-zoom" alt="{{ $destination->name }}">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
        <div class="absolute inset-0 flex items-center justify-center text-center px-4">
            <div data-aos="zoom-in">
                <span class="inline-block px-6 py-2 glass rounded-full text-[10px] font-black uppercase tracking-[0.5em] text-blue-400 mb-8">Destination Profile</span>
                <h1 class="text-7xl md:text-9xl font-black text-white uppercase tracking-tighter mb-8 leading-none">{{ $destination->name }}</h1>
                <div class="flex items-center justify-center space-x-8">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        <span class="text-xs font-black text-white uppercase tracking-widest">{{ $destination->location ?? 'Global Gateway' }}</span>
                    </div>
                    <div class="w-px h-6 bg-white/20"></div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <span class="text-xs font-black text-white uppercase tracking-widest">4.9 / 5.0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-24">
        <div class="flex flex-col lg:flex-row gap-20">
            <!-- Left: Content -->
            <div class="w-full lg:w-2/3 space-y-24">
                <!-- Overview -->
                <section data-aos="fade-up">
                    <h2 class="text-4xl font-black text-white uppercase tracking-tighter mb-8">The <span class="text-blue-600 italic">Essence</span></h2>
                    <p class="text-xl text-slate-400 font-medium leading-relaxed mb-12">
                        {{ $destination->description }}
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="glass p-8 rounded-[2.5rem] border-white/5">
                            <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-2 block">Climate</span>
                            <p class="text-white font-bold uppercase tracking-widest">{{ $destination->weather ?? 'Pleasant' }}</p>
                        </div>
                        <div class="glass p-8 rounded-[2.5rem] border-white/5">
                            <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-2 block">Best Time</span>
                            <p class="text-white font-bold uppercase tracking-widest">{{ $destination->best_time_to_visit ?? 'Year Round' }}</p>
                        </div>
                        <div class="glass p-8 rounded-[2.5rem] border-white/5">
                            <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-2 block">Currency</span>
                            <p class="text-white font-bold uppercase tracking-widest">Indian Rupee (₹)</p>
                        </div>
                    </div>
                </section>

                <!-- Weather Widget -->
                <section data-aos="fade-up" class="glass p-10 rounded-[3rem] border-white/5">
                    <h3 class="text-xl font-black text-white uppercase tracking-tighter mb-6">Live <span class="text-emerald-500 italic">Weather</span></h3>
                    <div id="weatherWidget" class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                        <div class="glass p-6 rounded-2xl border-white/5">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Temp</p>
                            <p class="text-2xl font-black text-white" id="weatherTemp">--</p>
                        </div>
                        <div class="glass p-6 rounded-2xl border-white/5">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Condition</p>
                            <p class="text-sm font-black text-white" id="weatherCondition">--</p>
                        </div>
                        <div class="glass p-6 rounded-2xl border-white/5">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Humidity</p>
                            <p class="text-sm font-black text-white" id="weatherHumidity">--</p>
                        </div>
                        <div class="glass p-6 rounded-2xl border-white/5">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Feels Like</p>
                            <p class="text-sm font-black text-white" id="weatherFeels">--</p>
                        </div>
                    </div>
                </section>

                <!-- Image Gallery -->
                @if($destination->images)
                <section data-aos="fade-up" class="pt-8">
                    <h2 class="text-4xl font-black text-white uppercase tracking-tighter mb-12">Visual <span class="text-blue-600 italic">Journey</span></h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach(json_decode($destination->images, true) as $img)
                            <div class="h-56 overflow-hidden rounded-[2.5rem] border border-white/5">
                                <img src="{{ asset($img) }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700 cursor-pointer" alt="Destination Image">
                            </div>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- Luxury Stays Grid -->
                <section data-aos="fade-up">
                    <div class="flex items-center justify-between mb-12">
                        <h2 class="text-4xl font-black text-white uppercase tracking-tighter">Elite <span class="text-blue-600 italic">Resorts</span></h2>
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $destination->hotels->count() }} Properties Available</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        @foreach($destination->hotels as $hotel)
                        <div class="glass group rounded-[3rem] overflow-hidden border-white/5 transition-all duration-500 hover:-translate-y-2">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $hotel->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="">
                                <div class="absolute top-6 right-6">
                                    <span class="px-4 py-2 glass rounded-xl text-[10px] font-black text-white uppercase tracking-widest">From ₹{{ number_format($hotel->price_per_night) }}</span>
                                </div>
                            </div>
                            <div class="p-8">
                                <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-4 group-hover:text-blue-600 transition-colors">{{ $hotel->name }}</h3>
                                <div class="flex items-center space-x-4 mb-8">
                                    <div class="flex text-amber-500">
                                        @for($i=0; $i<5; $i++)
                                        <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        @endfor
                                    </div>
                                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Ultra Luxury</span>
                                </div>
                                <a href="{{ route('hotels.show', $hotel->slug) }}" class="btn-luxury w-full py-4 text-center">View Property</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                <!-- Tour Slider -->
                <section data-aos="fade-up">
                    <h2 class="text-4xl font-black text-white uppercase tracking-tighter mb-12">Signature <span class="text-blue-600 italic">Journeys</span></h2>
                    <div class="swiper tour-slider overflow-visible">
                        <div class="swiper-wrapper">
                            @foreach($destination->tourPackages as $package)
                            <div class="swiper-slide !h-auto">
                                <div class="glass group rounded-[3.5rem] overflow-hidden border-white/5 h-full flex flex-col">
                                    <div class="relative h-72 overflow-hidden">
                                        <img src="{{ $package->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 to-transparent"></div>
                                        <div class="absolute bottom-6 left-6">
                                            <span class="px-5 py-2 glass rounded-xl text-[10px] font-black text-white uppercase tracking-widest">{{ $package->duration_days }} Days Expedition</span>
                                        </div>
                                    </div>
                                    <div class="p-10 flex flex-col flex-grow">
                                        <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-4 group-hover:text-blue-600 transition-colors">{{ $package->name }}</h3>
                                        <p class="text-slate-400 text-sm font-medium mb-10 flex-grow">{{ Str::limit($package->description, 100) }}</p>
                                        <div class="flex items-center justify-between pt-8 border-t border-white/5">
                                            <div>
                                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">From</p>
                                                <p class="text-3xl font-black text-white tracking-tighter">₹{{ number_format($package->price) }}</p>
                                            </div>
                                            <a href="{{ route('packages.show', $package->slug) }}" class="w-16 h-16 glass rounded-2xl flex items-center justify-center text-white hover:bg-blue-600 transition-all">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination !-bottom-12"></div>
                    </div>
                </section>
            </div>

            <!-- Right: Sticky Booking/Info -->
            <div class="w-full lg:w-1/3">
                <div class="sticky top-32 space-y-12" data-aos="fade-left">
                    <!-- Booking Form -->
                    <div class="glass p-12 rounded-[4rem] border border-blue-600/20 shadow-2xl shadow-blue-600/10" x-data="{ travelers: 1, basePrice: 1000 }">
                        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-600 to-emerald-600"></div>
                        <div class="mb-10">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-2">Reservation Fee</p>
                            <h3 class="text-4xl font-black text-white tracking-tighter">₹1,000 <span class="text-sm text-slate-500 uppercase tracking-widest">/ pp</span></h3>
                        </div>

                        <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm" class="space-y-6">
                            @csrf
                            <input type="hidden" name="bookable_type" value="Destination">
                            <input type="hidden" name="bookable_id" value="{{ $destination->id }}">

                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Arrival Date</label>
                                <input type="date" name="start_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold">
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Travelers</label>
                                <div class="flex items-center space-x-4 bg-white/5 rounded-2xl px-6 py-2 border border-transparent">
                                    <button type="button" @click="travelers = Math.max(1, travelers - 1)" class="w-10 h-10 flex items-center justify-center text-slate-500 hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                    </button>
                                    <input type="number" name="travelers" x-model="travelers" min="1" max="20" class="flex-grow bg-transparent border-none text-center text-xl font-black text-white focus:ring-0">
                                    <button type="button" @click="travelers = Math.min(20, travelers + 1)" class="w-10 h-10 flex items-center justify-center text-slate-500 hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="glass p-6 rounded-2xl border-white/5 space-y-4 my-6">
                                <div class="flex justify-between text-xs font-bold text-slate-400">
                                    <span>Base Fee</span>
                                    <span class="text-white">₹1,000</span>
                                </div>
                                <div class="flex justify-between text-xs font-bold text-slate-400">
                                    <span>Explorers</span>
                                    <span class="text-white" x-text="travelers"></span>
                                </div>
                                <div class="border-t border-white/10 pt-4 flex justify-between">
                                    <span class="text-sm font-black text-white uppercase tracking-widest">Total</span>
                                    <span class="text-2xl font-black text-blue-500" x-text="'₹' + (basePrice * travelers).toLocaleString('en-IN')"></span>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Coupon Code</label>
                                <input type="text" name="coupon_code" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold" placeholder="GOA10">
                            </div>

                            @auth
                            <button type="submit" class="btn-luxury w-full py-5 text-sm flex items-center justify-center space-x-3">
                                <span>Reserve Gateway</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                            <button onclick="toggleWishlist('Destination', {{ $destination->id }}, this)" type="button" class="btn-luxury w-full py-4 text-[10px] !bg-white/5 hover:!bg-rose-600 mt-4">Add to Favorites</button>
                            @else
                            <a href="{{ route('login') }}" class="btn-luxury w-full py-5 text-sm flex items-center justify-center space-x-3">
                                <span>Login to Reserve</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                            @endauth
                        </form>
                    </div>


                    <!-- Nearby Hub -->
                    <div class="glass p-10 rounded-[3rem] border-white/5">
                        <h4 class="text-xs font-black text-white uppercase tracking-widest mb-8">Popular Connects</h4>
                        <div class="space-y-6">
                            @foreach(\App\Models\Destination::where('id', '!=', $destination->id)->take(3)->get() as $near)
                            <a href="{{ route('destinations.show', $near->slug) }}" class="flex items-center space-x-4 group">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden flex-shrink-0">
                                    <img src="{{ $near->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="">
                                </div>
                                <div class="flex-grow">
                                    <h5 class="text-sm font-black text-white uppercase tracking-tighter group-hover:text-blue-500 transition-colors">{{ $near->name }}</h5>
                                    <p class="text-[9px] font-black text-slate-600 uppercase tracking-widest">Explore Connection</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.tour-slider', {
                slidesPerView: 1,
                spaceBetween: 30,
                pagination: { el: '.swiper-pagination', clickable: true },
                breakpoints: {
                    640: { slidesPerView: 1.5 },
                    1024: { slidesPerView: 2 },
                }
            });
        });
    </script>

    <script>
        fetch("{{ route('weather.show') }}?city={{ urlencode($destination->location ?? 'India') }}")
            .then(response => response.json())
            .then(data => {
                if (data && data.main) {
                    document.getElementById('weatherTemp').textContent = `${Math.round(data.main.temp)}°C`;
                    document.getElementById('weatherCondition').textContent = data.weather?.[0]?.main || 'Clear';
                    document.getElementById('weatherHumidity').textContent = `${data.main.humidity}%`;
                    document.getElementById('weatherFeels').textContent = `${Math.round(data.main.feels_like)}°C`;
                }
            })
            .catch(() => {});
    </script>

    @auth
    <script>
        function toggleWishlist(type, id, btn) {
            fetch("{{ route('wishlist.toggle') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ wishable_type: type, wishable_id: id })
            })
            .then(res => res.json())
            .then(data => {
                if (btn) {
                    btn.textContent = data.status === 'added' ? 'Remove from Favorites' : 'Add to Favorites';
                }
            });
        }
    </script>
    @endauth
</x-app-layout>
