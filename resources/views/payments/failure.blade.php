<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-slate-950 py-32 px-4 relative overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-rose-600/10 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-amber-600/10 rounded-full blur-[120px] animate-pulse"></div>

        <div class="max-w-2xl w-full glass p-16 rounded-[4rem] border-white/5 text-center relative z-10" data-aos="zoom-in">
            <!-- Animated Failure Icon -->
            <div class="w-32 h-32 bg-rose-600/20 rounded-[2.5rem] flex items-center justify-center mx-auto mb-12 border border-rose-600/30">
                <svg class="w-16 h-16 text-rose-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>

            <h1 class="text-5xl font-black text-white uppercase tracking-tighter mb-6 leading-tight">Journey <br> <span class="text-rose-500 italic">Interrupted</span></h1>
            <p class="text-xl text-slate-400 font-medium mb-12">We encountered an issue while processing your payment. Your spot is still safe for a limited time—please try again.</p>

            <div class="flex flex-col md:flex-row gap-6">
                <a href="{{ route('packages.index') }}" class="btn-luxury flex-grow py-5 !bg-rose-600 hover:!bg-rose-500 shadow-rose-600/20">Retry Booking</a>
                <a href="{{ route('contact') }}" class="btn-luxury flex-grow py-5 !bg-white/5 border-white/10 hover:!bg-white/10 shadow-none">Contact Support</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Transaction Failed',
                text: 'We could not secure your payment at this time.',
                icon: 'error',
                background: '#0f172a',
                color: '#fff',
                confirmButtonColor: '#e11d48',
                confirmButtonText: 'Try Again',
                customClass: {
                    popup: 'rounded-[3rem] border border-white/5 shadow-2xl backdrop-blur-3xl bg-slate-950/90',
                    title: 'text-2xl font-black uppercase tracking-tighter',
                    content: 'text-slate-400 font-medium'
                }
            });
        });
    </script>
</x-app-layout>
