@extends('layouts.admin')
@section('header', 'Manage Packages')
@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-black text-white uppercase tracking-tighter">Tour <span class="text-purple-500 italic">Packages</span></h2>
        <a href="{{ route('admin.packages.create') }}" class="btn-luxury px-8 py-4 !text-xs">+ Add Package</a>
    </div>
    @if(session('success'))<div class="glass p-6 rounded-2xl border-emerald-500/20 text-emerald-400 font-bold text-sm">{{ session('success') }}</div>@endif
    <div class="glass rounded-[3rem] border-white/5 overflow-hidden">
        <table class="w-full text-left">
            <thead><tr class="bg-white/2">
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Name</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Destination</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Category</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Price</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Days</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Actions</th>
            </tr></thead>
            <tbody class="divide-y divide-white/5">
                @foreach($packages as $p)
                <tr class="hover:bg-white/2 transition-colors">
                    <td class="px-8 py-6 text-sm font-black text-white">{{ Str::limit($p->name, 30) }}</td>
                    <td class="px-8 py-6 text-xs text-slate-400">{{ $p->destination->name ?? '-' }}</td>
                    <td class="px-8 py-6"><span class="px-3 py-1 glass rounded-lg text-[9px] font-black text-purple-400 uppercase">{{ $p->category }}</span></td>
                    <td class="px-8 py-6 text-sm font-bold text-white">₹{{ number_format($p->price) }}</td>
                    <td class="px-8 py-6 text-xs text-slate-400">{{ $p->duration_days }}</td>
                    <td class="px-8 py-6 text-right space-x-4">
                        <a href="{{ route('admin.packages.edit', $p) }}" class="text-blue-500 hover:text-white text-xs font-bold">Edit</a>
                        <form action="{{ route('admin.packages.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="text-rose-500 hover:text-white text-xs font-bold">Delete</button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pt-8">{{ $packages->links() }}</div>
</div>
@endsection
