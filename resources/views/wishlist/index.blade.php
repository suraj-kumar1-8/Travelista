<x-dashboard-layout>
    <div class="space-y-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6" data-aos="fade-down">
            <h3 class="text-3xl font-black text-white uppercase tracking-tighter">My <span class="text-rose-600">Wishlist</span></h3>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">{{ $wishlists->count() }} Saved Items</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($wishlists as $item)
            @php $entity = $item->wishable; @endphp
            @if($entity)
            <div class="glass group rounded-[3rem] overflow-hidden border-white/5 transition-all duration-500 hover:border-rose-600/30" data-aos="fade-up">
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ $entity->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                    <div class="absolute top-6 right-6">
                        <button onclick="toggleWishlist('{{ class_basename($entity) }}', {{ $entity->id }}, this)" class="w-12 h-12 glass rounded-2xl flex items-center justify-center text-rose-600 hover:bg-rose-600 hover:text-white transition-all shadow-xl">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </button>
                    </div>
                </div>
                <div class="p-8">
                    <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-2 block">{{ class_basename($entity) }}</span>
                    <h4 class="text-2xl font-black text-white uppercase tracking-tighter mb-8 group-hover:text-rose-600 transition-colors">{{ $entity->name }}</h4>
                    
                    <div class="flex items-center justify-between pt-6 border-t border-white/5">
                         <p class="text-xl font-black text-white tracking-tighter">
                            @if(isset($entity->price))
                                ₹{{ number_format($entity->price) }}
                            @elseif(isset($entity->price_per_night))
                                ₹{{ number_format($entity->price_per_night) }}
                            @else
                                Featured
                            @endif
                         </p>
                         @php
                             $entityName = class_basename($entity);
                             $routeName = $entityName === 'TourPackage' ? 'packages.show' : Str::plural(strtolower($entityName)) . '.show';
                         @endphp
                         <a href="{{ route($routeName, $entity->slug) }}" class="text-[10px] font-black text-white uppercase tracking-widest hover:text-blue-500 transition-colors flex items-center">
                            <span>Details</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                         </a>
                    </div>
                </div>
            </div>
            @endif
            @empty
            <div class="col-span-full py-32 text-center" data-aos="fade-up">
                <div class="w-24 h-24 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-white uppercase tracking-tighter mb-4">Wishlist is Empty</h3>
                <p class="text-slate-500 mb-12 max-w-sm mx-auto font-medium">Your dream destinations are waiting to be discovered. Start adding them to your collection.</p>
                <a href="{{ route('destinations.index') }}" class="btn-luxury inline-block">Explore Gateways</a>
            </div>
            @endforelse
        </div>
    </div>

    <script>
        function toggleWishlist(type, id, btn) {
            fetch("{{ route('wishlist.toggle') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ wishable_type: type, wishable_id: id })
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'removed') {
                    // Refresh or remove from DOM
                    location.reload();
                }
            });
        }
    </script>
</x-dashboard-layout>
