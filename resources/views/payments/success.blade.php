<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-slate-950 py-32 px-4 relative overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-600/10 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] animate-pulse"></div>

        <div class="max-w-2xl w-full glass p-16 rounded-[4rem] border-white/5 text-center relative z-10" data-aos="zoom-in">
            <!-- Animated Success Icon -->
            <div class="w-32 h-32 bg-emerald-600/20 rounded-[2.5rem] flex items-center justify-center mx-auto mb-12 border border-emerald-600/30">
                <svg class="w-16 h-16 text-emerald-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>

            <h1 class="text-5xl font-black text-white uppercase tracking-tighter mb-6 leading-tight">Expedition <br> <span class="text-emerald-500 italic">Confirmed</span></h1>
            <p class="text-xl text-slate-400 font-medium mb-12">Your passport to luxury is ready. We've sent the travel documents and confirmation details to your email.</p>

            <div class="grid grid-cols-2 gap-6 mb-12">
                <div class="glass p-6 rounded-[2rem] border-white/5">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Booking Ref</p>
                    <p class="text-lg font-black text-white tracking-widest uppercase">TRV-{{ strtoupper(Str::random(8)) }}</p>
                </div>
                <div class="glass p-6 rounded-[2rem] border-white/5">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Status</p>
                    <p class="text-lg font-black text-emerald-500 tracking-widest uppercase">Secured</p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-6">
                <a href="{{ route('dashboard') }}" class="btn-luxury flex-grow py-5 !bg-emerald-600 hover:!bg-emerald-500 shadow-emerald-600/20">Go to Dashboard</a>
                <a href="{{ route('home') }}" class="btn-luxury flex-grow py-5 !bg-white/5 border-white/10 hover:!bg-white/10 shadow-none">Back Home</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Adventure Secured!',
                text: 'Your luxury expedition has been successfully booked.',
                icon: 'success',
                background: '#0f172a',
                color: '#fff',
                confirmButtonColor: '#10b981',
                confirmButtonText: 'Great!',
                customClass: {
                    popup: 'rounded-[3rem] border border-white/5 shadow-2xl backdrop-blur-3xl bg-slate-950/90',
                    title: 'text-2xl font-black uppercase tracking-tighter',
                    content: 'text-slate-400 font-medium'
                }
            });
        });
    </script>
</x-app-layout>
