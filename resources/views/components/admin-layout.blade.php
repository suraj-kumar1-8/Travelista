<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Master Control - TRAVELISTA PREMIA</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS Animations -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-slate-950 text-slate-200 selection:bg-blue-500/30 selection:text-blue-200">
    <div class="min-h-screen flex overflow-hidden">

        <!-- Luxury Sidebar -->
        <aside class="w-80 bg-slate-900/40 backdrop-blur-3xl border-r border-white/5 flex-shrink-0 hidden lg:flex flex-col relative z-[100]">
            <div class="p-10">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-600/30 group-hover:rotate-12 transition-transform duration-500">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="text-2xl font-black text-white tracking-tighter uppercase">PREMIA</span>
                </a>
            </div>

            <nav class="flex-grow px-8 space-y-2 overflow-y-auto">
                @php
                    $navItems = [
                        ['route' => 'admin.dashboard',            'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Command Center'],
                        ['route' => 'admin.bookings.index',        'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'label' => 'Bookings'],
                        ['route' => 'admin.users.index',           'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'label' => 'Travelers'],
                        ['route' => 'admin.destinations.index',    'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z', 'label' => 'Destinations'],
                        ['route' => 'admin.hotels.index',          'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'label' => 'Hotels'],
                        ['route' => 'admin.packages.index',        'icon' => 'M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9', 'label' => 'Packages'],
                        ['route' => 'admin.payments.index',        'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Payments'],
                        ['route' => 'admin.coupons.index',         'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z', 'label' => 'Coupons'],
                        ['route' => 'admin.offers.index',          'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z', 'label' => 'Offers'],
                        ['route' => 'admin.reviews.index',         'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z', 'label' => 'Reviews'],
                        ['route' => 'admin.blogs.index',           'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6m-6-4h6', 'label' => 'Blog'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    @if(\Route::has($item['route']))
                    <x-admin.nav-link :href="route($item['route'])" :active="request()->routeIs(Str::before($item['route'], '.index').'*')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path></svg>
                        <span>{{ $item['label'] }}</span>
                    </x-admin.nav-link>
                    @endif
                @endforeach
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-8 border-t border-white/5">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-6 py-4 rounded-2xl glass text-slate-500 hover:text-rose-400 hover:border-rose-500/20 transition-all group border border-transparent">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="text-xs font-black uppercase tracking-widest">Secure Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Workspace -->
        <main class="flex-grow overflow-y-auto relative">
            <!-- Top Bar -->
            <header class="h-24 bg-slate-950/80 backdrop-blur-2xl border-b border-white/5 flex items-center justify-between px-8 lg:px-12 sticky top-0 z-50">
                <div class="flex items-center space-x-4">
                    <!-- Mobile menu icon placeholder -->
                    <div class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-white/5 text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </div>
                    <!-- Flash messages inline -->
                    @if(session('success'))
                        <div class="hidden lg:flex items-center space-x-2 glass px-4 py-2 rounded-xl border border-emerald-500/20 text-emerald-400 text-xs font-bold">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ url('/') }}" target="_blank" class="text-[9px] font-black text-slate-500 hover:text-white uppercase tracking-widest transition-colors hidden lg:block">View Site →</a>
                    <div class="flex items-center space-x-3">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-black text-white uppercase tracking-widest">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-bold text-blue-500 uppercase tracking-tighter">System Admin</p>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=3b82f6&color=fff" class="w-10 h-10 rounded-2xl border-2 border-transparent hover:border-blue-600 transition-all shadow-xl" alt="">
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-8 lg:p-12 xl:p-16 max-w-[1600px] mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- AOS Init -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>AOS.init({ duration: 700, once: true, offset: 50 });</script>
    @stack('scripts')
</body>
</html>
