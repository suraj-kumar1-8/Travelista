<x-app-layout>
    <div class="min-h-screen bg-slate-950 pt-48 pb-32 relative overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute top-0 right-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
        <div class="absolute top-1/4 -right-24 w-96 h-96 bg-blue-600/10 rounded-full blur-[150px]"></div>
        <div class="absolute bottom-1/4 -left-24 w-96 h-96 bg-purple-600/10 rounded-full blur-[150px]"></div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center mb-20" data-aos="fade-down">
                <span class="text-[11px] font-black uppercase tracking-[0.6em] text-blue-500 mb-6 block">Concierge Desk</span>
                <h1 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter leading-tight mb-6">Get In <span class="text-blue-600 italic">Touch</span></h1>
                <p class="text-lg text-slate-400 max-w-2xl mx-auto font-medium">Our expert travel curators are available 24/7 to help you design your perfect luxury escape.</p>
            </div>

            <!-- Top Section: Contact Info & Form -->
            <div class="flex flex-col lg:flex-row gap-12 mb-32">
                <!-- Contact Info Cards -->
                <div class="w-full lg:w-1/3 space-y-6" data-aos="fade-right">
                    <div class="glass p-8 rounded-[2.5rem] border-white/5 group hover:border-blue-600/30 transition-all duration-500 flex items-center space-x-6">
                        <div class="w-12 h-12 bg-blue-600/10 text-blue-500 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-white mb-1 uppercase tracking-tighter">Direct Line</h4>
                            <p class="text-slate-400 text-xs font-bold tracking-widest">+1 (888) TRAVEL-LUXE</p>
                        </div>
                    </div>

                    <div class="glass p-8 rounded-[2.5rem] border-white/5 group hover:border-purple-600/30 transition-all duration-500 flex items-center space-x-6">
                        <div class="w-12 h-12 bg-purple-600/10 text-purple-500 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-purple-600 group-hover:text-white transition-all shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-white mb-1 uppercase tracking-tighter">Global Email</h4>
                            <p class="text-slate-400 text-xs font-bold tracking-widest">concierge@travelista.com</p>
                        </div>
                    </div>

                    <div class="glass p-8 rounded-[2.5rem] border-white/5 group hover:border-emerald-600/30 transition-all duration-500 flex items-center space-x-6">
                        <div class="w-12 h-12 bg-emerald-600/10 text-emerald-500 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-white mb-1 uppercase tracking-tighter">Luxury Hub</h4>
                            <p class="text-slate-400 text-xs font-bold tracking-widest">Lux Square, Global City, Earth</p>
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="glass p-8 rounded-[2.5rem] border-white/5 pt-8 text-center">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-6">Connect With Us</p>
                        <div class="flex items-center justify-center space-x-4">
                            @foreach(['facebook', 'twitter', 'instagram', 'linkedin'] as $social)
                            <a href="#" class="w-10 h-10 bg-white/5 rounded-full flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-all">
                                <span class="sr-only">{{ ucfirst($social) }}</span>
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 2C6.477 2 2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12c0-5.523-4.477-10-10-10z"></path>
                                </svg>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="w-full lg:w-2/3" data-aos="fade-left">
                    <div class="glass p-10 lg:p-16 rounded-[3.5rem] border-white/5 relative overflow-hidden shadow-2xl">
                        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-600 to-purple-600"></div>
                        
                        @if(session('success'))
                            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-sm font-bold text-center">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-2xl text-sm font-bold text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.send') }}" method="POST" class="space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2 group">
                                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-2 group-focus-within:text-blue-500 transition-colors">Your Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold placeholder-slate-600" placeholder="Alexander Graham" required>
                                    @error('name')<span class="text-xs text-red-400 font-bold px-2">{{ $message }}</span>@enderror
                                </div>
                                <div class="space-y-2 group">
                                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-2 group-focus-within:text-blue-500 transition-colors">Email Address</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold placeholder-slate-600" placeholder="alex@premium.com" required>
                                    @error('email')<span class="text-xs text-red-400 font-bold px-2">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="space-y-2 group">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-2 group-focus-within:text-blue-500 transition-colors">Subject</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold placeholder-slate-600" placeholder="Designing My Next Adventure">
                                @error('subject')<span class="text-xs text-red-400 font-bold px-2">{{ $message }}</span>@enderror
                            </div>

                            <div class="space-y-2 group">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-2 group-focus-within:text-blue-500 transition-colors">Message</label>
                                <textarea name="message" rows="5" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold placeholder-slate-600" placeholder="Tell us about your dream destination..." required>{{ old('message') }}</textarea>
                                @error('message')<span class="text-xs text-red-400 font-bold px-2">{{ $message }}</span>@enderror
                            </div>

                            <button type="submit" class="btn-luxury w-full py-5 text-sm shadow-lg shadow-blue-500/20">Send Inquiry</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Interactive Map Section -->
            <div class="mb-32" data-aos="fade-up">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Global <span class="text-blue-600 italic">Headquarters</span></h2>
                </div>
                <div class="glass p-4 rounded-[3.5rem] border-white/5 shadow-2xl h-[500px] relative overflow-hidden">
                    <div id="map" class="w-full h-full rounded-[3rem] z-0 relative"></div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="max-w-4xl mx-auto" x-data="{ active: null }" data-aos="fade-up">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Common <span class="text-blue-600 italic">Queries</span></h2>
                </div>
                <div class="space-y-4">
                    @foreach([
                        ['q' => 'How quickly will a curator respond to my inquiry?', 'a' => 'Our dedicated concierge team operates 24/7 and typically responds within 2-4 hours to all luxury expedition inquiries.'],
                        ['q' => 'Do you handle bespoke corporate travel?', 'a' => 'Yes, we specialize in organizing elite corporate retreats, board meetings, and incentive travel programs globally.'],
                        ['q' => 'Can I request a callback instead of email?', 'a' => 'Absolutely. Simply include your phone number and preferred time zone in the message body.'],
                    ] as $index => $faq)
                    <div class="glass rounded-3xl border-white/5 overflow-hidden transition-all duration-300">
                        <button @click="active = active === {{ $index }} ? null : {{ $index }}" class="w-full p-8 flex items-center justify-between text-left hover:bg-white/5 transition-colors">
                            <span class="text-base font-black text-white uppercase tracking-tighter">{{ $faq['q'] }}</span>
                            <div class="w-8 h-8 glass rounded-xl flex items-center justify-center text-blue-500 transform transition-transform duration-500" :class="active === {{ $index }} ? 'rotate-180' : ''">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </button>
                        <div x-show="active === {{ $index }}" x-collapse>
                            <div class="px-8 pb-8 pt-2">
                                <p class="text-slate-400 font-medium text-sm leading-relaxed">{{ $faq['a'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([28.6139, 77.2090], 5); // Focused on India

            L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                subdomains: 'abcd',
                maxZoom: 20
            }).addTo(map);

            var customIcon = L.divIcon({
                className: 'custom-div-icon',
                html: "<div class='w-6 h-6 bg-blue-600 rounded-full border-4 border-slate-900 shadow-[0_0_15px_rgba(37,99,235,0.8)]'></div>",
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            });

            L.marker([28.6139, 77.2090], {icon: customIcon}).addTo(map)
                .bindPopup('<div class="text-slate-900 font-bold p-2 text-center"><h3 class="uppercase tracking-widest text-xs text-blue-600">Travelista HQ</h3><p class="text-[10px]">New Delhi, India</p></div>');
            
            L.marker([19.0760, 72.8777], {icon: customIcon}).addTo(map)
                .bindPopup('<div class="text-slate-900 font-bold p-2 text-center"><h3 class="uppercase tracking-widest text-xs text-blue-600">Mumbai Hub</h3></div>');
        });
    </script>
    @endpush
</x-app-layout>
