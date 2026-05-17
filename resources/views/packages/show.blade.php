<x-app-layout>
    <!-- Cinematic Hero -->
    <div class="relative h-[60vh] overflow-hidden">
        <img src="{{ $package->image_url }}" class="w-full h-full object-cover animate-slow-zoom" alt="{{ $package->name }}" onerror="this.src='https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=2000'">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
        <div class="absolute bottom-20 left-0 right-0 px-4">
            <div class="max-w-7xl mx-auto" data-aos="fade-up">
                <span class="inline-block px-6 py-2 glass rounded-full text-[10px] font-black uppercase tracking-[0.4em] text-emerald-400 mb-6">{{ $package->category }} Expedition</span>
                <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-8 leading-none">{{ $package->name }}</h1>
                <div class="flex flex-wrap gap-6">
                    <div class="flex items-center space-x-3 glass px-6 py-3 rounded-2xl border-white/10">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-xs font-black text-white uppercase tracking-widest">{{ $package->duration_days }} Days / {{ $package->duration_days - 1 }} Nights</span>
                    </div>
                    <div class="flex items-center space-x-3 glass px-6 py-3 rounded-2xl border-white/10">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        <span class="text-xs font-black text-white uppercase tracking-widest">{{ $package->destination->name ?? 'India' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-24">
        <div class="flex flex-col lg:flex-row gap-20">
            <!-- Left: Journey Details -->
            <div class="w-full lg:w-2/3 space-y-24">
                <!-- Overview -->
                <section data-aos="fade-up">
                    <h2 class="text-3xl font-black text-white uppercase tracking-tighter mb-8">The <span class="text-blue-600 italic">Narrative</span></h2>
                    <p class="text-xl text-slate-400 font-medium leading-relaxed mb-12">{{ $package->description }}</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach(['Ultra Luxury', 'Guided', 'All Inclusive', 'Bespoke'] as $feature)
                        <div class="glass p-6 rounded-[2rem] border-white/5 text-center group hover:border-blue-600/30 transition-all">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest group-hover:text-white">{{ $feature }}</p>
                        </div>
                        @endforeach
                    </div>
                </section>

                <!-- Image Gallery -->
                @if($package->images)
                <section data-aos="fade-up">
                    <h2 class="text-3xl font-black text-white uppercase tracking-tighter mb-10">Photo <span class="text-emerald-600 italic">Gallery</span></h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach(json_decode($package->images, true) as $img)
                            <div class="h-48 overflow-hidden rounded-[2.5rem] border border-white/5">
                                <img src="{{ asset($img) }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700 cursor-pointer" alt="Package Image">
                            </div>
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- Interactive Itinerary -->
                <section data-aos="fade-up">
                    <h2 class="text-3xl font-black text-white uppercase tracking-tighter mb-16">The <span class="text-emerald-600 italic">Expedition Path</span></h2>
                    <div class="space-y-0 relative">
                        <div class="absolute left-6 top-0 bottom-0 w-px bg-gradient-to-b from-emerald-600 via-blue-600 to-transparent"></div>
                        @if(is_array($package->itinerary))
                            @foreach($package->itinerary as $i => $day)
                            <div class="relative pl-24 pb-16 group">
                                <div class="absolute left-0 w-12 h-12 glass rounded-2xl flex items-center justify-center border-white/10 group-hover:bg-emerald-600 transition-all z-10">
                                    <span class="text-xs font-black text-white">{{ $i + 1 }}</span>
                                </div>
                                <div class="glass p-10 rounded-[3rem] border-white/5 group-hover:border-blue-600/20 transition-all">
                                    <h4 class="text-xl font-black text-white uppercase tracking-tighter">{{ $day }}</h4>
                                </div>
                            </div>
                            @endforeach
                        @else
                            @for($i=1; $i<=$package->duration_days; $i++)
                            <div class="relative pl-24 pb-16 group">
                                <div class="absolute left-0 w-12 h-12 glass rounded-2xl flex items-center justify-center border-white/10 group-hover:bg-emerald-600 transition-all z-10">
                                    <span class="text-xs font-black text-white">{{ $i }}</span>
                                </div>
                                <div class="glass p-10 rounded-[3rem] border-white/5 group-hover:border-blue-600/20 transition-all">
                                    <h4 class="text-xl font-black text-white uppercase tracking-tighter">Day {{ $i }}: @if($i==1) Arrival & Luxury Transfer @elseif($i==$package->duration_days) Final Farewell @else Guided Expedition {{ $i }} @endif</h4>
                                </div>
                            </div>
                            @endfor
                        @endif
                    </div>
                </section>

                <!-- Inclusions -->
                <section data-aos="fade-up">
                    <div class="glass p-16 rounded-[4rem] border-white/5 relative overflow-hidden">
                        <h2 class="text-3xl font-black text-white uppercase tracking-tighter mb-12">Expedition <span class="text-emerald-600 italic">Inclusions</span></h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <ul class="space-y-6">
                                @php $inclusions = is_array($package->inclusions) ? $package->inclusions : ['Luxury Accommodation', 'All Meals', 'Private Guide', 'Premium Transport', 'Travel Insurance']; @endphp
                                @foreach($inclusions as $inc)
                                <li class="flex items-center space-x-4">
                                    <div class="w-6 h-6 bg-emerald-600/20 rounded-lg flex items-center justify-center text-emerald-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <span class="text-xs font-black text-white uppercase tracking-widest">{{ $inc }}</span>
                                </li>
                                @endforeach
                            </ul>
                            <ul class="space-y-6 opacity-40">
                                @foreach(['International Flights', 'Personal Shopping', 'Spa Premium Upgrades'] as $exc)
                                <li class="flex items-center space-x-4">
                                    <div class="w-6 h-6 bg-white/5 rounded-lg flex items-center justify-center text-slate-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </div>
                                    <span class="text-xs font-black text-slate-400 uppercase tracking-widest line-through">{{ $exc }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right: Sticky Booking Widget -->
            <div class="w-full lg:w-1/3">
                <div class="sticky top-32" data-aos="fade-left">
                    <div class="glass p-12 rounded-[4rem] border-white/5 shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-600 to-emerald-600"></div>
                        <div class="mb-12">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-2">Total Investment</p>
                            <h3 class="text-5xl font-black text-white tracking-tighter">₹{{ number_format($package->price) }} <span class="text-lg text-slate-500 uppercase tracking-widest">/ pp</span></h3>
                        </div>

                        <div class="glass p-6 rounded-2xl border-white/5 mb-8">
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Seats Available</p>
                            <p class="text-2xl font-black text-white">{{ $package->available_seats }}</p>
                            <p class="text-[10px] text-slate-500">Capacity: {{ $package->total_seats }}</p>
                        </div>

                                                <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm" class="space-y-8" 
                            x-data="{ 
                                travelers: 1, 
                                price: {{ $package->price }},
                                couponCode: '',
                                discountAmount: 0,
                                taxes: 0,
                                isValidatingCoupon: false,
                                couponMessage: '',
                                couponValid: false,
                                
                                get subtotal() {
                                    return Math.max(0, (this.travelers * this.price) - this.discountAmount);
                                },
                                get taxAmount() {
                                    return this.subtotal * 0.18;
                                },
                                get grandTotal() {
                                    return this.subtotal + this.taxAmount;
                                },
                                
                                validateCoupon() {
                                    if(!this.couponCode) {
                                        this.discountAmount = 0;
                                        this.couponMessage = '';
                                        this.couponValid = false;
                                        return;
                                    }
                                    
                                    this.isValidatingCoupon = true;
                                    this.couponMessage = 'Validating...';
                                    
                                    fetch('{{ route('coupons.validate') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            code: this.couponCode,
                                            amount: this.travelers * this.price
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        this.isValidatingCoupon = false;
                                        if(data.valid) {
                                            this.discountAmount = data.discount;
                                            this.couponValid = true;
                                            this.couponMessage = data.message;
                                        } else {
                                            this.discountAmount = 0;
                                            this.couponValid = false;
                                            this.couponMessage = data.message;
                                        }
                                    })
                                    .catch(error => {
                                        this.isValidatingCoupon = false;
                                        this.discountAmount = 0;
                                        this.couponValid = false;
                                        this.couponMessage = 'Error validating coupon';
                                    });
                                }
                            }"
                            x-init="$watch('travelers', value => { if(couponCode) validateCoupon(); })">
                            @csrf
                            <input type="hidden" name="bookable_type" value="TourPackage">
                            <input type="hidden" name="bookable_id" value="{{ $package->id }}">

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-2">Expedition Start</label>
                                <input type="date" name="start_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold">
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-2">Explorers Count</label>
                                <div class="flex items-center space-x-4 bg-white/5 rounded-2xl px-6 py-2">
                                    <button type="button" @click="travelers = Math.max(1, travelers - 1)" class="w-10 h-10 flex items-center justify-center text-slate-500 hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                    </button>
                                    <input type="number" name="travelers" x-model="travelers" min="1" max="10" class="flex-grow bg-transparent border-none text-center text-xl font-black text-white focus:ring-0">
                                    <button type="button" @click="travelers = Math.min(10, travelers + 1)" class="w-10 h-10 flex items-center justify-center text-slate-500 hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-2">Coupon Code</label>
                                <div class="relative">
                                    <input type="text" name="coupon_code" x-model="couponCode" @change="validateCoupon" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold" placeholder="TRAVEL20">
                                    <button type="button" @click="validateCoupon" class="absolute right-2 top-2 bottom-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-4 rounded-xl transition-colors" x-text="isValidatingCoupon ? '...' : 'Apply'"></button>
                                </div>
                                <p x-show="couponMessage" :class="couponValid ? 'text-emerald-500' : 'text-rose-500'" class="text-xs font-bold px-2" x-text="couponMessage" style="display: none;"></p>
                            </div>

                            <!-- Dynamic Price Summary -->
                            <div class="glass p-6 rounded-2xl border-white/5 space-y-4">
                                <div class="flex justify-between text-xs font-bold text-slate-400">
                                    <span>Base Package <span x-text="'(x'+travelers+')'"></span></span>
                                    <span class="text-white" x-text="'₹' + (travelers * price).toLocaleString('en-IN')"></span>
                                </div>
                                
                                <div x-show="discountAmount > 0" style="display: none;" class="flex justify-between text-xs font-bold text-emerald-400">
                                    <span>Coupon Discount</span>
                                    <span x-text="'-₹' + discountAmount.toLocaleString('en-IN')"></span>
                                </div>

                                <div class="flex justify-between text-xs font-bold text-slate-400">
                                    <span>Taxes (18%)</span>
                                    <span class="text-white" x-text="'₹' + taxAmount.toLocaleString('en-IN')"></span>
                                </div>

                                <div class="border-t border-white/10 pt-4 flex justify-between">
                                    <span class="text-sm font-black text-white uppercase tracking-widest">Total</span>
                                    <span class="text-2xl font-black text-emerald-500" x-text="'₹' + grandTotal.toLocaleString('en-IN')"></span>
                                </div>
                            </div>

                            @auth
                            <button type="submit" class="btn-luxury w-full py-6 text-sm flex items-center justify-center space-x-3">
                                <span>Reserve Expedition</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="btn-luxury w-full py-6 text-sm flex items-center justify-center space-x-3">
                                <span>Login to Reserve</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                            @endauth
                        </form>

                        @auth
                        <!-- Wishlist Toggle -->
                        <button onclick="toggleWishlist('TourPackage', {{ $package->id }}, this)" class="w-full mt-6 glass py-4 rounded-2xl text-center text-xs font-black text-slate-500 uppercase tracking-widest hover:text-rose-500 transition-colors flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            <span>Add to Wishlist</span>
                        </button>

                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                const span = btn.querySelector('span');
                span.textContent = data.status === 'added' ? 'Remove from Wishlist' : 'Add to Wishlist';
                btn.classList.toggle('text-rose-500', data.status === 'added');
            });
        }
    </script>
    @endauth
</x-app-layout>
