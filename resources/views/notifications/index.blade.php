<x-app-layout>
    <div class="py-24 bg-slate-950">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-3xl font-black text-white uppercase tracking-tighter mb-8">Your <span class="text-emerald-500 italic">Notifications</span></h1>
            
            <div class="glass p-8 rounded-[3rem] border-white/5 shadow-2xl relative overflow-hidden">
                @if($notifications->count() > 0)
                    <div class="flex justify-end mb-6">
                        <form action="{{ route('notifications.markAll') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs font-black text-emerald-400 uppercase tracking-widest hover:text-emerald-300">Mark all as read</button>
                        </form>
                    </div>
                @endif

                <div class="space-y-4">
                    @forelse($notifications as $notification)
                        <div class="p-6 rounded-2xl border {{ $notification->read_at ? 'border-white/5 bg-slate-900/50' : 'border-emerald-500/30 bg-emerald-500/10' }} flex justify-between items-center transition-all">
                            <div>
                                <h4 class="text-sm font-bold text-white mb-1">{{ str_replace('_', ' ', class_basename($notification->type)) }}</h4>
                                <p class="text-xs text-slate-400">{{ isset($notification->data['message']) ? $notification->data['message'] : 'You have a new notification.' }}</p>
                                <span class="text-[10px] text-slate-500 uppercase tracking-widest">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                            @if(!$notification->read_at)
                                <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-full bg-emerald-500/20 text-emerald-500 hover:bg-emerald-500 hover:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            </div>
                            <p class="text-slate-400 font-medium">You have no new notifications.</p>
                        </div>
                    @endforelse
                </div>
                
                @if($notifications->hasPages())
                    <div class="mt-8">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>