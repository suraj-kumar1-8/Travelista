@extends('layouts.admin')
@section('header', 'Manage Destinations')
@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-black text-white uppercase tracking-tighter">All <span class="text-blue-600 italic">Gateways</span></h2>
        <a href="{{ route('admin.destinations.create') }}" class="btn-luxury px-8 py-4 !text-xs">+ Add Destination</a>
    </div>

    @if(session('success'))
    <div class="glass p-6 rounded-2xl border-emerald-500/20 text-emerald-400 font-bold text-sm">{{ session('success') }}</div>
    @endif

    <div class="glass rounded-[3rem] border-white/5 overflow-hidden">
        <table class="w-full text-left">
            <thead><tr class="bg-white/2">
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Image</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Name</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Location</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Category</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Actions</th>
            </tr></thead>
            <tbody class="divide-y divide-white/5">
                @foreach($destinations as $d)
                <tr class="hover:bg-white/2 transition-colors">
                    <td class="px-8 py-6"><img src="{{ $d->image_url }}" class="w-16 h-12 rounded-xl object-cover" alt="" onerror="this.src='https://via.placeholder.com/150'"></td>
                    <td class="px-8 py-6 text-sm font-black text-white">{{ $d->name }}</td>
                    <td class="px-8 py-6 text-xs text-slate-400">{{ $d->location }}</td>
                    <td class="px-8 py-6"><span class="px-3 py-1 glass rounded-lg text-[9px] font-black text-blue-400 uppercase">{{ $d->category }}</span></td>
                    <td class="px-8 py-6 text-right space-x-4">
                        <a href="{{ route('admin.destinations.edit', $d) }}" class="text-blue-500 hover:text-white text-xs font-bold">Edit</a>
                        <form action="{{ route('admin.destinations.destroy', $d) }}" method="POST" class="inline" onsubmit="return confirm('Delete this destination?')">
                            @csrf @method('DELETE')
                            <button class="text-rose-500 hover:text-white text-xs font-bold">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pt-8">{{ $destinations->links() }}</div>
</div>
@endsection
