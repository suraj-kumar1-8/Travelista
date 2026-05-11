<x-app-layout>
    <!-- Cinematic Header -->
    <section class="relative h-[65vh] overflow-hidden">
        <img src="{{ $hotel->image_url }}" class="w-full h-full object-cover animate-slow-zoom" alt="">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
        <div class="absolute bottom-20 left-0 right-0">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-8" data-aos="fade-up">
                    <div>
                        <div class="flex space-x-1 mb-6">
                            @for($i=0; $i<$hotel->star_rating; $i++)
                                <svg class="w-5 h-5 text-yellow-500 fill-current shadow-[0_0_10px_#eab308]" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endfor
                        </div>
                        <h1 class="text-6xl md:text-8xl font-black text-white uppercase tracking-tighter leading-none mb-6">{{ $hotel->name }}</h1>
                        <div class="flex items-center space-x-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-600/20 rounded-xl flex items-center justify-center border border-blue-600/30">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                </div>
                                <span class="text-sm font-bold text-slate-300 uppercase tracking-widest">{{ $hotel->location }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-24 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 flex flex-col lg:flex-row gap-16">
            <!-- Left Side -->
            <div class="w-full lg:w-2/3 space-y-20">
                <!-- Image Gallery -->
                @if($hotel->images)
                <div data-aos="fade-up" class="mb-20">
                    <h3 class="text-2xl font-black text-white mb-10 uppercase tracking-tighter">Photo <span class="text-blue-600 italic">Gallery</span></h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach(json_decode($hotel->images, true) as $img)
                            <div class="h-48 overflow-hidden rounded-3xl border border-white/5">
                                <img src="{{ asset($img) }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-700 cursor-pointer" alt="Hotel Image">
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Amenities -->
                <div data-aos="fade-up">
                    <h3 class="text-2xl font-black text-white mb-10 uppercase tracking-tighter">Premium <span class="text-blue-600 italic">Amenities</span></h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach(['Infinity Pool', 'Luxury Spa', 'Fine Dining', 'Fitness Center', 'Private Beach', '24/7 Concierge', 'Valet Parking', 'Smart Rooms'] as $amenity)
                        <div class="glass p-6 rounded-3xl border-white/5 text-center group hover:border-blue-600/30 transition-all duration-500">
                            <div class="w-12 h-12 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-600 transition-colors">
                                <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-white transition-colors">{{ $amenity }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Rooms -->
                <div data-aos="fade-up">
                    <h3 class="text-2xl font-black text-white mb-10 uppercase tracking-tighter">Luxury <span class="text-blue-600 italic">Suites</span></h3>
                    <div class="space-y-8">
                        @foreach(['Presidential Suite', 'Deluxe Ocean Room', 'Panoramic View Room'] as $room)
                        <div class="glass flex flex-col md:flex-row rounded-[3rem] overflow-hidden border-white/5 group hover:border-blue-600/30 transition-all duration-700">
                            <div class="w-full md:w-1/3 h-56 md:h-auto overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&q=80&w=600" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" alt="">
                            </div>
                            <div class="p-10 flex-grow">
                                <h4 class="text-2xl font-black text-white mb-2 uppercase tracking-tighter">{{ $room }}</h4>
                                <p class="text-sm text-slate-400 mb-8 font-medium">Experience unprecedented luxury with panoramic views and bespoke services.</p>
                                <div class="flex items-center justify-between pt-6 border-t border-white/5">
                                    <div class="flex space-x-4">
                                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">King Size</span>
                                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">WIFI</span>
                                    </div>
                                    <span class="text-xs font-black text-blue-600 uppercase tracking-widest">Selected</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Side: Booking Card -->
            <div class="w-full lg:w-1/3">
                <div class="sticky top-32 glass p-10 rounded-[3.5rem] border border-blue-600/20 shadow-2xl shadow-blue-600/10" data-aos="fade-left">
                    <div class="flex items-center justify-between mb-10">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Daily Rate</p>
                        <p class="text-5xl font-black text-white tracking-tighter">${{ number_format($hotel->price_per_night) }}<span class="text-xs text-slate-500 tracking-normal ml-1">/night</span></p>
                    </div>

                            <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm" class="space-y-8" x-data="hotelBooking({{ $hotel->price_per_night }})">
                                @csrf
                                <input type="hidden" name="bookable_type" value="Hotel">
                                <input type="hidden" name="bookable_id" value="{{ $hotel->id }}">
                                <input type="hidden" name="nights" x-model="nights">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Check-In</label>
                                        <input type="date" name="start_date" x-model="startDate" @change="calculateNights" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold">
                                    </div>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Check-Out</label>
                                        <input type="date" name="end_date" x-model="endDate" @change="calculateNights" required min="{{ date('Y-m-d', strtotime('+2 days')) }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold">
                                    </div>
                                </div>
                                <div class="space-y-3 mb-8">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Travelers</label>
                                    <input type="number" name="travelers" x-model="travelers" required min="1" max="10" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold">
                                </div>

                                <!-- Dynamic Price Summary -->
                                <div class="glass p-6 rounded-2xl border-white/5 space-y-4 mb-8">
                                    <div class="flex justify-between text-xs font-bold text-slate-400">
                                        <span>Rate per night</span>
                                        <span class="text-white">₹{{ number_format($hotel->price_per_night) }}</span>
                                    </div>
                                    <div class="flex justify-between text-xs font-bold text-slate-400">
                                        <span>Nights</span>
                                        <span class="text-white" x-text="nights"></span>
                                    </div>
                                    <div class="flex justify-between text-xs font-bold text-slate-400">
                                        <span>Travelers</span>
                                        <span class="text-white" x-text="travelers"></span>
                                    </div>
                                    <div class="border-t border-white/10 pt-4 flex justify-between">
                                        <span class="text-sm font-black text-white uppercase tracking-widest">Total</span>
                                        <span class="text-2xl font-black text-blue-500" x-text="'₹' + (price * nights * travelers).toLocaleString('en-IN')"></span>
                                    </div>
                                </div>

                                @auth
                                <button type="submit" class="btn-luxury w-full py-6 text-sm flex items-center justify-center space-x-3">
                                    <span>Reserve Your Stay</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                                @else
                                <a href="{{ route('login') }}" class="btn-luxury w-full py-6 text-sm flex items-center justify-center space-x-3">
                                    <span>Login to Reserve</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                                @endauth
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('hotelBooking', (price) => ({
                        price: price,
                        travelers: 1,
                        startDate: '',
                        endDate: '',
                        nights: 1,
                        calculateNights() {
                            if (this.startDate && this.endDate) {
                                const start = new Date(this.startDate);
                                const end = new Date(this.endDate);
                                const diffTime = Math.abs(end - start);
                                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                                this.nights = diffDays > 0 ? diffDays : 1;
                            }
                        }
                    }))
                })
            </script>

    <style>
        @keyframes slow-zoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }
        .animate-slow-zoom {
            animation: slow-zoom 20s ease-in-out infinite alternate;
        }
    </style>
</x-app-layout>
