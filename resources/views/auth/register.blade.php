<x-app-layout>
    <div class="min-h-screen flex items-center justify-center py-10 px-4 sm:px-6 lg:px-8 relative overflow-hidden" x-data="{ step: 1, password: '', profilePreview: null }">
        <!-- Background Decor -->
        <div class="absolute top-0 right-0 w-full h-full bg-slate-950"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-emerald-600/10 rounded-full blur-[120px]"></div>

        <div class="max-w-4xl w-full flex flex-col lg:flex-row-reverse glass rounded-[3rem] overflow-hidden shadow-2xl relative z-10 border-white/10" data-aos="zoom-in">
            <!-- Right Side: Imagery -->
            <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
                <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&q=80&w=1000" class="w-full h-full object-cover transition-transform duration-[20s] hover:scale-110" alt="Register Background">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                <div class="absolute bottom-12 left-12 right-12">
                    <div class="flex items-center space-x-3 mb-6">
                        <template x-for="i in 3">
                            <div class="h-1 flex-grow rounded-full transition-colors duration-500" :class="step >= i ? 'bg-emerald-500' : 'bg-white/10'"></div>
                        </template>
                    </div>
                    <h2 class="text-3xl font-black text-white mb-3 uppercase tracking-tighter">
                        <span x-show="step === 1">Your Personal <br> <span class="text-emerald-400">Identity.</span></span>
                        <span x-show="step === 2">Security <br> <span class="text-emerald-400">First.</span></span>
                        <span x-show="step === 3">Finalize <br> <span class="text-emerald-400">Journey.</span></span>
                    </h2>
                    <p class="text-slate-300 font-medium text-sm" x-text="step === 1 ? 'Start by telling us who you are.' : (step === 2 ? 'Secure your passport to luxury.' : 'Almost there, explorer.')"></p>
                </div>
            </div>

            <!-- Left Side: Register Form -->
            <div class="w-full lg:w-1/2 p-8 lg:p-14 bg-slate-950/50 backdrop-blur-3xl flex flex-col justify-center">
                <div class="mb-10">
                    <h1 class="text-2xl font-black text-white mb-1.5 uppercase tracking-tighter">Create Account</h1>
                    <p class="text-slate-500 font-bold uppercase tracking-widest text-[9px]">Step <span x-text="step"></span> of 3</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    
                    @if($errors->any())
                        <div class="bg-rose-600/10 border border-rose-600/20 rounded-2xl p-3 mb-4">
                            <ul class="list-disc list-inside text-xs font-bold text-rose-500">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <!-- Step 1: Identity -->
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="space-y-6">
                        <div class="flex flex-col items-center justify-center mb-6">
                            <div class="relative group">
                                <div class="w-24 h-24 rounded-full bg-white/5 border-2 border-dashed border-white/10 flex items-center justify-center overflow-hidden group-hover:border-emerald-500 transition-colors">
                                    <template x-if="!profilePreview">
                                        <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </template>
                                    <template x-if="profilePreview">
                                        <img :src="profilePreview" class="w-full h-full object-cover">
                                    </template>
                                </div>
                                <input type="file" name="profile_image" class="absolute inset-0 opacity-0 cursor-pointer" @change="const file = $event.target.files[0]; if(file) { profilePreview = URL.createObjectURL(file); }">
                                <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-emerald-600 rounded-full flex items-center justify-center text-white shadow-lg shadow-emerald-600/30">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </div>
                            </div>
                            <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-3">Upload Passport Photo</p>
                        </div>

                        <div class="space-y-1.5 group">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-2">Full Name</label>
                            <input type="text" name="name" required class="w-full bg-white/5 border-none rounded-xl px-5 py-3.5 text-white text-sm focus:ring-2 focus:ring-emerald-600 transition-all font-bold placeholder-slate-600" placeholder="John Doe">
                        </div>

                        <div class="space-y-1.5 group">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-2">Email Address</label>
                            <input type="email" name="email" required class="w-full bg-white/5 border-none rounded-xl px-5 py-3.5 text-white text-sm focus:ring-2 focus:ring-emerald-600 transition-all font-bold placeholder-slate-600" placeholder="john@doe.com">
                        </div>

                        <div class="space-y-1.5 group">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-2">Referral Code (Optional)</label>
                            <input type="text" name="referral_code" class="w-full bg-white/5 border-none rounded-xl px-5 py-3.5 text-white text-sm focus:ring-2 focus:ring-emerald-600 transition-all font-bold placeholder-slate-600" placeholder="TRV-XXXXXX">
                        </div>

                        <button type="button" @click="step = 2" class="btn-luxury w-full py-4 text-xs !bg-emerald-600 hover:!bg-emerald-500 shadow-emerald-600/20 rounded-xl mt-2">Next Section</button>

                        <div class="relative py-4">
                            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-white/5"></div></div>
                            <div class="relative flex justify-center text-[8px] font-black uppercase tracking-widest"><span class="bg-[#0f172a] px-4 text-slate-500">Quick Start</span></div>
                        </div>

                        <a href="{{ route('google.login') }}" class="flex items-center justify-center space-x-2 bg-white/5 hover:bg-white/10 px-4 py-3 rounded-xl transition-all border border-white/5 group">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-4 h-4 group-hover:scale-110 transition-transform" alt="Google Icon">
                            <span class="text-[9px] font-black text-white uppercase tracking-widest">Sign up with Google</span>
                        </a>
                    </div>

                    <!-- Step 2: Security -->
                    <div x-show="step === 2" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="space-y-6">
                        <div class="space-y-3">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-2">Create Password</label>
                            <input type="password" name="password" x-model="password" required class="w-full bg-white/5 border-none rounded-xl px-5 py-3.5 text-white text-sm focus:ring-2 focus:ring-emerald-600 transition-all font-bold placeholder-slate-600" placeholder="••••••••">
                            <!-- Strength Meter -->
                            <div class="grid grid-cols-4 gap-1.5 px-2">
                                <div class="h-1 rounded-full bg-slate-800 transition-all" :class="password.length > 3 ? 'bg-red-500' : ''"></div>
                                <div class="h-1 rounded-full bg-slate-800 transition-all" :class="password.length > 7 ? 'bg-amber-500' : ''"></div>
                                <div class="h-1 rounded-full bg-slate-800 transition-all" :class="password.length > 10 ? 'bg-blue-500' : ''"></div>
                                <div class="h-1 rounded-full bg-slate-800 transition-all" :class="password.length > 12 ? 'bg-emerald-500' : ''"></div>
                            </div>
                            <p class="text-[8px] font-black text-slate-600 uppercase tracking-widest" x-text="password.length < 8 ? 'Weak' : (password.length < 12 ? 'Good' : 'Very Strong')"></p>
                        </div>

                        <div class="space-y-1.5 group">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest px-2">Confirm Identity</label>
                            <input type="password" name="password_confirmation" required class="w-full bg-white/5 border-none rounded-xl px-5 py-3.5 text-white text-sm focus:ring-2 focus:ring-emerald-600 transition-all font-bold placeholder-slate-600" placeholder="••••••••">
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="button" @click="step = 1" class="w-1/3 py-4 rounded-xl bg-white/5 text-slate-400 font-black text-[9px] uppercase tracking-widest border border-white/5 hover:bg-white/10 transition-all">Back</button>
                            <button type="button" @click="step = 3" class="w-2/3 py-4 rounded-xl bg-emerald-600 text-white font-black text-[9px] uppercase tracking-widest hover:bg-emerald-500 transition-all shadow-lg shadow-emerald-600/20">Final Review</button>
                        </div>
                    </div>

                    <!-- Step 3: Confirmation -->
                    <div x-show="step === 3" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="space-y-6">
                        <div class="glass p-6 rounded-2xl border-white/5 space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-emerald-600/20 rounded-lg flex items-center justify-center text-emerald-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <p class="text-xs font-bold text-white">Identity Verified</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-600/20 rounded-lg flex items-center justify-center text-blue-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                <p class="text-xs font-bold text-white">High Security Active</p>
                            </div>
                        </div>

                        <div class="flex items-center py-2">
                            <input type="checkbox" required class="w-4 h-4 rounded-md bg-white/5 border-none text-emerald-600 focus:ring-emerald-600 focus:ring-offset-slate-950">
                            <label class="ml-2.5 text-[9px] font-black text-slate-500 uppercase tracking-widest leading-relaxed">I agree to the <a href="#" class="text-emerald-500 hover:text-emerald-400">Terms of Adventure</a></label>
                        </div>

                        <div class="flex gap-3">
                            <button type="button" @click="step = 2" class="w-1/3 py-4 rounded-xl bg-white/5 text-slate-400 font-black text-[9px] uppercase tracking-widest border border-white/5 hover:bg-white/10 transition-all">Back</button>
                            <button type="submit" class="w-2/3 py-4 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-black text-[9px] uppercase tracking-widest hover:-translate-y-1 transition-all shadow-lg shadow-emerald-600/30">Begin Journey</button>
                        </div>
                    </div>

                    <p class="text-center text-[9px] font-black text-slate-500 uppercase tracking-widest pt-4">
                        Already have a passport? <a href="{{ route('login') }}" class="text-emerald-500 hover:text-emerald-400 ml-1.5 transition-colors">Sign In</a>
                    </p>
                    @auth
                    <p class="text-center text-[9px] font-black text-slate-500 uppercase tracking-widest pt-2">
                        Share your referral code: <span class="text-emerald-400">{{ Auth::user()->referral_code }}</span>
                    </p>
                    @endauth
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
