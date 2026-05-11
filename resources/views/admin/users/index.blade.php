@extends('layouts.admin')
@section('header', 'Traveler Directory')
@section('content')
<div class="space-y-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6" data-aos="fade-down">
        <div>
            <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Traveler <span class="text-blue-500 italic">Directory</span></h2>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-2">{{ $users->total() }} registered travelers</p>
        </div>
        <!-- Search form -->
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex items-center gap-4">
            <div class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"></path></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search traveler..." class="bg-slate-900 border border-white/10 text-white text-sm font-bold rounded-2xl pl-12 pr-6 py-3 focus:ring-2 focus:ring-blue-600 w-64">
            </div>
            <button type="submit" class="btn-luxury py-3 px-6 text-xs">Search</button>
        </form>
    </div>

    @if(session('success'))
        <div class="glass p-6 rounded-2xl border-emerald-500/20 text-emerald-400 font-bold text-sm">{{ session('success') }}</div>
    @endif

    <!-- Users Table -->
    <div class="glass rounded-[3rem] border-white/5 overflow-hidden shadow-2xl" data-aos="fade-up">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-white/2 border-b border-white/5">
                    <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Traveler</th>
                    <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Email</th>
                    <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Role</th>
                    <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Trips</th>
                    <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Total Spent</th>
                    <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Joined</th>
                    <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($users as $user)
                <tr class="group hover:bg-white/2 transition-colors cursor-pointer" onclick="window.location='{{ route('admin.users.show', $user) }}'">
                    <td class="px-10 py-8">
                        <div class="flex items-center space-x-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1e293b&color=3b82f6&size=80" class="w-12 h-12 rounded-2xl border border-white/10 group-hover:border-blue-600/30 transition-colors" alt="">
                            <div>
                                <span class="text-sm font-black text-white group-hover:text-blue-400 transition-colors">{{ $user->name }}</span>
                                @if($user->email_verified_at)
                                    <span class="block text-[9px] font-black text-emerald-500 uppercase tracking-widest">✓ Verified</span>
                                @else
                                    <span class="block text-[9px] font-black text-amber-500 uppercase tracking-widest">⚠ Unverified</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-10 py-8 text-xs text-slate-400 font-medium">{{ $user->email }}</td>
                    <td class="px-10 py-8">
                        <span class="px-4 py-1.5 glass rounded-xl text-[9px] font-black {{ $user->role === 'admin' ? 'text-rose-400 border border-rose-400/20 bg-rose-500/10' : 'text-blue-400 border border-blue-400/20 bg-blue-500/10' }} uppercase tracking-widest">{{ $user->role }}</span>
                    </td>
                    <td class="px-10 py-8">
                        <span class="text-lg font-black text-white">{{ $user->bookings_count ?? 0 }}</span>
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest ml-1">trips</span>
                    </td>
                    <td class="px-10 py-8">
                        <span class="text-sm font-black text-blue-400">₹{{ number_format($user->bookings->where('status','confirmed')->sum('total_price')) }}</span>
                    </td>
                    <td class="px-10 py-8 text-xs text-slate-400 font-medium">{{ $user->created_at->format('d M, Y') }}</td>
                    <td class="px-10 py-8 text-right">
                        <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-600/10 text-blue-500 hover:bg-blue-600 hover:text-white transition-all" title="View Dossier" onclick="event.stopPropagation()">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-12 py-24 text-center text-slate-500 font-bold italic">No travelers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pt-4">{{ $users->links() }}</div>
</div>
@endsection

