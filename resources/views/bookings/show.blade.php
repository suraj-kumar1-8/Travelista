<x-app-layout>
    <section class="py-32 bg-slate-950">
        <div class="max-w-5xl mx-auto px-4">
            <div class="glass p-16 rounded-[4rem] border-white/5 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-600 to-emerald-600"></div>

                <!-- Booking Header -->
                <div class="text-center mb-16">
                    <span class="inline-block px-6 py-2 glass rounded-full text-[10px] font-black uppercase tracking-[0.5em] text-blue-400 mb-6">Booking Summary</span>
                    <h1 class="text-5xl font-black text-white uppercase tracking-tighter mb-4">Reservation <span class="text-blue-600 italic">Details</span></h1>
                    <p class="text-slate-500 font-bold uppercase tracking-widest text-xs">Reference: {{ $booking->booking_reference }}</p>
                </div>

                <!-- Status Badge -->
                <div class="text-center mb-12">
                    @php
                        $statusColors = [
                            'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                            'confirmed' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                            'cancelled' => 'bg-rose-500/10 text-rose-500 border-rose-500/20',
                            'completed' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                        ];
                    @endphp
                    <span class="inline-block px-8 py-3 {{ $statusColors[$booking->status] ?? 'bg-slate-500/10 text-slate-500' }} text-sm font-black rounded-full uppercase tracking-widest border">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>

                <!-- Booking Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
                    <div class="glass p-8 rounded-[2rem] border-white/5">
                        <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-2">Booked Item</p>
                        <p class="text-xl font-black text-white uppercase tracking-tighter">{{ $booking->bookable->name ?? 'N/A' }}</p>
                    </div>
                    <div class="glass p-8 rounded-[2rem] border-white/5">
                        <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-2">Travel Date</p>
                        <p class="text-xl font-black text-white">{{ \Carbon\Carbon::parse($booking->start_date)->format('d M, Y') }}</p>
                    </div>
                    <div class="glass p-8 rounded-[2rem] border-white/5">
                        <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-2">Travelers</p>
                        <p class="text-xl font-black text-white">{{ $booking->travelers }} {{ $booking->travelers > 1 ? 'Persons' : 'Person' }}</p>
                    </div>
                    <div class="glass p-8 rounded-[2rem] border-white/5">
                        <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-2">Total Amount</p>
                        <p class="text-3xl font-black text-white">₹{{ number_format($booking->total_price) }}</p>
                    </div>
                </div>

                @if($booking->bookable)
                <div class="glass rounded-[2rem] overflow-hidden border-white/5 mb-12">
                    <div class="flex flex-col md:flex-row">
                        <div class="w-full md:w-1/3 h-48 md:h-auto">
                            <img src="{{ $booking->bookable->image_url }}" class="w-full h-full object-cover" alt="" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=600'">
                        </div>
                        <div class="p-8 flex-grow">
                            <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-4">{{ $booking->bookable->name }}</h3>
                            <p class="text-sm text-slate-400 line-clamp-3">{{ $booking->bookable->description }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Payment Section -->
                @if($booking->status === 'pending')
                <div class="glass p-12 rounded-[2rem] border-white/5 text-center mt-12" x-data="{ selectedMethod: 'upi', showQR: false }">
                    <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-4">Complete <span class="text-emerald-500 italic">Payment</span></h3>
                    <p class="text-slate-400 mb-8">Choose your preferred payment method to confirm this reservation securely.</p>
                    
                    <div class="max-w-2xl mx-auto">
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                            <label class="glass p-4 rounded-2xl border-white/5 cursor-pointer hover:border-blue-600/30 transition-all text-center flex flex-col items-center justify-center h-24" :class="{ 'border-blue-500 bg-blue-500/10': selectedMethod === 'gpay' }">
                                <input type="radio" name="method" value="gpay" x-model="selectedMethod" class="sr-only">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/f/f2/Google_Pay_Logo.svg" class="h-6 mb-2 opacity-80" alt="GPay">
                                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">GPay</span>
                            </label>
                            
                            <label class="glass p-4 rounded-2xl border-white/5 cursor-pointer hover:border-blue-600/30 transition-all text-center flex flex-col items-center justify-center h-24" :class="{ 'border-blue-500 bg-blue-500/10': selectedMethod === 'phonepe' }">
                                <input type="radio" name="method" value="phonepe" x-model="selectedMethod" class="sr-only">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/7/71/PhonePe_Logo.svg" class="h-6 mb-2 opacity-80" alt="PhonePe">
                                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">PhonePe</span>
                            </label>

                            <label class="glass p-4 rounded-2xl border-white/5 cursor-pointer hover:border-blue-600/30 transition-all text-center flex flex-col items-center justify-center h-24" :class="{ 'border-blue-500 bg-blue-500/10': selectedMethod === 'paytm' }">
                                <input type="radio" name="method" value="paytm" x-model="selectedMethod" class="sr-only">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/24/Paytm_Logo_%28standalone%29.svg" class="h-4 mb-2 opacity-80" alt="Paytm">
                                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Paytm</span>
                            </label>

                            <label class="glass p-4 rounded-2xl border-white/5 cursor-pointer hover:border-blue-600/30 transition-all text-center flex flex-col items-center justify-center h-24" :class="{ 'border-blue-500 bg-blue-500/10': selectedMethod === 'qr' }">
                                <input type="radio" name="method" value="qr" x-model="selectedMethod" class="sr-only">
                                <svg class="w-6 h-6 mb-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Scan QR</span>
                            </label>

                            <label class="glass p-4 rounded-2xl border-white/5 cursor-pointer hover:border-blue-600/30 transition-all text-center flex flex-col items-center justify-center h-24" :class="{ 'border-blue-500 bg-blue-500/10': selectedMethod === 'card' }">
                                <input type="radio" name="method" value="card" x-model="selectedMethod" class="sr-only">
                                <svg class="w-6 h-6 mb-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Card</span>
                            </label>
                        </div>

                        <!-- Dynamic UI for QR Code -->
                        <div x-show="selectedMethod === 'qr'" x-collapse class="mb-8">
                            <div class="glass p-8 rounded-3xl border-white/5 inline-block bg-white">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=upi://pay?pa=travelista@upi&pn=Travelista&am={{ $booking->total_price }}" alt="UPI QR Code" class="mx-auto">
                            </div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-4">Scan with any UPI App (Test Mode)</p>
                        </div>

                        <form id="razorpay-form" action="{{ route('bookings.pay', $booking) }}" method="POST">
                            @csrf
                            <input type="hidden" name="method" x-model="selectedMethod">
                            <button type="button" onclick="openRazorpay()" class="btn-luxury w-full py-5 text-sm flex items-center justify-center shadow-2xl shadow-emerald-500/20">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                Proceed to Pay ₹{{ number_format($booking->total_price) }} securely
                            </button>
                        </form>
                    </div>
                </div>

                <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                <script>
                    function openRazorpay() {
                        var options = {
                            "key": "rzp_test_xxxxxxxxxxxxxxxx", // Test Mode Key
                            "amount": "{{ $booking->total_price * 100 }}", // Amount is in currency subunits. Default currency is INR.
                            "currency": "INR",
                            "name": "TRAVELISTA SAAS",
                            "description": "Booking Reference: {{ $booking->booking_reference }}",
                            "image": "https://ui-avatars.com/api/?name=TR&background=3b82f6&color=fff",
                            "handler": function (response){
                                // On success, submit the form to update DB
                                document.getElementById('razorpay-form').submit();
                            },
                            "prefill": {
                                "name": "{{ Auth::user()->name }}",
                                "email": "{{ Auth::user()->email }}",
                                "contact": "9999999999"
                            },
                            "theme": {
                                "color": "#0f172a"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    }
                </script>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-col md:flex-row gap-6 mt-12">
                    <a href="{{ route('bookings.invoice', $booking) }}" class="btn-luxury flex-1 py-5 text-center !bg-white/5 hover:!bg-blue-600">View Invoice</a>
                    <a href="{{ route('bookings.index') }}" class="btn-luxury flex-1 py-5 text-center !bg-white/5 hover:!bg-emerald-600">All Bookings</a>
                    <a href="{{ route('home') }}" class="btn-luxury flex-1 py-5 text-center">Continue Exploring</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
