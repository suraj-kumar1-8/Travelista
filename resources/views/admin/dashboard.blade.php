<x-admin-layout>
    <div class="space-y-12">
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-8" data-aos="fade-down">
            <div>
                <h1 class="text-4xl font-black text-white uppercase tracking-tighter">Command <span class="text-blue-600 italic">Center</span></h1>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-2">Overseeing Indian Tourism Operations</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('admin.bookings.index') }}" class="btn-luxury py-3 px-6 text-xs bg-emerald-600/20 text-emerald-400 hover:bg-emerald-600 hover:text-white">Manage Bookings</a>
                <button class="btn-luxury py-3 px-6 text-xs bg-blue-600/20 text-blue-400 hover:bg-blue-600 hover:text-white">Download Report</button>
            </div>
        </div>

        <!-- Comprehensive Analytics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Revenue -->
            <div class="glass p-8 rounded-[3rem] border-white/5 relative overflow-hidden group hover:border-blue-600/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="0">
                <div class="w-12 h-12 bg-blue-600/20 rounded-2xl flex items-center justify-center mb-6 text-blue-500 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Total Revenue</p>
                <h3 class="text-3xl font-black text-white tracking-tighter">₹{{ number_format($stats['total_revenue']) }}</h3>
            </div>
            <!-- Users -->
            <div class="glass p-8 rounded-[3rem] border-white/5 relative overflow-hidden group hover:border-emerald-600/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 bg-emerald-600/20 rounded-2xl flex items-center justify-center mb-6 text-emerald-500 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Total Users</p>
                        <h3 class="text-3xl font-black text-white tracking-tighter">{{ number_format($stats['total_users']) }}</h3>
                    </div>
                    <div class="text-right">
                        <p class="text-[9px] font-bold text-emerald-400">+{{ $stats['recent_users'] }} this week</p>
                    </div>
                </div>
            </div>
            <!-- Bookings -->
            <div class="glass p-8 rounded-[3rem] border-white/5 relative overflow-hidden group hover:border-purple-600/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 bg-purple-600/20 rounded-2xl flex items-center justify-center mb-6 text-purple-500 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Total Bookings</p>
                        <h3 class="text-3xl font-black text-white tracking-tighter">{{ number_format($stats['total_bookings']) }}</h3>
                    </div>
                    <div class="text-right">
                        <p class="text-[9px] font-bold text-emerald-400">{{ $stats['confirmed_bookings'] }} Confirmed</p>
                    </div>
                </div>
            </div>
            <!-- Pending -->
            <div class="glass p-8 rounded-[3rem] border-white/5 relative overflow-hidden group hover:border-amber-600/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="300">
                <div class="w-12 h-12 bg-amber-600/20 rounded-2xl flex items-center justify-center mb-6 text-amber-500 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Pending Actions</p>
                        <h3 class="text-3xl font-black text-white tracking-tighter">{{ number_format($stats['pending_bookings']) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deep Analytics row -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 text-center">
                <p class="text-xs text-slate-400 font-bold mb-1">Hotel Bookings</p>
                <p class="text-2xl font-black text-white">{{ $stats['hotel_bookings'] }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 text-center">
                <p class="text-xs text-slate-400 font-bold mb-1">Package Bookings</p>
                <p class="text-2xl font-black text-white">{{ $stats['package_bookings'] }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 text-center">
                <p class="text-xs text-slate-400 font-bold mb-1">Active Users</p>
                <p class="text-2xl font-black text-white">{{ $stats['active_users'] }}</p>
            </div>
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 text-center">
                <p class="text-xs text-slate-400 font-bold mb-1">Cancellations</p>
                <p class="text-2xl font-black text-rose-500">{{ $stats['cancelled_bookings'] }}</p>
            </div>
        </div>

        <!-- Charts & Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Analytics Graph -->
            <div class="lg:col-span-2 glass p-10 rounded-[4rem] border-white/5 shadow-2xl" data-aos="fade-right">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-2xl font-black text-white uppercase tracking-tighter">Growth <span class="text-blue-600 italic">Dynamics</span></h3>
                    <div class="flex space-x-2">
                        <span class="flex items-center text-[10px] font-black text-blue-400 uppercase tracking-widest"><div class="w-2 h-2 rounded-full bg-blue-500 mr-2"></div> Revenue</span>
                        <span class="flex items-center text-[10px] font-black text-purple-400 uppercase tracking-widest"><div class="w-2 h-2 rounded-full bg-purple-500 mr-2"></div> Bookings</span>
                    </div>
                </div>
                <div class="h-80 w-full relative">
                    <canvas id="growthChart"></canvas>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="glass rounded-[4rem] border-white/5 overflow-hidden flex flex-col" data-aos="fade-left">
                <div class="p-8 border-b border-white/5">
                    <h3 class="text-xl font-black text-white uppercase tracking-tighter">Live <span class="text-emerald-600 italic">Transactions</span></h3>
                </div>
                <div class="flex-grow overflow-y-auto">
                    @forelse($recentBookings as $booking)
                    <div class="p-6 border-b border-white/5 hover:bg-white/5 transition-colors">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($booking->user->name ?? 'User') }}&background=1e293b&color=fff" class="w-8 h-8 rounded-xl" alt="">
                                <div>
                                    <span class="text-xs font-black text-white uppercase tracking-widest block">{{ $booking->user->name ?? 'User' }}</span>
                                    <span class="text-[9px] text-slate-500 uppercase tracking-widest">{{ $booking->bookable->name ?? 'Unknown' }}</span>
                                </div>
                            </div>
                            <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">{{ $booking->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center justify-between pl-11">
                            <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest">₹{{ number_format($booking->total_price) }}</span>
                            <span class="text-[8px] font-black {{ $booking->status === 'confirmed' ? 'text-emerald-500' : ($booking->status === 'cancelled' ? 'text-rose-500' : 'text-amber-500') }} uppercase tracking-widest border border-white/5 px-2 py-1 rounded-full">{{ $booking->status }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="p-20 text-center text-slate-500 font-bold italic">No live operations.</div>
                    @endforelse
                </div>
                <a href="{{ route('admin.bookings.index') }}" class="p-6 text-center text-[10px] font-black text-blue-600 uppercase tracking-widest hover:bg-white/5 transition-all block bg-white/2">View All Transactions</a>
            </div>
        </div>

        <!-- Inventory Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="glass p-8 flex items-center justify-between rounded-[3rem] border-white/5">
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Destinations Database</p>
                    <h3 class="text-3xl font-black text-white tracking-tighter">{{ $stats['total_destinations'] }} <span class="text-sm text-slate-500 font-medium">locations</span></h3>
                </div>
                <div class="w-12 h-12 bg-white/5 rounded-full flex items-center justify-center text-slate-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div class="glass p-8 flex items-center justify-between rounded-[3rem] border-white/5">
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Tour Packages</p>
                    <h3 class="text-3xl font-black text-white tracking-tighter">{{ $stats['total_packages'] }} <span class="text-sm text-slate-500 font-medium">active</span></h3>
                </div>
                <div class="w-12 h-12 bg-white/5 rounded-full flex items-center justify-center text-slate-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                </div>
            </div>
            <div class="glass p-8 flex items-center justify-between rounded-[3rem] border-white/5">
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Partner Hotels</p>
                    <h3 class="text-3xl font-black text-white tracking-tighter">{{ $stats['total_hotels'] }} <span class="text-sm text-slate-500 font-medium">properties</span></h3>
                </div>
                <div class="w-12 h-12 bg-white/5 rounded-full flex items-center justify-center text-slate-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($chartData);
            
            const ctx = document.getElementById('growthChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: chartData.labels,
                        datasets: [
                            {
                                label: 'Revenue (₹)',
                                data: chartData.revenue,
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                fill: true,
                                tension: 0.4,
                                borderWidth: 3,
                                pointBackgroundColor: '#3b82f6',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                yAxisID: 'y'
                            },
                            {
                                label: 'Bookings',
                                data: chartData.bookings,
                                borderColor: '#a855f7',
                                backgroundColor: 'transparent',
                                borderDash: [5, 5],
                                fill: false,
                                tension: 0.4,
                                borderWidth: 3,
                                pointBackgroundColor: '#a855f7',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                yAxisID: 'y1'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        },
                        plugins: { 
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: 'rgba(15, 23, 42, 0.9)',
                                titleColor: '#fff',
                                bodyColor: '#cbd5e1',
                                borderColor: 'rgba(255,255,255,0.1)',
                                borderWidth: 1,
                                padding: 12,
                                boxPadding: 6,
                                usePointStyle: true,
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.datasetIndex === 0) {
                                            label += '₹' + context.parsed.y.toLocaleString();
                                        } else {
                                            label += context.parsed.y;
                                        }
                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: { 
                                grid: { display: false, drawBorder: false }, 
                                ticks: { color: '#64748b', font: { weight: 'bold', size: 10 } } 
                            },
                            y: { 
                                type: 'linear',
                                display: true,
                                position: 'left',
                                grid: { color: 'rgba(255,255,255,0.05)', drawBorder: false }, 
                                ticks: { 
                                    color: '#3b82f6', 
                                    font: { weight: 'bold', size: 10 },
                                    callback: function(value) {
                                        return '₹' + (value/1000) + 'k';
                                    }
                                } 
                            },
                            y1: {
                                type: 'linear',
                                display: true,
                                position: 'right',
                                grid: { drawOnChartArea: false, drawBorder: false },
                                ticks: { color: '#a855f7', font: { weight: 'bold', size: 10 }, stepSize: 1 }
                            }
                        }
                    }
                });
            }
        });
    </script>
    @endpush
</x-admin-layout>
