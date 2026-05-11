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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

            <nav class="flex-grow px-6 space-y-2 py-4 overflow-y-auto custom-scrollbar">
                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-4 pb-4">Analytics</div>
                <x-admin.nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Performance
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.payments.index') }}" :active="request()->routeIs('admin.payments.*')">
                    <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Financial Ledger
                </x-admin.nav-link>

                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-4 pt-10 pb-4">Inventory</div>
                <x-admin.nav-link href="{{ route('admin.bookings.index') }}" :active="request()->routeIs('admin.bookings.*')">
                    <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Reservations
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.destinations.index') }}" :active="request()->routeIs('admin.destinations.*')">
                    <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    Gateways
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.packages.index') }}" :active="request()->routeIs('admin.packages.*')">
                    <svg class="w-5 h-5 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    Tour Packages
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.hotels.index') }}" :active="request()->routeIs('admin.hotels.*')">
                    <svg class="w-5 h-5 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Luxury Stays
                </x-admin.nav-link>

                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-4 pt-10 pb-4">Community</div>
                <x-admin.nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                    <svg class="w-5 h-5 mr-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Travelers
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.reviews.index') }}" :active="request()->routeIs('admin.reviews.*')">
                    <svg class="w-5 h-5 mr-3 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    Guest Reviews
                </x-admin.nav-link>

                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-4 pt-10 pb-4">Marketing</div>
                <x-admin.nav-link href="{{ route('admin.blogs.index') }}" :active="request()->routeIs('admin.blogs.*')">
                    <svg class="w-5 h-5 mr-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Journal
                </x-admin.nav-link>
                <x-admin.nav-link href="{{ route('admin.offers.index') }}" :active="request()->routeIs('admin.offers.*')">
                    <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Offers & Deals
                </x-admin.nav-link>
            </nav>

            <div class="p-8 border-t border-white/5 bg-slate-900/60">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-6 py-4 text-rose-500 hover:bg-rose-500/10 rounded-2xl transition-all font-black text-xs uppercase tracking-widest">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Secure Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Workspace -->
        <main class="flex-grow overflow-y-auto relative bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]">
            <header class="h-24 bg-slate-950/50 backdrop-blur-2xl border-b border-white/5 flex items-center justify-between px-12 sticky top-0 z-50">
                <div class="flex items-center">
                    <h2 class="text-2xl font-black text-white uppercase tracking-tighter">@yield('header')</h2>
                </div>
                <div class="flex items-center space-x-8">
                    <div class="flex items-center space-x-6 border-r border-white/10 pr-8">
                        <button class="relative p-2 text-slate-400 hover:text-white transition-all">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute top-0 right-0 w-3 h-3 bg-blue-600 rounded-full border-2 border-slate-950"></span>
                        </button>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm font-black text-white uppercase tracking-widest">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] font-bold text-blue-500 uppercase tracking-tighter">System Admin</p>
                        </div>
                        <div class="relative group">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=3b82f6&color=fff" class="w-12 h-12 rounded-2xl border-2 border-transparent group-hover:border-blue-600 transition-all shadow-xl" alt="">
                            <div class="absolute inset-0 bg-blue-600/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-12 lg:p-16 max-w-[1600px] mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>
