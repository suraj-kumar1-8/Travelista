<x-app-layout>
    <div class="min-h-screen bg-slate-950 py-32 px-4 flex items-center justify-center relative overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px]"></div>

        <div class="max-w-3xl w-full relative z-10" data-aos="zoom-in">
            <div class="bg-white rounded-[3rem] p-16 shadow-2xl text-slate-900 relative overflow-hidden">
                <!-- Branding Background -->
                <div class="absolute top-0 right-0 p-12 opacity-5 text-9xl font-black italic select-none">T</div>

                <div class="flex justify-between items-start mb-20">
                    <div>
                        <div class="flex items-center space-x-3 mb-8">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                <span class="text-white font-black italic text-2xl">T</span>
                            </div>
                            <span class="text-2xl font-black uppercase tracking-tighter">TRAVELISTA</span>
                        </div>
                        <h1 class="text-4xl font-black uppercase tracking-tighter italic">Digital Invoice</h1>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Issued On</p>
                        <p class="font-black">{{ now()->format('M d, Y') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-12 mb-20">
                    <div>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Adventurer</p>
                        <p class="font-black text-lg">{{ $booking->user->name }}</p>
                        <p class="text-slate-600 text-sm font-medium">{{ $booking->user->email }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Reference</p>
                        <p class="font-black text-lg tracking-widest uppercase">{{ $booking->booking_reference }}</p>
                        <p class="text-blue-600 text-[10px] font-black uppercase tracking-widest mt-2">Status: {{ strtoupper($booking->status) }}</p>
                    </div>
                </div>

                <div class="border-y-2 border-slate-100 py-12 mb-12">
                    <div class="flex justify-between items-center mb-10">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Description</p>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Investment</p>
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-black uppercase tracking-tighter mb-2">{{ $booking->bookable->name }}</h3>
                            <p class="text-slate-600 text-sm font-medium">{{ $booking->travelers }} {{ Str::plural('Traveler', $booking->travelers) }} • {{ \Carbon\Carbon::parse($booking->start_date)->format('M d, Y') }}</p>
                        </div>
                        <p class="text-2xl font-black tracking-tighter italic">₹{{ number_format($booking->total_price) }}</p>
                    </div>
                </div>

                <div class="flex justify-between items-end">
                    <div class="space-y-4">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest italic leading-relaxed max-w-xs">
                            This is a digitally generated invoice for your luxury expedition curation. No signature required.
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Total Amount Due</p>
                        <p class="text-5xl font-black tracking-tighter text-blue-600 italic">₹{{ number_format($booking->total_price) }}</p>
                    </div>
                </div>

                <div class="mt-20 pt-12 border-t border-slate-100 text-center">
                    <button onclick="window.print()" class="text-[10px] font-black text-slate-400 hover:text-blue-600 uppercase tracking-widest transition-colors flex items-center justify-center mx-auto group">
                        <svg class="w-4 h-4 mr-2 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Print Original Copy
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
