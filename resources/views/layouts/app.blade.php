<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TRAVELISTA') }} - Premium Luxury Travel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="font-sans antialiased bg-slate-950 text-slate-200 overflow-x-hidden">
    <!-- Centered Luxury Preloader -->
    <div id="preloader" class="fixed inset-0 z-[9999] bg-slate-950 flex flex-col items-center justify-center transition-all duration-1000">
        <div class="relative flex flex-col items-center">
            <!-- Animated Icon -->
            <div class="w-32 h-32 bg-blue-600 rounded-[2.5rem] flex items-center justify-center shadow-2xl shadow-blue-600/30 animate-bounce mb-8">
                <span class="text-white font-black italic text-5xl">T</span>
            </div>
            <!-- Animated Text -->
            <div class="text-center" data-aos="fade-up">
                <h1 class="text-3xl font-black text-white uppercase tracking-[0.5em] mb-4">TRAVELISTA</h1>
                <div class="h-1 w-48 bg-gradient-to-r from-transparent via-blue-600 to-transparent mx-auto"></div>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-6">Curation In Progress</p>
            </div>
        </div>
    </div>

    <div class="min-h-screen flex flex-col">
        <!-- Sticky Transparent Navbar -->
        <x-travelista.navbar />

        <!-- Main Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Premium Footer -->
        <x-travelista.footer />
    </div>

    <!-- Back to Top -->
    <button id="back-to-top" class="fixed bottom-10 right-10 w-16 h-16 glass rounded-2xl flex items-center justify-center text-white opacity-0 translate-y-10 transition-all duration-500 z-50 hover:bg-blue-600 hover:text-white group">
        <svg class="w-8 h-8 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
    </button>

    <!-- Floating Chatbot UI -->
    <div class="fixed bottom-10 left-10 z-50">
        <button class="w-16 h-16 bg-blue-600 text-white rounded-2xl shadow-2xl shadow-blue-600/50 flex items-center justify-center hover:scale-110 active:scale-95 transition-all">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        </button>
    </div>

    <!-- Global Scripts -->
    <script>
        // Preloader
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 1000);
        });

        // Back to Top Logic
        const btt = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                btt.classList.remove('opacity-0', 'translate-y-10');
                btt.classList.add('opacity-100', 'translate-y-0');
            } else {
                btt.classList.add('opacity-0', 'translate-y-10');
                btt.classList.remove('opacity-100', 'translate-y-0');
            }
        });

        btt.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html>
