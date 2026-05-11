<nav x-data="{ mobileMenu: false, scrolled: false }" 
     @scroll.window="scrolled = window.pageYOffset > 20"
     :class="scrolled ? 'bg-slate-950/80 backdrop-blur-2xl py-4 border-b border-white/5' : 'bg-transparent py-8'"
     class="fixed top-0 left-0 right-0 z-[100] transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <!-- Brand Identity -->
            <div class="flex items-center space-x-12">
                <a href="{{ route('home') }}" class="group flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center group-hover:rotate-[360deg] transition-transform duration-700 shadow-lg shadow-blue-600/30">
                        <span class="text-white font-black italic text-xl">T</span>
                    </div>
                    <span class="text-2xl font-black text-white uppercase tracking-tighter group-hover:text-blue-500 transition-colors">TRAVELISTA</span>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden lg:flex items-center space-x-8">
                    <x-nav-link-premium href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-nav-link-premium>
                    <x-nav-link-premium href="{{ route('about') }}" :active="request()->routeIs('about')">About</x-nav-link-premium>
                    <x-nav-link-premium href="{{ route('destinations.index') }}" :active="request()->routeIs('destinations.index')">Destinations</x-nav-link-premium>
                    <x-nav-link-premium href="{{ route('packages.index') }}" :active="request()->routeIs('packages.index')">Packages</x-nav-link-premium>
                    <x-nav-link-premium href="{{ route('hotels.index') }}" :active="request()->routeIs('hotels.index')">Hotels</x-nav-link-premium>
                    <x-nav-link-premium href="{{ route('blog.index') }}" :active="request()->routeIs('blog.index')">Journal</x-nav-link-premium>
                    <x-nav-link-premium href="{{ route('contact') }}" :active="request()->routeIs('contact')">Contact</x-nav-link-premium>
                </div>
            </div>

            <!-- Auth / Actions -->
            <div class="hidden lg:flex items-center space-x-6">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-3 glass pl-2 pr-4 py-2 rounded-2xl border-white/10 hover:bg-white/5 transition-all">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=3b82f6&color=fff" class="w-10 h-10 rounded-xl" alt="">
                            <span class="text-[10px] font-black text-white uppercase tracking-widest">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 text-slate-500" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute right-0 mt-4 w-64 glass rounded-[2.5rem] border-white/5 shadow-2xl p-6 z-50">
                            <div class="space-y-4">
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 text-[10px] font-black text-white uppercase tracking-widest hover:text-blue-500 transition-all">
                                        <div class="w-8 h-8 bg-blue-600/10 rounded-lg flex items-center justify-center text-blue-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></div>
                                        <span>Command Center</span>
                                    </a>
                                @endif
                                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-[10px] font-black text-white uppercase tracking-widest hover:text-blue-500 transition-all">
                                    <div class="w-8 h-8 bg-purple-600/10 rounded-lg flex items-center justify-center text-purple-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></div>
                                    <span>My Portfolio</span>
                                </a>
                                <div class="h-px bg-white/5 mx-2"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center space-x-3 text-[10px] font-black text-rose-500 uppercase tracking-widest hover:text-rose-400 transition-all">
                                        <div class="w-8 h-8 bg-rose-600/10 rounded-lg flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-6 0v-1m6-10V7a3 3 0 00-6 0v1"></path></svg></div>
                                        <span>End Session</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-[10px] font-black text-white uppercase tracking-widest hover:text-blue-500 transition-colors px-6">Login</a>
                    <a href="{{ route('register') }}" class="btn-luxury px-8 py-3 !text-[10px]">Apply for Membership</a>
                @endauth
            </div>

            <!-- Mobile Toggle -->
            <div class="lg:hidden flex items-center">
                <button @click="mobileMenu = !mobileMenu" class="w-12 h-12 glass rounded-xl flex items-center justify-center text-white">
                    <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <svg x-show="mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenu" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden glass border-t border-white/5 absolute top-full left-0 right-0 p-8 space-y-6 shadow-2xl">
        <div class="flex flex-col space-y-6">
            <a href="{{ route('home') }}" class="text-xs font-black text-white uppercase tracking-widest">Home</a>
            <a href="{{ route('about') }}" class="text-xs font-black text-white uppercase tracking-widest">About</a>
            <a href="{{ route('destinations.index') }}" class="text-xs font-black text-white uppercase tracking-widest">Destinations</a>
            <a href="{{ route('packages.index') }}" class="text-xs font-black text-white uppercase tracking-widest">Packages</a>
            <a href="{{ route('hotels.index') }}" class="text-xs font-black text-white uppercase tracking-widest">Hotels</a>
            <a href="{{ route('blog.index') }}" class="text-xs font-black text-white uppercase tracking-widest">Journal</a>
            <a href="{{ route('contact') }}" class="text-xs font-black text-white uppercase tracking-widest">Contact</a>
        </div>
        <div class="pt-6 border-t border-white/5 flex flex-col space-y-4">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-luxury w-full text-center py-4">My Portfolio</a>
            @else
                <a href="{{ route('login') }}" class="text-center text-xs font-black text-white uppercase tracking-widest py-4">Login</a>
                <a href="{{ route('register') }}" class="btn-luxury w-full text-center py-4">Sign Up</a>
            @endauth
        </div>
    </div>
</nav>
