<footer class="bg-slate-950 pt-32 pb-12 relative overflow-hidden mt-auto">
    <!-- Background Decor -->
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px]"></div>
    <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-blue-600/5 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-24">
            <!-- Brand Column -->
            <div class="space-y-8" data-aos="fade-up">
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-600/30">
                        <span class="text-white font-black italic text-2xl">T</span>
                    </div>
                    <span class="text-3xl font-black text-white uppercase tracking-tighter">TRAVELISTA</span>
                </a>
                <p class="text-slate-500 font-medium leading-relaxed">
                    Defining the future of luxury travel through curated expeditions and unprecedented access to the world's most exclusive gateways.
                </p>
                <div class="flex items-center space-x-4">
                    @foreach(['facebook', 'twitter', 'instagram', 'linkedin'] as $social)
                    <a href="#" class="w-10 h-10 glass rounded-xl flex items-center justify-center text-slate-500 hover:text-white hover:bg-blue-600 transition-all">
                        <i class="fab fa-{{ $social }}"></i>
                        <span class="sr-only">{{ $social }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Exploration -->
            <div class="space-y-8" data-aos="fade-up" data-aos-delay="100">
                <h4 class="text-xs font-black text-white uppercase tracking-[0.3em]">Exploration</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('destinations.index') }}" class="text-sm font-bold text-slate-500 hover:text-blue-500 transition-colors uppercase tracking-widest">Destinations</a></li>
                    <li><a href="{{ route('packages.index') }}" class="text-sm font-bold text-slate-500 hover:text-blue-500 transition-colors uppercase tracking-widest">Tour Packages</a></li>
                    <li><a href="{{ route('hotels.index') }}" class="text-sm font-bold text-slate-500 hover:text-blue-500 transition-colors uppercase tracking-widest">Luxury Hotels</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-sm font-bold text-slate-500 hover:text-blue-500 transition-colors uppercase tracking-widest">Travel Journal</a></li>
                </ul>
            </div>

            <!-- Legacy -->
            <div class="space-y-8" data-aos="fade-up" data-aos-delay="200">
                <h4 class="text-xs font-black text-white uppercase tracking-[0.3em]">Legacy</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('about') }}" class="text-sm font-bold text-slate-500 hover:text-blue-500 transition-colors uppercase tracking-widest">Our Story</a></li>
                    <li><a href="{{ route('contact') }}" class="text-sm font-bold text-slate-500 hover:text-blue-500 transition-colors uppercase tracking-widest">Concierge Desk</a></li>
                    <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-blue-500 transition-colors uppercase tracking-widest">Privacy Policy</a></li>
                    <li><a href="#" class="text-sm font-bold text-slate-500 hover:text-blue-500 transition-colors uppercase tracking-widest">Terms of Service</a></li>
                </ul>
            </div>

            <!-- Headquarters -->
            <div class="space-y-8" data-aos="fade-up" data-aos-delay="300">
                <h4 class="text-xs font-black text-white uppercase tracking-[0.3em]">Headquarters</h4>
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-blue-500 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        </div>
                        <p class="text-sm font-bold text-slate-500 leading-relaxed uppercase tracking-widest">Lux Square, 101 <br> Global City, Earth</p>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center text-emerald-500 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-sm font-bold text-slate-500 leading-relaxed uppercase tracking-widest">concierge@travelista.com</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-8">
            <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.3em]">
                &copy; {{ date('Y') }} TRAVELISTA. All Rights Reserved. Designed for the elite.
            </p>
            <div class="flex items-center space-x-8">
                <img src="https://www.svgrepo.com/show/508713/visa.svg" class="h-4 opacity-20 grayscale hover:opacity-100 hover:grayscale-0 transition-all" alt="">
                <img src="https://www.svgrepo.com/show/508699/mastercard.svg" class="h-4 opacity-20 grayscale hover:opacity-100 hover:grayscale-0 transition-all" alt="">
                <img src="https://www.svgrepo.com/show/443444/razorpay.svg" class="h-4 opacity-20 grayscale hover:opacity-100 hover:grayscale-0 transition-all" alt="">
            </div>
        </div>
    </div>
</footer>
