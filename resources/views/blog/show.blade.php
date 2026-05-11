<x-app-layout>
    <div class="pt-20">
        <!-- Article Header -->
        <article>
            <header class="py-24 bg-white dark:bg-slate-950 transition-colors duration-500">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <div data-aos="fade-up">
                        <div class="flex items-center justify-center space-x-4 mb-8">
                            <span class="px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold rounded-xl uppercase tracking-widest">Travel Journal</span>
                            <span class="text-slate-400 text-sm">{{ $blog->created_at->format('M d, Y') }}</span>
                        </div>
                        <h1 class="text-4xl md:text-6xl font-black text-slate-900 dark:text-white mb-8 leading-tight uppercase tracking-tighter">
                            {{ $blog->title }}
                        </h1>
                        <div class="flex items-center justify-center space-x-4">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=0f172a&color=fff" class="w-12 h-12 rounded-full" alt="">
                            <div class="text-left">
                                <p class="font-bold text-slate-900 dark:text-white uppercase tracking-widest text-xs">Travelista Team</p>
                                <p class="text-[10px] text-slate-500 uppercase tracking-widest">Premium Curator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10" data-aos="zoom-in" data-aos-delay="200">
                <div class="aspect-[21/9] rounded-[4rem] overflow-hidden shadow-2xl border border-white/10">
                    <img src="{{ $blog->image_url }}" class="w-full h-full object-cover" alt="{{ $blog->title }}">
                </div>
            </div>

            <!-- Content -->
            <div class="py-24 bg-white dark:bg-slate-950">
                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:font-black prose-headings:text-slate-900 dark:prose-headings:text-white prose-p:text-slate-600 dark:prose-p:text-slate-400 prose-a:text-blue-600 font-medium leading-relaxed" data-aos="fade-up">
                        {!! nl2br(e($blog->content)) !!}
                    </div>

                    <!-- Share & Tags -->
                    <div class="mt-20 pt-10 border-t border-slate-100 dark:border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-6" data-aos="fade-up">
                        <div class="flex items-center space-x-2">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mr-2">Explore:</span>
                            <a href="#" class="px-5 py-2 rounded-xl bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all">Adventure</a>
                            <a href="#" class="px-5 py-2 rounded-xl bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400 text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-all">Luxury</a>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Share:</span>
                            <div class="flex space-x-3">
                                <a href="#" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-900 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-blue-600 hover:text-white transition-all shadow-lg"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <!-- Call to Action -->
        <section class="py-32 bg-slate-950">
            <div class="max-w-7xl mx-auto px-4">
                <div class="glass p-20 rounded-[4rem] border-white/5 relative overflow-hidden text-center" data-aos="zoom-in">
                    <h2 class="text-4xl font-black text-white mb-8 uppercase tracking-tighter">Ready to <span class="text-blue-600 italic">Experience</span> This?</h2>
                    <p class="text-slate-400 mb-12 max-w-lg mx-auto font-medium">Turn these stories into your reality. Book your custom journey with our curators today.</p>
                    <a href="{{ route('destinations.index') }}" class="btn-luxury px-12">Start Your Journey</a>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
