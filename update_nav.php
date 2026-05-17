<?php
$f = "resources/views/components/travelista/navbar.blade.php";
$c = file_get_contents($f);

$desktopNavPattern = '/<!-- Desktop Navigation Links -->.*?<\/div>\s*<\/div>\s*<!-- Auth \/ Actions -->/s';
$desktopNavReplacement = <<<'HTML'
<!-- Desktop Navigation Links -->
                <div class="hidden lg:flex items-center space-x-6 ml-auto">
                    <x-nav-link-premium href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-nav-link-premium>
                    <x-nav-link-premium href="{{ route('destinations.index') }}" :active="request()->routeIs('destinations.index')">Destinations</x-nav-link-premium>
                    <x-nav-link-premium href="{{ route('packages.index') }}" :active="request()->routeIs('packages.index')">Packages</x-nav-link-premium>
                    <x-nav-link-premium href="{{ route('hotels.index') }}" :active="request()->routeIs('hotels.index')">Hotels</x-nav-link-premium>
                    
                    <!-- Planner Dropdown -->
                    <div class="relative py-2" x-data="{ plannerOpen: false }" @mouseenter="plannerOpen = true" @mouseleave="plannerOpen = false">
                        <button class="flex items-center space-x-1 text-[10px] font-black uppercase tracking-widest text-slate-300 hover:text-white transition-all">
                            <span>Planner</span>
                            <svg class="w-3 h-3 transition-transform duration-300" :class="plannerOpen ? 'rotate-180 text-blue-500' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="plannerOpen" style="display: none;"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute left-0 mt-4 w-48 glass rounded-2xl border-white/5 shadow-2xl p-4 z-50">
                            <div class="flex flex-col space-y-4">
                                <a href="{{ route('trip-planner.index') }}" class="text-[10px] font-black text-white hover:text-blue-500 transition-colors uppercase tracking-widest">Trip Planner</a>
                                <a href="{{ route('trip-planner.index') }}#expense" class="text-[10px] font-black text-white hover:text-blue-500 transition-colors uppercase tracking-widest">Expense Estimator</a>
                                <a href="{{ route('offers.index') }}" class="text-[10px] font-black text-white hover:text-blue-500 transition-colors uppercase tracking-widest">Offers</a>
                            </div>
                        </div>
                    </div>

                    <x-nav-link-premium href="{{ route('contact') }}" :active="request()->routeIs('contact')">Contact</x-nav-link-premium>
                </div>
            </div>

            <!-- Auth / Actions -->
HTML;

$c = preg_replace($desktopNavPattern, $desktopNavReplacement, $c);

// Auth login desktop
$authDesktopPattern = '/@else\s*<a href="\{\{ route\(\'login\'\) \}\}".*?<\/a>\s*<a href="\{\{ route\(\'register\'\) \}\}".*?<\/a>\s*@endauth/s';
$authDesktopReplacement = <<<'HTML'
@else
                    <div class="flex items-center bg-white/5 rounded-2xl border border-white/10 p-1">
                        <a href="{{ route('login') }}" class="text-[10px] font-black text-white uppercase tracking-widest hover:bg-white/10 rounded-xl px-4 py-2 transition-all">Sign In</a>
                        <span class="text-white/20 mx-1">/</span>
                        <a href="{{ route('register') }}" class="text-[10px] font-black text-white uppercase tracking-widest bg-blue-600 hover:bg-blue-500 rounded-xl px-4 py-2 transition-all shadow-lg shadow-blue-500/20">Sign Up</a>
                    </div>
                @endauth
HTML;
$c = preg_replace($authDesktopPattern, $authDesktopReplacement, $c);

// User auth menu avatar logic
$avatarPattern = '/<span class="text-\[10px\] font-black text-white uppercase tracking-widest">\{\{ auth\(\)->user\(\)->name \}\}<\/span>/s';
$avatarReplacement = <<<'HTML'
<div class="flex flex-col items-start leading-none ml-1 hidden sm:block">
                                <span class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Welcome</span>
                                <span class="text-[10px] font-black text-white uppercase tracking-widest">{{ Str::limit(auth()->user()->name, 12) }}</span>
                            </div>
HTML;
$c = preg_replace($avatarPattern, $avatarReplacement, $c);


// Mobile Menu Replacement 
$mobileMenuPattern = '/<!-- Mobile Menu -->.*?<\/nav>/s';
$mobileMenuReplacement = <<<'HTML'
<!-- Mobile Menu -->
    <div x-show="mobileMenu" style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden glass border-t border-white/5 absolute top-full left-0 right-0 p-8 space-y-6 shadow-2xl">
        <div class="flex flex-col space-y-6">
            <a href="{{ route('home') }}" class="text-xs font-black text-white uppercase tracking-widest">Home</a>
            <a href="{{ route('destinations.index') }}" class="text-xs font-black text-white uppercase tracking-widest">Destinations</a>
            <a href="{{ route('packages.index') }}" class="text-xs font-black text-white uppercase tracking-widest">Packages</a>
            <a href="{{ route('hotels.index') }}" class="text-xs font-black text-white uppercase tracking-widest">Hotels</a>
            <a href="{{ route('trip-planner.index') }}" class="text-xs font-black text-white uppercase tracking-widest">Trip Planner</a>
            <a href="{{ route('offers.index') }}" class="text-xs font-black text-white uppercase tracking-widest">Offers</a>
            <a href="{{ route('contact') }}" class="text-xs font-black text-white uppercase tracking-widest">Contact</a>
        </div>
        <div class="pt-6 border-t border-white/5 flex flex-col space-y-4">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-luxury w-full text-center py-4">My Portfolio</a>
            @else
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('login') }}" class="glass border-white/10 rounded-xl text-center text-[10px] font-black text-white uppercase tracking-widest py-3">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 rounded-xl text-center text-[10px] font-black text-white uppercase tracking-widest py-3 shadow-lg shadow-blue-500/20">Sign Up</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
HTML;
$c = preg_replace($mobileMenuPattern, $mobileMenuReplacement, $c);

file_put_contents($f, $c);
?>
