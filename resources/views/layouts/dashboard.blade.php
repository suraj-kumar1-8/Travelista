<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TRAVELISTA') }} - Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Outfit', sans-serif; }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 transition-colors duration-300">
        <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: true }">
            
            <!-- Sidebar -->
            <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="glass border-r border-slate-200 dark:border-slate-800 transition-all duration-300 flex flex-col z-40">
                <!-- Sidebar Header -->
                <div class="h-20 flex items-center px-6">
                    <span x-show="sidebarOpen" class="text-2xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">TRAVELISTA</span>
                    <span x-show="!sidebarOpen" class="text-2xl font-black text-blue-600">T</span>
                </div>

                <!-- Navigation -->
                <nav class="flex-grow px-4 py-6 space-y-2 overflow-y-auto">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors' }} group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span x-show="sidebarOpen">Overview</span>
                    </a>
                    
                    <a href="{{ route('bookings.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('bookings.*') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors' }} group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        <span x-show="sidebarOpen">Bookings</span>
                    </a>

                    <a href="{{ route('wishlist.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('wishlist.*') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors' }} group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        <span x-show="sidebarOpen">Wishlist</span>
                    </a>

                    @if(Auth::user()->role === 'admin')
                    <div class="pt-6 pb-2 px-4" x-show="sidebarOpen">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Admin</span>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 01-9-3.812M13.914 8.054a4 4 0 014.137 0M18.914 11.106A4 4 0 0121 15.105a1 1 0 01-1 1h-2"></path></svg>
                        <span x-show="sidebarOpen">Manage Users</span>
                    </a>
                    <a href="{{ route('admin.packages.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span x-show="sidebarOpen">Tour Packages</span>
                    </a>
                    @endif
                </nav>

                <!-- Sidebar Footer -->
                <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                    <button @click="sidebarOpen = !sidebarOpen" class="w-full flex items-center justify-center p-3 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <svg class="w-6 h-6 text-slate-400" :class="sidebarOpen ? '' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path></svg>
                    </button>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-grow flex flex-col overflow-hidden">
                <!-- Top Header -->
                <header class="h-20 glass border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-8 z-30">
                    <div class="flex items-center space-x-4">
                        <h2 class="text-xl font-bold text-slate-800 dark:text-white">Dashboard</h2>
                    </div>

                    <div class="flex items-center space-x-6">
                        <!-- Dark Mode Toggle -->
                        <button @click="darkMode = !darkMode; localStorage.theme = darkMode ? 'dark' : 'light'; document.documentElement.classList.toggle('dark')" 
                                class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" x-data="{ darkMode: document.documentElement.classList.contains('dark') }">
                            <template x-if="!darkMode">
                                <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                            </template>
                            <template x-if="darkMode">
                                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z"></path></svg>
                            </template>
                        </button>

                        <div class="flex items-center space-x-3">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500 capitalize">{{ Auth::user()->role }}</p>
                            </div>
                            <img class="h-10 w-10 rounded-full border-2 border-blue-500 p-0.5" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF" alt="">
                        </div>
                    </div>
                </header>

                <!-- Content Area -->
                <main class="flex-grow overflow-y-auto p-8 bg-slate-50 dark:bg-slate-950">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
