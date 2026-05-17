<x-app-layout>
    <div class="min-h-screen flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8 relative overflow-hidden" x-data="{ showPass: false }">
        <!-- Animated Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full bg-slate-950"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/20 rounded-full blur-[100px] animate-pulse"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-600/20 rounded-full blur-[100px] animate-pulse"></div>

        <div class="max-w-4xl w-full flex flex-col lg:flex-row glass rounded-[3rem] overflow-hidden shadow-2xl relative z-10 border-white/10" data-aos="zoom-in">
            <!-- Left Side: Cinematic Image -->
            <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
                <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&q=80&w=1000" class="w-full h-full object-cover animate-slow-zoom" alt="Login Background">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                <div class="absolute bottom-12 left-12 right-12">
                    <h2 class="text-3xl font-black text-white mb-3 uppercase tracking-tighter">Your Journey <br> <span class="text-blue-400">Starts Here.</span></h2>
                    <p class="text-slate-300 font-medium text-sm leading-relaxed">Sign in to access your luxury travel portfolio and discover curated adventures.</p>
                </div>
            </div>

            <!-- Right Side: Login Form -->
            <div class="w-full lg:w-1/2 p-8 lg:p-14 bg-slate-950/50 backdrop-blur-3xl flex flex-col justify-center">
                <div class="mb-10 text-center lg:text-left">
                    <h1 class="text-2xl font-black text-white mb-1.5 uppercase tracking-tighter">Welcome Back</h1>
                    <p class="text-slate-500 font-bold uppercase tracking-widest text-[9px]">Enter your credentials to continue</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-8">
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

                    <div class="relative group">
                        <input :type="showPass ? 'text' : 'password'" name="password" required 
                               class="peer w-full bg-white/5 border-b-2 border-white/10 px-0 py-3 text-white text-sm placeholder-transparent focus:border-blue-600 focus:ring-0 transition-all font-bold outline-none @error('password') border-red-500 @enderror" 
                               placeholder="Password">
                        <label class="absolute left-0 -top-3.5 text-[9px] font-black text-slate-500 uppercase tracking-widest transition-all peer-placeholder-shown:text-xs peer-placeholder-shown:top-3 peer-placeholder-shown:text-slate-600 peer-focus:-top-3.5 peer-focus:text-blue-500 peer-focus:text-[9px]">Security Code</label>
                        <button type="button" @click="showPass = !showPass" class="absolute right-0 top-3 text-slate-600 hover:text-white transition-colors">
                            <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg x-show="showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path></svg>
                        </button>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded-md bg-white/5 border-none text-blue-600 focus:ring-blue-600 focus:ring-offset-slate-950">
                            <label for="remember" class="ml-2.5 text-[9px] font-black text-slate-500 uppercase tracking-widest cursor-pointer hover:text-slate-400 transition-colors">Remember Journey</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[9px] font-black text-blue-500 uppercase tracking-widest hover:text-blue-400 transition-colors">Forgot?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-luxury w-full py-4 text-xs group">
                        <span>Access Account</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>

                    <div class="relative py-3">
                        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-white/5"></div></div>
                        <div class="relative flex justify-center text-[9px] font-black uppercase tracking-widest"><span class="bg-[#0f172a] px-4 text-slate-500">Or continue with</span></div>
                    </div>

                    <div class="grid grid-cols-1 gap-3">
                        <a href="{{ route('google.login') }}" class="flex items-center justify-center space-x-2 bg-white/5 hover:bg-white/10 px-4 py-3 rounded-xl transition-all border border-white/5 group">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-4 h-4 group-hover:scale-110 transition-transform" alt="Google Icon">
                            <span class="text-[9px] font-black text-white uppercase tracking-widest">Continue with Google</span>
                        </a>
                    </div>

                    <p class="text-center text-[9px] font-black text-slate-500 uppercase tracking-widest mt-6">
                        Don't have a passport yet? <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-400 ml-1.5 transition-colors">Create Account</a>
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
