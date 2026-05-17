<x-app-layout>
    <!-- Cinematic Hero Section -->
    <section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&q=80&w=2000" class="w-full h-full object-cover" alt="Trip Planner">
            <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-sm"></div>
        </div>
        <div class="relative z-10 text-center px-4" data-aos="fade-up">
            <span class="inline-block px-6 py-2 glass rounded-full text-[10px] font-black uppercase tracking-[0.5em] text-emerald-400 mb-8">Smart Travel</span>
            <h1 class="text-6xl md:text-8xl font-black text-white uppercase tracking-tighter leading-none mb-6">Trip <br> <span class="text-emerald-600 italic">Planner</span></h1>
            <p class="text-xl text-slate-400 font-medium max-w-2xl mx-auto">Design your perfect expedition based on your budget, schedule, and preferred travel style.</p>
        </div>
    </section>

    <!-- Trip Planner & Expense Calculator -->
    <section class="py-28 bg-slate-950" x-data="tripPlanner()">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-16">
                <!-- Smart Planner -->
                <div class="lg:w-1/2">
                    <h2 class="text-4xl font-black text-white uppercase tracking-tighter mb-6">Smart <span class="text-emerald-500 italic">Trip Planner</span></h2>
                    <p class="text-slate-400 font-medium mb-10">Plan by budget, days, travel type, and preferred state. Get instant destination, hotel, and package matches.</p>
                    <form @submit.prevent="submitPlan" class="glass p-10 rounded-[3rem] border-white/5 space-y-8 shadow-2xl relative">
                        <!-- Loading State Overlay -->
                        <div x-show="loadingPlanner" class="absolute inset-0 bg-slate-950/60 backdrop-blur-md rounded-[3rem] z-20 flex items-center justify-center" style="display: none;">
                            <div class="w-12 h-12 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="group">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 block group-hover:text-emerald-400 transition-colors">Budget (INR)</label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 font-bold">₹</span>
                                    <input type="number" x-model="planner.budget" min="1000" class="w-full bg-slate-900/50 border border-white/10 rounded-[2rem] pl-12 pr-6 py-4 text-white focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all outline-none font-bold" required>
                                </div>
                            </div>
                            <div class="group">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 block group-hover:text-emerald-400 transition-colors">Days</label>
                                <input type="number" x-model="planner.days" min="1" max="30" class="w-full bg-slate-900/50 border border-white/10 rounded-[2rem] px-6 py-4 text-white focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all outline-none font-bold" required>
                            </div>
                            <div class="group">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 block group-hover:text-emerald-400 transition-colors">Travel Type</label>
                                <div class="relative">
                                    <select x-model="planner.travel_type" class="w-full bg-slate-900/50 border border-white/10 rounded-[2rem] px-6 py-4 text-white focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all outline-none font-bold appearance-none cursor-pointer" required>
                                        <option value="adventure">Adventure & Thrill</option>
                                        <option value="honeymoon">Romantic Getaway</option>
                                        <option value="family">Family Vacation</option>
                                        <option value="religious">Spiritual & Religious</option>
                                        <option value="budget">Budget Backpacking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="group">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 block group-hover:text-emerald-400 transition-colors">Preferred State</label>
                                <div class="relative">
                                    <select x-model="planner.state_id" class="w-full bg-slate-900/50 border border-white/10 rounded-[2rem] px-6 py-4 text-white focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all outline-none font-bold appearance-none cursor-pointer" required>
                                        <option value="" disabled>Select a state</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-black text-sm uppercase tracking-widest py-5 rounded-[2rem] shadow-lg shadow-emerald-500/30 transition-all hover:scale-[1.02] transform duration-300">Generate Travel Plan</button>
                    </form>
                </div>

                <!-- Expense Estimator -->
                <div class="lg:w-1/2">
                    <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-6">Expense <span class="text-blue-500 italic">Estimator</span></h3>
                    <p class="text-slate-400 font-medium mb-10">Get a rough estimate of what your trip might cost based on the number of travelers and duration.</p>
                    <form @submit.prevent="calculateExpense" class="glass p-10 rounded-[3rem] border-white/5 space-y-8 shadow-2xl relative">
                        <!-- Loading State Overlay -->
                        <div x-show="loadingCalculator" class="absolute inset-0 bg-slate-950/60 backdrop-blur-md rounded-[3rem] z-20 flex items-center justify-center" style="display: none;">
                            <div class="w-12 h-12 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="group">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 block group-hover:text-blue-400 transition-colors">Budget (INR)</label>
                                <input type="number" x-model="calculator.budget" min="1000" class="w-full bg-slate-900/50 border border-white/10 rounded-[2rem] px-6 py-4 text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition-all outline-none font-bold" required>
                            </div>
                            <div class="group">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 block group-hover:text-blue-400 transition-colors">Days</label>
                                <input type="number" x-model="calculator.days" min="1" max="30" class="w-full bg-slate-900/50 border border-white/10 rounded-[2rem] px-6 py-4 text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition-all outline-none font-bold" required>
                            </div>
                            <div class="group">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 block group-hover:text-blue-400 transition-colors">Travel Type</label>
                                <div class="relative">
                                    <select x-model="calculator.travel_type" class="w-full bg-slate-900/50 border border-white/10 rounded-[2rem] px-6 py-4 text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition-all outline-none font-bold appearance-none cursor-pointer" required>
                                        <option value="adventure">Adventure & Thrill</option>
                                        <option value="honeymoon">Romantic Getaway</option>
                                        <option value="family">Family Vacation</option>
                                        <option value="religious">Spiritual & Religious</option>
                                        <option value="budget">Budget Backpacking</option>
                                    </select>
                                </div>
                            </div>
                            <div class="group">
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3 block group-hover:text-blue-400 transition-colors">Total Travelers</label>
                                <input type="number" x-model="calculator.travelers" min="1" max="20" class="w-full bg-slate-900/50 border border-white/10 rounded-[2rem] px-6 py-4 text-white focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 transition-all outline-none font-bold" required>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black text-sm uppercase tracking-widest py-5 rounded-[2rem] shadow-lg shadow-blue-500/30 transition-all hover:scale-[1.02] transform duration-300">Calculate Estimate</button>
                        
                        <!-- Calculation Result Box -->
                        <div x-show="calculationFetched" x-transition class="glass p-8 rounded-[2rem] border-white/5 mt-8 bg-slate-900/60 shadow-inner" style="display: none;">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div class="flex justify-between items-center border-b border-white/5 pb-3">
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Accommodation</p>
                                    <p class="text-sm font-bold text-white">₹<span x-text="calculation.hotel_cost?.toLocaleString() || 0"></span></p>
                                </div>
                                <div class="flex justify-between items-center border-b border-white/5 pb-3">
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Transport</p>
                                    <p class="text-sm font-bold text-white">₹<span x-text="calculation.transport_cost?.toLocaleString() || 0"></span></p>
                                </div>
                                <div class="flex justify-between items-center border-b border-white/5 pb-3">
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Food & Dining</p>
                                    <p class="text-sm font-bold text-white">₹<span x-text="calculation.food_cost?.toLocaleString() || 0"></span></p>
                                </div>
                                <div class="flex justify-between items-center border-b border-white/5 pb-3">
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Activities</p>
                                    <p class="text-sm font-bold text-white">₹<span x-text="calculation.activity_cost?.toLocaleString() || 0"></span></p>
                                </div>
                                <div class="flex justify-between items-center border-b border-white/5 pb-3 md:col-span-2">
                                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">GST (18%)</p>
                                    <p class="text-sm font-bold text-emerald-400">₹<span x-text="calculation.taxes?.toLocaleString() || 0"></span></p>
                                </div>
                            </div>
                            <div class="flex justify-between items-end bg-emerald-600/10 p-6 rounded-[1.5rem] border border-emerald-500/20">
                                <div>
                                    <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-1">Total Estimated</p>
                                    <p class="text-xs text-slate-400 font-medium italic">Based on Indian standard rates</p>
                                </div>
                                <p class="text-4xl font-black text-white tracking-tighter">₹<span x-text="calculation.estimated_total?.toLocaleString() || 0"></span></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Suggestions Results Area -->
            <div x-show="resultsFetched" x-transition class="mt-24" style="display: none;" id="planner-results">
                <div class="flex items-center justify-between mb-10">
                    <h3 class="text-3xl font-black text-white uppercase tracking-tighter">Your Travel <span class="text-emerald-500 italic">Blueprint</span></h3>
                    <span class="px-6 py-2 glass rounded-full text-[10px] font-black uppercase tracking-widest text-emerald-400 border border-emerald-400/20">Custom AI Generated</span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Destinations Match -->
                    <div class="glass p-8 rounded-[3rem] border-white/5 shadow-2xl flex flex-col h-full hover:border-emerald-500/30 transition-colors">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            </div>
                            <h4 class="text-lg font-black text-white uppercase tracking-widest">Recommended Destinations</h4>
                        </div>
                        <div class="space-y-4 flex-grow">
                            <template x-if="!results.suggestions?.destinations?.length">
                                <p class="text-sm text-slate-500 font-medium">No matching destinations found for your criteria.</p>
                            </template>
                            <template x-for="dest in results.suggestions?.destinations" :key="dest.id">
                                <a :href="`/destinations/${dest.slug}`" class="block p-4 rounded-2xl bg-slate-900/50 hover:bg-white/5 border border-white/5 transition-all group">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-bold text-white group-hover:text-emerald-400 transition-colors" x-text="dest.name"></span>
                                        <svg class="w-4 h-4 text-slate-500 group-hover:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </div>
                                </a>
                            </template>
                        </div>
                    </div>

                    <!-- Packages Match -->
                    <div class="glass p-8 rounded-[3rem] border-white/5 shadow-2xl flex flex-col h-full hover:border-blue-500/30 transition-colors">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-blue-500/10 flex items-center justify-center text-blue-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h4 class="text-lg font-black text-white uppercase tracking-widest">Suggested Packages</h4>
                        </div>
                        <div class="space-y-4 flex-grow">
                            <template x-if="!results.suggestions?.packages?.length">
                                <p class="text-sm text-slate-500 font-medium">No matching packages found.</p>
                            </template>
                            <template x-for="pkg in results.suggestions?.packages" :key="pkg.id">
                                <a :href="`/packages/${pkg.slug}`" class="block p-4 rounded-2xl bg-slate-900/50 hover:bg-white/5 border border-white/5 transition-all group">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-white group-hover:text-blue-400 transition-colors mb-2" x-text="pkg.name"></span>
                                        <div class="flex justify-between items-center">
                                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest" x-text="pkg.duration_days + ' Days'"></span>
                                            <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest" x-text="'₹' + pkg.price.toLocaleString()"></span>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </div>
                    </div>

                    <!-- Hotels Match -->
                    <div class="glass p-8 rounded-[3rem] border-white/5 shadow-2xl flex flex-col h-full hover:border-amber-500/30 transition-colors">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-amber-500/10 flex items-center justify-center text-amber-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <h4 class="text-lg font-black text-white uppercase tracking-widest">Recommended Stays</h4>
                        </div>
                        <div class="space-y-4 flex-grow">
                            <template x-if="!results.suggestions?.hotels?.length">
                                <p class="text-sm text-slate-500 font-medium">No matching hotels found.</p>
                            </template>
                            <template x-for="hotel in results.suggestions?.hotels" :key="hotel.id">
                                <a :href="`/hotels/${hotel.slug}`" class="block p-4 rounded-2xl bg-slate-900/50 hover:bg-white/5 border border-white/5 transition-all group">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-white group-hover:text-amber-400 transition-colors mb-2" x-text="hotel.name"></span>
                                        <div class="flex justify-between items-center">
                                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest" x-text="(hotel.rating || hotel.star_rating || 5) + ' Stars'"></span>
                                            <span class="text-[10px] font-black text-amber-400 uppercase tracking-widest" x-text="'₹' + hotel.price_per_night.toLocaleString() + '/night'"></span>
                                        </div>
                                    </div>
                                </a>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Activities Tag Cloud -->
                <div class="glass p-8 rounded-[3rem] border-white/5 mt-8 shadow-2xl">
                    <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6">Suggested Activities</h4>
                    <div class="flex flex-wrap gap-3">
                        <template x-if="!results.suggestions?.activities?.length">
                            <p class="text-sm text-slate-500 font-medium">No specific activities identified.</p>
                        </template>
                        <template x-for="activity in results.suggestions?.activities" :key="activity">
                            <span class="px-5 py-2 text-[10px] font-black text-white uppercase tracking-widest bg-slate-900/50 hover:bg-emerald-500/20 hover:text-emerald-400 rounded-full border border-white/10 transition-colors cursor-default" x-text="activity"></span>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script logic for Planner -->
    <script>
        function tripPlanner() {
            return {
                planner: { budget: 50000, days: 5, travel_type: 'adventure', state_id: {{ $states->first()->id ?? 1 }} },
                calculator: { budget: 50000, days: 5, travel_type: 'adventure', travelers: 2 },
                results: { suggestions: { destinations: [], packages: [], hotels: [], activities: [] } },
                calculation: { hotel_cost: 0, transport_cost: 0, food_cost: 0, activity_cost: 0, taxes: 0, estimated_total: 0 },
                calculationFetched: false,
                loadingPlanner: false,
                loadingCalculator: false,
                resultsFetched: false,
                
                submitPlan() {
                    this.loadingPlanner = true;
                    fetch("{{ route('trip-planner.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(this.planner)
                    })
                    .then(res => res.json())
                    .then(data => { 
                        this.results = data; 
                        this.resultsFetched = true;
                        this.loadingPlanner = false;
                        setTimeout(() => {
                            document.getElementById('planner-results').scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }, 100);
                    })
                    .catch((err) => {
                        console.error("Planner error:", err);
                        this.loadingPlanner = false;
                        alert("An error occurred while generating the plan. Please check your inputs.");
                    });
                },
                
                calculateExpense() {
                    this.loadingCalculator = true;
                    fetch("{{ route('trip-planner.calculate') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(this.calculator)
                    })
                    .then(res => res.json())
                    .then(data => { 
                        this.calculation = data.expense || data; 
                        this.calculationFetched = true;
                        this.loadingCalculator = false;
                    })
                    .catch((err) => {
                        console.error("Calculator error:", err);
                        this.loadingCalculator = false;
                        alert("An error occurred during calculation.");
                    });
                }
            };
        }
    </script>
</x-app-layout>
