<x-app-layout>
    <div class="min-h-screen flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8 relative overflow-hidden" x-data="{ showPass: false, password: '' }">
        <!-- Animated Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full bg-slate-950"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600/20 rounded-full blur-[100px] animate-pulse"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-600/20 rounded-full blur-[100px] animate-pulse"></div>

        <div class="max-w-4xl w-full flex flex-col lg:flex-row glass rounded-[3rem] overflow-hidden shadow-2xl relative z-10 border-white/10" data-aos="zoom-in">
            <!-- Left Side: Cinematic Image -->
            <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
                <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&q=80&w=1000" class="w-full h-full object-cover animate-slow-zoom" alt="Reset Password Background">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                <div class="absolute bottom-12 left-12 right-12">
                    <h2 class="text-3xl font-black text-white mb-3 uppercase tracking-tighter">Security <br> <span class="text-blue-400">Upgrade.</span></h2>
                    <p class="text-slate-300 font-medium text-sm leading-relaxed">Secure your journey with a new, strong passport to luxury.</p>
                </div>
            </div>

            <!-- Right Side: Reset Form -->
            <div class="w-full lg:w-1/2 p-8 lg:p-14 bg-slate-950/50 backdrop-blur-3xl flex flex-col justify-center">
                <div class="mb-10 text-center lg:text-left">
                    <h1 class="text-2xl font-black text-white mb-1.5 uppercase tracking-tighter">Update Password</h1>
                    <p class="text-slate-500 font-bold uppercase tracking-widest text-[9px]">Define your new security credentials</p>
                </div>

                <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="relative group">
                        <input type="email" name="email" value="{{ old('email', $request->email) }}" required readonly
                               class="peer w-full bg-white/2 border-b-2 border-white/5 px-0 py-3 text-slate-500 text-sm placeholder-transparent focus:border-blue-600 focus:ring-0 transition-all font-bold outline-none cursor-not-allowed" 
                               placeholder="Email">
                        <label class="absolute left-0 -top-3.5 text-[9px] font-black text-slate-500 uppercase tracking-widest transition-all">Identity</label>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <div class="relative group">
                            <input :type="showPass ? 'text' : 'password'" name="password" x-model="password" required 
                                   class="peer w-full bg-white/5 border-b-2 border-white/10 px-0 py-3 text-white text-sm placeholder-transparent focus:border-blue-600 focus:ring-0 transition-all font-bold outline-none @error('password') border-red-500 @enderror" 
                                   placeholder="New Password">
                            <label class="absolute left-0 -top-3.5 text-[9px] font-black text-slate-500 uppercase tracking-widest transition-all peer-placeholder-shown:text-xs peer-placeholder-shown:top-3 peer-placeholder-shown:text-slate-600 peer-focus:-top-3.5 peer-focus:text-blue-500 peer-focus:text-[9px]">New Password</label>
                            <button type="button" @click="showPass = !showPass" class="absolute right-0 top-3 text-slate-600 hover:text-white transition-colors">
                                <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg x-show="showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path></svg>
                            </button>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Strength Meter -->
                        <div class="grid grid-cols-4 gap-1.5 px-2">
                            <div class="h-1 rounded-full bg-slate-800 transition-all" :class="password.length > 3 ? 'bg-red-500' : ''"></div>
                            <div class="h-1 rounded-full bg-slate-800 transition-all" :class="password.length > 7 && /[A-Z]/.test(password) ? 'bg-amber-500' : ''"></div>
                            <div class="h-1 rounded-full bg-slate-800 transition-all" :class="password.length > 10 && /[0-9]/.test(password) ? 'bg-blue-500' : ''"></div>
                            <div class="h-1 rounded-full bg-slate-800 transition-all" :class="password.length > 12 && /[^A-Za-z0-9]/.test(password) ? 'bg-emerald-500' : ''"></div>
                        </div>
                        <p class="text-[8px] font-black text-slate-600 uppercase tracking-widest">Enforce: 8+ Chars, Mixed Case, Symbols</p>
                    </div>

                    <div class="relative group">
                        <input type="password" name="password_confirmation" required 
                               class="peer w-full bg-white/5 border-b-2 border-white/10 px-0 py-3 text-white text-sm placeholder-transparent focus:border-blue-600 focus:ring-0 transition-all font-bold outline-none" 
                               placeholder="Confirm Password">
                        <label class="absolute left-0 -top-3.5 text-[9px] font-black text-slate-500 uppercase tracking-widest transition-all peer-placeholder-shown:text-xs peer-placeholder-shown:top-3 peer-placeholder-shown:text-slate-600 peer-focus:-top-3.5 peer-focus:text-blue-500 peer-focus:text-[9px]">Confirm New Password</label>
                    </div>

                    <button type="submit" class="btn-luxury w-full py-4 text-xs group">
                        <span>Reclaim Account</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
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
