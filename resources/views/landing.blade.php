<x-app-layout>
    <!-- Hero Section -->
    <section id="hero" class="relative h-screen flex items-center justify-center overflow-hidden" 
             x-data="{ activeSlide: 0, 
                       slides: [
                           'https://images.unsplash.com/photo-1595815771614-ade9d652a65d?auto=format&fit=crop&q=80&w=2000',
                           'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&q=80&w=2000',
                           'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&q=80&w=2000',
                           'https://images.unsplash.com/photo-1506461883276-594a12b11cc3?auto=format&fit=crop&q=80&w=2000'
                       ] }"
             x-init="setInterval(() => { activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1 }, 6000)">
        
        <!-- Dynamic Cinematic Slideshow Background -->
        <div class="absolute inset-0 z-0">
            <template x-for="(slide, index) in slides" :key="index">
                <img :src="slide" 
                     class="absolute inset-0 w-full h-full object-cover transition-opacity duration-[2000ms] ease-in-out"
                     :class="activeSlide === index ? 'opacity-100 scale-105 transition-transform duration-[15000ms]' : 'opacity-0'" 
                     alt="Luxury India Landscape">
            </template>
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/70 via-slate-950/40 to-slate-950/90"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-6xl mx-auto w-full mt-24" data-aos="zoom-in">
            <span class="inline-block px-8 py-2.5 glass rounded-full text-[10px] font-black uppercase tracking-[0.6em] text-blue-400 mb-8 border border-blue-400/20 shadow-2xl shadow-blue-500/20">The Premier Indian Travel SaaS</span>
            
            <h1 class="text-5xl md:text-8xl lg:text-9xl font-black text-white uppercase tracking-tighter leading-none mb-10 drop-shadow-2xl">
                BEYOND <br> <span class="text-blue-500 italic drop-shadow-[0_0_15px_rgba(59,130,246,0.5)]">BOUNDARIES</span>
            </h1>
            
            <p class="max-w-2xl mx-auto text-slate-300 font-medium text-lg md:text-xl mb-12 leading-relaxed tracking-wide">
                Experience India's most exclusive destinations through a highly automated, premium booking ecosystem designed for the modern elite traveler.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="#about" class="btn-luxury px-6 py-4 rounded-full text-xs font-black uppercase tracking-widest flex items-center shadow-lg shadow-blue-500/20 hover:scale-105 transition-transform duration-300">
                    <svg class="w-4 h-4 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Explore Story</span>
                </a>
                <a href="{{ route('login') }}" class="glass hover:bg-white/10 text-white font-black text-xs uppercase tracking-widest px-6 py-4 rounded-full border border-white/20 hover:border-white/30 transition-all duration-300 flex items-center hover:scale-105">
                    <svg class="w-4 h-4 mr-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-2-2m0 0l2-2m-2 2h8m-9 4h10a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>Sign In</span>
                </a>
                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-black text-xs uppercase tracking-widest px-6 py-4 rounded-full shadow-lg shadow-blue-600/30 transition-all duration-300 flex items-center hover:scale-105">
                    <svg class="w-4 h-4 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    <span>Register Now</span>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-32 bg-slate-950 relative overflow-hidden">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/5 rounded-full blur-[100px]"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="lg:w-1/2 space-y-8" data-aos="fade-right">
                    <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.4em] block">Our Mission</span>
                    <h2 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter">India’s Smartest <br><span class="text-blue-500 italic">Travel Ecosystem</span></h2>
                    <p class="text-slate-400 font-medium leading-relaxed text-lg">
                        TRAVELISTA is a luxury India-focused travel automation platform. We merge premium boutique destinations and hospitality with cutting-edge SaaS technology to orchestrate unforgettable journeys across the subcontinent.
                    </p>
                    <p class="text-slate-400 font-medium leading-relaxed">
                        From custom AI-driven expense estimation to curated heritage tour packages, TRAVELISTA offers end-to-end booking mechanics, transactional transparency, and elite concierge services in a beautiful glassmorphic experience.
                    </p>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-tr from-blue-600 to-emerald-500 rounded-[3rem] rotate-3 blur-sm opacity-20"></div>
                        <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?auto=format&fit=crop&q=80&w=1200" 
                             class="rounded-[3rem] relative z-10 border border-white/10 shadow-2xl object-cover h-[500px] w-full" 
                             alt="Luxury Taj Mahal Gateway">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-32 bg-slate-950/95 relative overflow-hidden border-t border-white/5">
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-emerald-500/5 rounded-full blur-[100px]"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-24" data-aos="fade-up">
                <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.4em] block mb-4">SaaS Utilities</span>
                <h2 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter">AUTOMATING YOUR <span class="text-blue-500 italic">WANDERLUST</span></h2>
                <p class="text-slate-400 font-medium mt-6">Discover the powerful custom modules driving our advanced luxury travel platform.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="glass p-10 rounded-[3.5rem] border-white/5 hover:border-blue-500/20 transition-all duration-500 group hover:-translate-y-2 shadow-xl" data-aos="fade-up">
                    <div class="w-14 h-14 bg-blue-600/10 rounded-2xl flex items-center justify-center text-blue-500 mb-8 group-hover:bg-blue-600 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-white uppercase tracking-widest mb-4">Luxury Stays</h3>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">Book elite Heritage Havelis, private beach villas, and certified five-star resorts in our verified domestic hotel directory.</p>
                </div>

                <!-- Feature 2 -->
                <div class="glass p-10 rounded-[3.5rem] border-white/5 hover:border-emerald-500/20 transition-all duration-500 group hover:-translate-y-2 shadow-xl" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-500 mb-8 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-white uppercase tracking-widest mb-4">Tour Packages</h3>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">Curated luxury itineraries containing professional guides, private luxury transit, and premium regional accommodations.</p>
                </div>

                <!-- Feature 3 -->
                <div class="glass p-10 rounded-[3.5rem] border-white/5 hover:border-purple-500/20 transition-all duration-500 group hover:-translate-y-2 shadow-xl" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-500 mb-8 group-hover:bg-purple-600 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-white uppercase tracking-widest mb-4">Trip Planner</h3>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">Input your destination and budget preferences and generate a dynamic multi-day Indian travel plan in seconds.</p>
                </div>

                <!-- Feature 4 -->
                <div class="glass p-10 rounded-[3.5rem] border-white/5 hover:border-amber-500/20 transition-all duration-500 group hover:-translate-y-2 shadow-xl" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 bg-amber-500/10 rounded-2xl flex items-center justify-center text-amber-400 mb-8 group-hover:bg-amber-500 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-white uppercase tracking-widest mb-4">Expense Estimator</h3>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">Estimate regional transport, dining, lodging, and activity costs with precision standard Indian market pricing models.</p>
                </div>

                <!-- Feature 5 -->
                <div class="glass p-10 rounded-[3.5rem] border-white/5 hover:border-rose-500/20 transition-all duration-500 group hover:-translate-y-2 shadow-xl" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-14 h-14 bg-rose-500/10 rounded-2xl flex items-center justify-center text-rose-500 mb-8 group-hover:bg-rose-600 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-white uppercase tracking-widest mb-4">Wishlist Hub</h3>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">Save boutique destinations, grand palaces, and trending itineraries in a neat portal for future exploration.</p>
                </div>

                <!-- Feature 6 -->
                <div class="glass p-10 rounded-[3.5rem] border-white/5 hover:border-indigo-500/20 transition-all duration-500 group hover:-translate-y-2 shadow-xl" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-14 h-14 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-500 mb-8 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-white uppercase tracking-widest mb-4">Secure Billing</h3>
                    <p class="text-slate-400 text-sm font-medium leading-relaxed">Dynamic coupon code discounts, detailed automatic PDF invoices, and automated transactional email alerts.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Destinations Section -->
    <section id="destinations" class="py-32 bg-slate-950 relative overflow-hidden">
        <div class="absolute top-1/2 left-0 w-96 h-96 bg-blue-600/5 rounded-full blur-[120px] -translate-y-1/2"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row items-end justify-between mb-24" data-aos="fade-up">
                <div>
                    <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.4em] block mb-4">Elite Gateways</span>
                    <h2 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter">POPULAR <span class="text-blue-500 italic">DOMESTIC STAYS</span></h2>
                </div>
                <p class="text-slate-400 font-medium max-w-md mt-6 md:mt-0">Explore India's most highly-sought destinations curated by regional travel experts.</p>
            </div>

            <!-- Custom Premium Cards for 8 Destinations -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Kashmir -->
                <div class="group relative rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl h-96 hover:border-blue-500/30 transition-all duration-500 hover:scale-[1.02]" data-aos="fade-up">
                    <img src="https://images.unsplash.com/photo-1595815771614-ade9d652a65d?auto=format&fit=crop&q=80&w=800" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Kashmir">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="text-[9px] font-black text-blue-400 uppercase tracking-widest block mb-2">Paradise on Earth</span>
                        <h4 class="text-2xl font-black text-white uppercase tracking-tighter">Kashmir</h4>
                    </div>
                </div>

                <!-- Goa -->
                <div class="group relative rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl h-96 hover:border-blue-500/30 transition-all duration-500 hover:scale-[1.02]" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&q=80&w=800" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Goa">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="text-[9px] font-black text-blue-400 uppercase tracking-widest block mb-2">Pristine Coastlines</span>
                        <h4 class="text-2xl font-black text-white uppercase tracking-tighter">Goa</h4>
                    </div>
                </div>

                <!-- Rajasthan -->
                <div class="group relative rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl h-96 hover:border-blue-500/30 transition-all duration-500 hover:scale-[1.02]" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&q=80&w=800" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Rajasthan">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="text-[9px] font-black text-blue-400 uppercase tracking-widest block mb-2">Grand Forts & Palaces</span>
                        <h4 class="text-2xl font-black text-white uppercase tracking-tighter">Rajasthan</h4>
                    </div>
                </div>

                <!-- Kerala -->
                <div class="group relative rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl h-96 hover:border-blue-500/30 transition-all duration-500 hover:scale-[1.02]" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&q=80&w=800" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Kerala">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="text-[9px] font-black text-blue-400 uppercase tracking-widest block mb-2">Serene Backwaters</span>
                        <h4 class="text-2xl font-black text-white uppercase tracking-tighter">Kerala</h4>
                    </div>
                </div>

                <!-- Himachal -->
                <div class="group relative rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl h-96 hover:border-blue-500/30 transition-all duration-500 hover:scale-[1.02]" data-aos="fade-up" data-aos-delay="400">
                    <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?auto=format&fit=crop&q=80&w=800" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Himachal">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="text-[9px] font-black text-blue-400 uppercase tracking-widest block mb-2">Snow-Capped Peaks</span>
                        <h4 class="text-2xl font-black text-white uppercase tracking-tighter">Himachal</h4>
                    </div>
                </div>

                <!-- Ladakh -->
                <div class="group relative rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl h-96 hover:border-blue-500/30 transition-all duration-500 hover:scale-[1.02]" data-aos="fade-up" data-aos-delay="500">
                    <img src="https://images.unsplash.com/photo-1506461883276-594a12b11cc3?auto=format&fit=crop&q=80&w=800" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Ladakh">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="text-[9px] font-black text-blue-400 uppercase tracking-widest block mb-2">High Altitude Lakes</span>
                        <h4 class="text-2xl font-black text-white uppercase tracking-tighter">Ladakh</h4>
                    </div>
                </div>

                <!-- Andaman -->
                <div class="group relative rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl h-96 hover:border-blue-500/30 transition-all duration-500 hover:scale-[1.02]" data-aos="fade-up" data-aos-delay="600">
                    <img src="https://images.unsplash.com/photo-1589136775685-1170848bc538?auto=format&fit=crop&q=80&w=800" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Andaman">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="text-[9px] font-black text-blue-400 uppercase tracking-widest block mb-2">Deep Ocean Coral Reefs</span>
                        <h4 class="text-2xl font-black text-white uppercase tracking-tighter">Andaman</h4>
                    </div>
                </div>

                <!-- Meghalaya -->
                <div class="group relative rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl h-96 hover:border-blue-500/30 transition-all duration-500 hover:scale-[1.02]" data-aos="fade-up" data-aos-delay="700">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&q=80&w=800" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Meghalaya">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-8 left-8 right-8">
                        <span class="text-[9px] font-black text-blue-400 uppercase tracking-widest block mb-2">Double Living Root Bridges</span>
                        <h4 class="text-2xl font-black text-white uppercase tracking-tighter">Meghalaya</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-32 bg-slate-950/95 relative overflow-hidden border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-24" data-aos="fade-up">
                <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.4em] block mb-4">Elite Benefits</span>
                <h2 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter">UNCOMPROMISING <span class="text-blue-500 italic">STANDARDS</span></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <!-- Benefit 1 -->
                <div class="flex items-start space-x-6" data-aos="fade-up">
                    <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-blue-500 flex-shrink-0 border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-white uppercase tracking-wider mb-2">Secure Escrow Checkout</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">Transactions are protected through fully automated, secure, and encrypted payment rails.</p>
                    </div>
                </div>

                <!-- Benefit 2 -->
                <div class="flex items-start space-x-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-blue-500 flex-shrink-0 border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-white uppercase tracking-wider mb-2">Premium Verified Hotels</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">Every property undergoes strict quality auditing for elite service, luxury, and safety standards.</p>
                    </div>
                </div>

                <!-- Benefit 3 -->
                <div class="flex items-start space-x-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-blue-500 flex-shrink-0 border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-white uppercase tracking-wider mb-2">Unparalleled Prices</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">Direct agency API relationships cut down middle-man commissions to offer pure, uninflated prices.</p>
                    </div>
                </div>

                <!-- Benefit 4 -->
                <div class="flex items-start space-x-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-blue-500 flex-shrink-0 border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-white uppercase tracking-wider mb-2">Custom AI Smart Tools</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">Our complex algorithms map Indian states and calculate multi-person itineraries instantly.</p>
                    </div>
                </div>

                <!-- Benefit 5 -->
                <div class="flex items-start space-x-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-blue-500 flex-shrink-0 border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-white uppercase tracking-wider mb-2">Instant Blueprint Plans</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">Get detailed recommendations for luxury hotels, boutique packages, and adventure activities immediately.</p>
                    </div>
                </div>

                <!-- Benefit 6 -->
                <div class="flex items-start space-x-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-12 h-12 bg-white/5 rounded-xl flex items-center justify-center text-blue-500 flex-shrink-0 border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-white uppercase tracking-wider mb-2">Dynamic Coupons & Offers</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">Unlock exclusive time-sensitive travel vouchers, discount codes, and special seasonal rebates.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-32 bg-slate-950 relative overflow-hidden">
        <div class="absolute bottom-0 left-1/2 w-96 h-96 bg-blue-600/5 rounded-full blur-[120px] -translate-x-1/2"></div>
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-24" data-aos="fade-up">
                <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.4em] block mb-4">Elite Endorsements</span>
                <h2 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tighter">TRUSTED BY <span class="text-blue-500 italic">LUXURY EXPLORERS</span></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="glass p-10 rounded-[3rem] border-white/5 flex flex-col justify-between" data-aos="fade-up">
                    <p class="text-slate-300 font-medium leading-relaxed italic mb-8">
                        "The level of personalization in the Trip Planner is unheard of. Travelista redefined how I explore India!"
                    </p>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center font-black text-white uppercase">AM</div>
                        <div>
                            <h4 class="text-sm font-black text-white uppercase tracking-widest">Arjun Mehta</h4>
                            <span class="text-[9px] text-slate-500 font-bold uppercase tracking-widest">SaaS Founder</span>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="glass p-10 rounded-[3rem] border-white/5 flex flex-col justify-between border-blue-500/20 shadow-xl" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-slate-300 font-medium leading-relaxed italic mb-8">
                        "Every detail from booking the Taj Mahal heritage suite to the local luxury tour guide was absolute perfection."
                    </p>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center font-black text-white uppercase">SJ</div>
                        <div>
                            <h4 class="text-sm font-black text-white uppercase tracking-widest">Sarah Jenkins</h4>
                            <span class="text-[9px] text-slate-500 font-bold uppercase tracking-widest">Travel Writer</span>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="glass p-10 rounded-[3rem] border-white/5 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                    <p class="text-slate-300 font-medium leading-relaxed italic mb-8">
                        "A flawless platform for busy executives who want premium domestic travel planned and estimated in under 5 minutes."
                    </p>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center font-black text-white uppercase">PS</div>
                        <div>
                            <h4 class="text-sm font-black text-white uppercase tracking-widest">Priyesh Sharma</h4>
                            <span class="text-[9px] text-slate-500 font-bold uppercase tracking-widest">Executive Director</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 bg-slate-950/95 border-t border-b border-white/5 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 text-center">
                <div data-aos="zoom-in">
                    <h3 class="text-5xl lg:text-6xl font-black text-blue-500 tracking-tighter mb-2">10K+</h3>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Happy Explorers</p>
                </div>
                <div data-aos="zoom-in" data-aos-delay="100">
                    <h3 class="text-5xl lg:text-6xl font-black text-emerald-400 tracking-tighter mb-2">150+</h3>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Heritage Gateways</p>
                </div>
                <div data-aos="zoom-in" data-aos-delay="200">
                    <h3 class="text-5xl lg:text-6xl font-black text-purple-400 tracking-tighter mb-2">500+</h3>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Verified Hotels</p>
                </div>
                <div data-aos="zoom-in" data-aos-delay="300">
                    <h3 class="text-5xl lg:text-6xl font-black text-white tracking-tighter mb-2">25K+</h3>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Active Bookings</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
