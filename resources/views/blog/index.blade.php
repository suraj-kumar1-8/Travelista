<x-app-layout>
    <!-- Magazine Header -->
    <section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="">
            <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm"></div>
        </div>
        <div class="relative z-10 text-center max-w-4xl mx-auto px-4" data-aos="fade-up">
            <span class="inline-block px-6 py-2 glass rounded-full text-[10px] font-black uppercase tracking-[0.4em] text-blue-400 mb-8">
                The Travel Journal
            </span>
            <h1 class="text-6xl md:text-8xl font-black text-white mb-8 uppercase tracking-tighter leading-tight">Stories from <br> <span class="text-blue-600 italic">the Edge</span></h1>
            <p class="text-xl text-slate-400 font-medium">Insights, guides, and inspiration for the modern luxury traveler.</p>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="py-32 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16">
                @foreach($blogs as $blog)
                <div class="group cursor-pointer" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative h-[450px] rounded-[3.5rem] overflow-hidden mb-10 shadow-2xl border border-white/5">
                        <img src="{{ $blog->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                        <div class="absolute top-8 left-8">
                            <span class="px-5 py-2 glass rounded-xl text-[10px] font-black uppercase tracking-widest text-white">Adventure</span>
                        </div>
                    </div>
                    <div class="px-4">
                        <div class="flex items-center space-x-4 mb-6">
                            <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest">{{ $blog->created_at->format('M d, Y') }}</p>
                            <div class="w-px h-3 bg-white/20"></div>
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">5 Min Read</p>
                        </div>
                        <h3 class="text-3xl font-black text-white mb-6 uppercase tracking-tighter group-hover:text-blue-600 transition-colors leading-tight">
                            {{ $blog->title }}
                        </h3>
                        <p class="text-slate-500 font-medium leading-relaxed mb-8 line-clamp-3">
                            {{ Str::limit($blog->content, 150) }}
                        </p>
                        <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center space-x-3 text-xs font-black uppercase tracking-widest text-white group-hover:translate-x-2 transition-transform">
                            <span>Read Narrative</span>
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-24">
                {{ $blogs->links() }}
            </div>
        </div>
    </section>

    <!-- Newsletter Integration -->
    <section class="py-32 bg-slate-900/40">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <div class="glass p-20 rounded-[4rem] border-white/5 relative overflow-hidden" data-aos="zoom-in">
                <h2 class="text-4xl font-black text-white mb-8 uppercase tracking-tighter">Never Miss a <span class="text-blue-600 italic">Narrative</span></h2>
                <p class="text-slate-400 mb-12 max-w-lg mx-auto font-medium">Join 50k+ luxury travelers receiving our weekly journal entries on the world's most exclusive destinations.</p>
                <div class="flex flex-col md:flex-row gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="Your premium email" class="flex-grow bg-white/5 border-none rounded-2xl px-8 py-5 text-white placeholder-slate-600 focus:ring-2 focus:ring-blue-600 font-bold transition-all">
                    <button class="btn-luxury px-10">Subscribe</button>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
