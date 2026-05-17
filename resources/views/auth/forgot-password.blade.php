<x-app-layout>
    <div class="min-h-screen flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full bg-slate-950"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/20 rounded-full blur-[100px] animate-pulse"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-600/20 rounded-full blur-[100px] animate-pulse"></div>

        <div class="max-w-4xl w-full flex flex-col lg:flex-row glass rounded-[3rem] overflow-hidden shadow-2xl relative z-10 border-white/10" data-aos="zoom-in">
            <!-- Left Side: Cinematic Image -->
            <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=1000" class="w-full h-full object-cover animate-slow-zoom" alt="Forgot Password Background">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                <div class="absolute bottom-12 left-12 right-12">
                    <h2 class="text-3xl font-black text-white mb-3 uppercase tracking-tighter">Identity <br> <span class="text-blue-400">Recovery.</span></h2>
                    <p class="text-slate-300 font-medium text-sm leading-relaxed">Let us help you regain access to your luxury travel portfolio.</p>
                </div>
            </div>

            <!-- Right Side: Request Form -->
            <div class="w-full lg:w-1/2 p-8 lg:p-14 bg-slate-950/50 backdrop-blur-3xl flex flex-col justify-center">
                <div class="mb-10 text-center lg:text-left">
                    <h1 class="text-2xl font-black text-white mb-1.5 uppercase tracking-tighter">Forgot Password</h1>
                    <p class="text-slate-500 font-bold uppercase tracking-widest text-[9px]">Enter your email to receive a reset link</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl text-xs font-bold text-center" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-8">
                    @csrf
                    
                    <div class="relative group">
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                               class="peer w-full bg-white/5 border-b-2 border-white/10 px-0 py-3 text-white text-sm placeholder-transparent focus:border-blue-600 focus:ring-0 transition-all font-bold outline-none @error('email') border-red-500 @enderror" 
                               placeholder="Email">
                        <label class="absolute left-0 -top-3.5 text-[9px] font-black text-slate-500 uppercase tracking-widest transition-all peer-placeholder-shown:text-xs peer-placeholder-shown:top-3 peer-placeholder-shown:text-slate-600 peer-focus:-top-3.5 peer-focus:text-blue-500 peer-focus:text-[9px]">Email Address</label>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-luxury w-full py-4 text-xs group">
                        <span>Send Reset Link</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>

                    <p class="text-center text-[9px] font-black text-slate-500 uppercase tracking-widest mt-6">
                        Remembered? <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-400 ml-1.5 transition-colors">Sign In</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <style>
        @keyframes slow-zoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }
        .animate-slow-zoom {
            animation: slow-zoom 20s ease-in-out infinite alternate;
        }
    </style>
</x-app-layout>
