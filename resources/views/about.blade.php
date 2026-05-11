<x-app-layout>
    <!-- Header -->
    <section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1548013146-72479768bbaa?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="">
            <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm"></div>
        </div>
        <div class="relative z-10 text-center px-4" data-aos="fade-up">
            <span class="inline-block px-6 py-2 glass rounded-full text-[10px] font-black uppercase tracking-[0.5em] text-blue-400 mb-8">The Legacy</span>
            <h1 class="text-6xl md:text-8xl font-black text-white uppercase tracking-tighter leading-none mb-6">Redefining <br> <span class="text-blue-600 italic">Hospitality</span></h1>
            <p class="text-xl text-slate-400 font-medium max-w-3xl mx-auto">Travelista is India's leading luxury travel curator, dedicated to uncovering the subcontinent's most exclusive secrets.</p>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-32 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
                <div data-aos="fade-right">
                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.4em] mb-6 block">Our Mission</span>
                    <h2 class="text-5xl font-black text-white uppercase tracking-tighter mb-8 leading-none">Elevating the <span class="text-blue-600 italic">Indian Experience</span></h2>
                    <p class="text-xl text-slate-400 font-medium leading-relaxed mb-12">
                        Our journey began with a simple vision: to showcase the unparalleled beauty of India through a lens of absolute luxury. We believe that true travel is about the narratives we craft and the emotions we evoke.
                    </p>
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-xl font-black text-white uppercase tracking-tighter mb-4">The Vision</h4>
                            <p class="text-slate-500 text-sm font-medium">To become the global gold standard for Indian luxury travel curation.</p>
                        </div>
                        <div>
                            <h4 class="text-xl font-black text-white uppercase tracking-tighter mb-4">The Promise</h4>
                            <p class="text-slate-500 text-sm font-medium">Uncompromising quality, private access, and world-class concierge service.</p>
                        </div>
                    </div>
                </div>
                <div class="relative" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&q=80&w=1200" class="rounded-[4rem] h-[600px] w-full object-cover shadow-2xl" alt="">
                    <div class="absolute -bottom-10 -left-10 glass p-12 rounded-[3.5rem] border-white/5 shadow-2xl">
                        <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-4">Experience Matters</p>
                        <h4 class="text-5xl font-black text-white tracking-tighter italic">12 <span class="text-blue-600">Years</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Masterminds (3 Members Only) -->
    <section class="py-32 bg-slate-900/30">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.4em] mb-6 block">The Architects</span>
            <h2 class="text-5xl font-black text-white uppercase tracking-tighter mb-24">Meet the <span class="text-blue-600 italic">Curators</span></h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                @foreach([
                    ['name' => 'Aditya Verma', 'role' => 'Chief Curator', 'image' => 'https://ui-avatars.com/api/?name=Aditya+Verma&background=0f172a&color=fff&size=512'],
                    ['name' => 'Ishani Singh', 'role' => 'Experience Designer', 'image' => 'https://ui-avatars.com/api/?name=Ishani+Singh&background=0f172a&color=fff&size=512'],
                    ['name' => 'Vikram Seth', 'role' => 'Head of Concierge', 'image' => 'https://ui-avatars.com/api/?name=Vikram+Seth&background=0f172a&color=fff&size=512']
                ] as $member)
                <div class="group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative rounded-[4rem] overflow-hidden mb-10 h-[450px]">
                        <img src="{{ $member['image'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $member['name'] }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                        <div class="absolute bottom-10 left-0 right-0">
                            <div class="flex justify-center space-x-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                @foreach(['linkedin', 'twitter', 'instagram'] as $social)
                                <a href="#" class="w-12 h-12 glass rounded-2xl flex items-center justify-center text-white hover:bg-blue-600 transition-all">
                                    <i class="fab fa-{{ $social }}"></i>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <h3 class="text-3xl font-black text-white uppercase tracking-tighter mb-2 group-hover:text-blue-600 transition-colors">{{ $member['name'] }}</h3>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $member['role'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Indian Tourism Statistics -->
    <section class="py-32 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4">
            <div class="glass p-20 rounded-[5rem] border-white/5 grid grid-cols-2 lg:grid-cols-4 gap-12 text-center">
                @foreach([
                    ['label' => 'Indian States Covered', 'value' => '28'],
                    ['label' => 'Luxury Partners', 'value' => '150+'],
                    ['label' => 'Happy Travelers', 'value' => '12K+'],
                    ['label' => 'Annual Expeditions', 'value' => '450+']
                ] as $stat)
                <div>
                    <h4 class="text-5xl font-black text-white mb-4 tracking-tighter">{{ $stat['value'] }}</h4>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
