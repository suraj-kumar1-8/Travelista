<x-admin-layout>
    <div class="space-y-12">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8" data-aos="fade-down">
            <div>
                <h1 class="text-4xl font-black text-white uppercase tracking-tighter">Financial <span class="text-blue-600 italic">Ledger</span></h1>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-2">Payment Tracking & Invoices</p>
            </div>
            <div class="flex space-x-4">
                <button class="btn-luxury py-3 px-6 text-xs bg-emerald-600/20 text-emerald-400 hover:bg-emerald-600 hover:text-white">Export Ledger</button>
            </div>
        </div>

        <!-- Quick Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="glass p-10 rounded-[3rem] border-white/5" data-aos="fade-up" data-aos-delay="0">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Total Revenue</p>
                <h3 class="text-3xl font-black text-blue-500 tracking-tighter">₹{{ number_format($stats['total_revenue']) }}</h3>
            </div>
            <div class="glass p-10 rounded-[3rem] border-white/5" data-aos="fade-up" data-aos-delay="100">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Successful</p>
                <h3 class="text-4xl font-black text-emerald-500 tracking-tighter">{{ $stats['successful_payments'] }}</h3>
            </div>
            <div class="glass p-10 rounded-[3rem] border-white/5" data-aos="fade-up" data-aos-delay="200">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Pending</p>
                <h3 class="text-4xl font-black text-amber-500 tracking-tighter">{{ $stats['pending_payments'] }}</h3>
            </div>
            <div class="glass p-10 rounded-[3rem] border-white/5" data-aos="fade-up" data-aos-delay="300">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Failed</p>
                <h3 class="text-4xl font-black text-rose-500 tracking-tighter">{{ $stats['failed_payments'] }}</h3>
            </div>
        </div>

        <!-- Payments Ledger -->
        <div class="glass rounded-[4rem] border-white/5 overflow-hidden shadow-2xl" data-aos="fade-up" data-aos-delay="400">
            <div class="p-12 border-b border-white/5 flex items-center justify-between">
                <h3 class="text-2xl font-black text-white uppercase tracking-tighter">Transaction <span class="text-blue-600 italic">History</span></h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/2">
                            <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Transaction Info</th>
                            <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">User / Invoice</th>
                            <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Amount & Status</th>
                            <th class="px-12 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($payments as $payment)
                        <tr class="group hover:bg-white/2 transition-colors">
                            <td class="px-12 py-8">
                                <p class="text-sm font-black text-white uppercase tracking-tighter mb-1">{{ $payment->payment_id }}</p>
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Method: {{ strtoupper($payment->method) }}</p>
                                <p class="text-[9px] text-slate-500 mt-1">{{ $payment->created_at->format('M d, Y • h:i A') }}</p>
                            </td>
                            <td class="px-12 py-8">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl overflow-hidden shrink-0 border border-white/10">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($payment->booking->user->name ?? 'User') }}&background=1e293b&color=fff" class="w-full h-full object-cover" alt="">
                                    </div>
                                    <div>
                                        <a href="{{ isset($payment->booking->user) ? route('admin.users.show', $payment->booking->user) : '#' }}" class="text-xs font-black text-white hover:text-blue-500 uppercase tracking-widest transition-colors block">{{ $payment->booking->user->name ?? 'Unknown' }}</a>
                                        @if($payment->booking && $payment->booking->invoice)
                                            <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">{{ $payment->booking->invoice->invoice_number }}</span>
                                        @else
                                            <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest border border-slate-700 px-2 py-0.5 rounded">No Invoice</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-12 py-8">
                                <p class="text-lg font-black text-white tracking-tighter mb-2">{{ $payment->currency }} {{ number_format($payment->amount) }}</p>
                                <span class="px-3 py-1 text-[9px] font-black rounded-full uppercase tracking-widest border {{ $payment->status === 'success' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : ($payment->status === 'failed' ? 'bg-rose-500/10 text-rose-500 border-rose-500/20' : 'bg-amber-500/10 text-amber-500 border-amber-500/20') }}">
                                    {{ $payment->status }}
                                </span>
                            </td>
                            <td class="px-12 py-8 text-right">
                                @if($payment->booking && $payment->booking->invoice)
                                <a href="{{ route('bookings.invoice', $payment->booking) }}" target="_blank" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-600/10 text-blue-500 hover:bg-blue-600 hover:text-white transition-all ml-auto" title="Download Invoice">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </a>
                                @else
                                <span class="text-[10px] font-bold text-slate-600 italic">N/A</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-12 py-24 text-center text-slate-500 font-bold italic">No financial transactions recorded yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-8 border-t border-white/5">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
