<x-app-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute inset-0 bg-slate-950"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px]"></div>
        
        <div class="max-w-md w-full glass p-12 rounded-[4rem] border-white/5 shadow-2xl relative z-10" data-aos="zoom-in">
            <div class="text-center mb-12">
                <div class="w-20 h-20 bg-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-600/20">
                    <span class="text-white font-black italic text-3xl">T</span>
                </div>
                <h1 class="text-3xl font-black text-white uppercase tracking-tighter mb-2">Admin Portal</h1>
                <p class="text-slate-500 font-bold uppercase tracking-widest text-[10px]">Command Center Access</p>
            </div>

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-8">
                @csrf
                
                <div class="space-y-2 group">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Security ID (Email)</label>
                    <input type="email" name="email" required autofocus 
                           class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold placeholder-slate-600" 
                           placeholder="admin@travelista.com">
                </div>

                <div class="space-y-2 group">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Access Code (Password)</label>
                    <input type="password" name="password" required 
                           class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold placeholder-slate-600" 
                           placeholder="••••••••">
                </div>

                @if($errors->any())
                    <div class="bg-rose-600/10 border border-rose-600/20 rounded-2xl p-4">
                        <p class="text-xs font-bold text-rose-500">{{ $errors->first() }}</p>
                    </div>
                @endif

                <button type="submit" class="btn-luxury w-full py-5 !bg-blue-600 hover:!bg-blue-500 shadow-blue-600/20">Initialize Entry</button>
            </form>
        </div>
    </div>
</x-app-layout>
