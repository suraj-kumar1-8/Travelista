<?php
$f = "resources/views/hotels/show.blade.php";
$c = file_get_contents($f);

// 1. replace the Alpine.data block
$replacementAlpine = <<<'JS'
                    Alpine.data('hotelBooking', (price) => ({
                        price: price,
                        travelers: 1,
                        startDate: '',
                        endDate: '',
                        nights: 1,
                        couponCode: '',
                        discountAmount: 0,
                        isValidatingCoupon: false,
                        couponMessage: '',
                        couponValid: false,
                        
                        calculateNights() {
                            if (this.startDate && this.endDate) {
                                const start = new Date(this.startDate);
                                const end = new Date(this.endDate);
                                const diffTime = Math.abs(end - start);
                                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                                this.nights = diffDays > 0 ? diffDays : 1;
                                this.validateCoupon();
                            }
                        },
                        
                        get roomsNeeded() {
                            return Math.max(1, Math.ceil(this.travelers / 2));
                        },
                        get baseTotal() {
                            return this.price * this.nights * this.roomsNeeded;
                        },
                        get subtotal() {
                            return Math.max(0, this.baseTotal - this.discountAmount);
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
                            
                            fetch('/coupons/validate', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    code: this.couponCode,
                                    amount: this.baseTotal
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
                    }))
JS;

$c = preg_replace('/Alpine\.data\(\'hotelBooking\', \(price\) => \(\{.*?\}\)\)/s', $replacementAlpine, $c);

// 2. replace the coupon code input
$couponHtml = <<<'HTML'
                                <div class="space-y-3 mb-8">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-2">Coupon Code</label>
                                    <div class="relative">
                                        <input type="text" name="coupon_code" x-model="couponCode" @change="validateCoupon" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white focus:ring-2 focus:ring-blue-600 transition-all font-bold" placeholder="SUMMER50">
                                        <button type="button" @click="validateCoupon" class="absolute right-2 top-2 bottom-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-4 rounded-xl transition-colors" x-text="isValidatingCoupon ? '...' : 'Apply'"></button>
                                    </div>
                                    <p x-show="couponMessage" :class="couponValid ? 'text-emerald-500' : 'text-rose-500'" class="text-xs font-bold px-2 mt-1" x-text="couponMessage" style="display: none;"></p>
                                </div>
HTML;

$c = preg_replace('/<div class="space-y-3 mb-8">\s*<label[^>]+>Coupon Code<\/label>\s*<input type="text" name="coupon_code"[^>]+>\s*<\/div>/', $couponHtml, $c);

// 3. update the dynamic summary part in hotel
$summaryHtml = <<<'HTML'
                                <!-- Dynamic Summary -->
                                <div class="glass p-6 rounded-2xl border-white/5 mb-8 space-y-4">
                                    <div class="flex justify-between items-center text-sm font-bold text-slate-400">
                                        <span>Rooms (<span x-text="roomsNeeded"></span>) × Nights (<span x-text="nights"></span>)</span>
                                        <span class="text-white" x-text="'₹' + baseTotal.toLocaleString('en-IN')"></span>
                                    </div>
                                    
                                    <div x-show="discountAmount > 0" style="display: none;" class="flex justify-between items-center text-sm font-bold text-emerald-400">
                                        <span>Coupon Discount</span>
                                        <span x-text="'-₹' + discountAmount.toLocaleString('en-IN')"></span>
                                    </div>

                                    <div class="flex justify-between items-center text-sm font-bold text-slate-400">
                                        <span>Taxes (18%)</span>
                                        <span class="text-white" x-text="'₹' + taxAmount.toLocaleString('en-IN')"></span>
                                    </div>
                                    
                                    <div class="pt-4 border-t border-white/10 flex justify-between items-center">
                                        <span class="text-sm font-black text-white uppercase tracking-widest">Total</span>
                                        <span class="text-2xl font-black text-blue-500" x-text="'₹' + grandTotal.toLocaleString('en-IN')"></span>
                                    </div>
                                </div>
HTML;

$patternSummary = '/<!-- Dynamic Summary -->.*?<\/div>\s*<\/div>/s';
$c = preg_replace($patternSummary, $summaryHtml, $c);

file_put_contents($f, $c);
?>
