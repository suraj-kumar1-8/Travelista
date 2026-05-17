<?php
$f = "resources/views/packages/show.blade.php";
$c = file_get_contents($f);

// We need to replace the form tag and its contents.
// It's from `<form action="{{ route('bookings.store') }}"` up to `</form>` before the `@auth` wishlist area.

$replacement = <<<'HTML'
                        <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm" class="space-y-8" 
                            x-data="{ 
                                travelers: 1, 
                                price: {{ $package->price }},
                                couponCode: '',
                                discountAmount: 0,
                                taxes: 0,
                                isValidatingCoupon: false,
                                couponMessage: '',
                                couponValid: false,
                                
                                get subtotal() {
                                    return Math.max(0, (this.travelers * this.price) - this.discountAmount);
                                },
                                get taxAmount() {
                                    return this.subtotal * 0.18;
                                },
                                get grandTotal() {
                                    return this.subtotal + this.taxAmount;
                                },
                                
                                validateCoupon() {
                                    if(!this.couponCode) {
                                        this.discountAmount = 0;
                                        this.couponMessage = '';
                                        this.couponValid = false;
                                        return;
                                    }
                                    
                                    this.isValidatingCoupon = true;
                                    this.couponMessage = 'Validating...';
                                    
                                    fetch('{{ route('coupons.validate') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            code: this.couponCode,
                                            amount: this.travelers * this.price
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        this.isValidatingCoupon = false;
                                        if(data.valid) {
                                            this.discountAmount = data.discount;
                                            this.couponValid = true;
                                            this.couponMessage = data.message;
                                        } else {
                                            this.discountAmount = 0;
                                            this.couponValid = false;
                                            this.couponMessage = data.message;
                                        }
                                    })
                                    .catch(error => {
                                        this.isValidatingCoupon = false;
                                        this.discountAmount = 0;
                                        this.couponValid = false;
                                        this.couponMessage = 'Error validating coupon';
                                    });
                                }
                            }"
                            x-init="$watch('travelers', value => { if(couponCode) validateCoupon(); })">
                            @csrf
                            <input type="hidden" name="bookable_type" value="TourPackage">
                            <input type="hidden" name="bookable_id" value="{{ $package->id }}">

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-2">Expedition Start</label>
                                <input type="date" name="start_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold">
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-2">Explorers Count</label>
                                <div class="flex items-center space-x-4 bg-white/5 rounded-2xl px-6 py-2">
                                    <button type="button" @click="travelers = Math.max(1, travelers - 1)" class="w-10 h-10 flex items-center justify-center text-slate-500 hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                    </button>
                                    <input type="number" name="travelers" x-model="travelers" min="1" max="10" class="flex-grow bg-transparent border-none text-center text-xl font-black text-white focus:ring-0">
                                    <button type="button" @click="travelers = Math.min(10, travelers + 1)" class="w-10 h-10 flex items-center justify-center text-slate-500 hover:text-white transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-2">Coupon Code</label>
                                <div class="relative">
                                    <input type="text" name="coupon_code" x-model="couponCode" @change="validateCoupon" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold" placeholder="TRAVEL20">
                                    <button type="button" @click="validateCoupon" class="absolute right-2 top-2 bottom-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-4 rounded-xl transition-colors" x-text="isValidatingCoupon ? '...' : 'Apply'"></button>
                                </div>
                                <p x-show="couponMessage" :class="couponValid ? 'text-emerald-500' : 'text-rose-500'" class="text-xs font-bold px-2" x-text="couponMessage" style="display: none;"></p>
                            </div>

                            <!-- Dynamic Price Summary -->
                            <div class="glass p-6 rounded-2xl border-white/5 space-y-4">
                                <div class="flex justify-between text-xs font-bold text-slate-400">
                                    <span>Base Package <span x-text="'(x'+travelers+')'"></span></span>
                                    <span class="text-white" x-text="'₹' + (travelers * price).toLocaleString('en-IN')"></span>
                                </div>
                                
                                <div x-show="discountAmount > 0" style="display: none;" class="flex justify-between text-xs font-bold text-emerald-400">
                                    <span>Coupon Discount</span>
                                    <span x-text="'-₹' + discountAmount.toLocaleString('en-IN')"></span>
                                </div>

                                <div class="flex justify-between text-xs font-bold text-slate-400">
                                    <span>Taxes (18%)</span>
                                    <span class="text-white" x-text="'₹' + taxAmount.toLocaleString('en-IN')"></span>
                                </div>

                                <div class="border-t border-white/10 pt-4 flex justify-between">
                                    <span class="text-sm font-black text-white uppercase tracking-widest">Total</span>
                                    <span class="text-2xl font-black text-emerald-500" x-text="'₹' + grandTotal.toLocaleString('en-IN')"></span>
                                </div>
                            </div>

                            @auth
                            <button type="submit" class="btn-luxury w-full py-6 text-sm flex items-center justify-center space-x-3">
                                <span>Reserve Expedition</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="btn-luxury w-full py-6 text-sm flex items-center justify-center space-x-3">
                                <span>Login to Reserve</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                            @endauth
                        </form>
HTML;

$pattern = '/<form action="\{\{ route\(\'bookings\.store\'\) \}\}" method="POST".+?<\/form>/s';
$c = preg_replace($pattern, $replacement, $c);

file_put_contents($f, $c);
?>
