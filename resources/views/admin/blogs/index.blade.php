@extends('layouts.admin')
@section('header', 'Manage Blogs')
@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-black text-white uppercase tracking-tighter">Blog <span class="text-indigo-500 italic">Journal</span></h2>
        <a href="{{ route('admin.blogs.create') }}" class="btn-luxury px-8 py-4 !text-xs">+ New Post</a>
    </div>
    @if(session('success'))<div class="glass p-6 rounded-2xl border-emerald-500/20 text-emerald-400 font-bold text-sm">{{ session('success') }}</div>@endif
    <div class="glass rounded-[3rem] border-white/5 overflow-hidden">
        <table class="w-full text-left">
            <thead><tr class="bg-white/2">
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase">Title</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase">Category</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase">Author</th>
                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase text-right">Actions</th>
            </tr></thead>
            <tbody class="divide-y divide-white/5">
                @foreach($blogs as $b)
                <tr class="hover:bg-white/2">
                    <td class="px-8 py-6 text-sm font-black text-white">{{ Str::limit($b->title, 40) }}</td>
                    <td class="px-8 py-6"><span class="px-3 py-1 glass rounded-lg text-[9px] font-black text-indigo-400 uppercase">{{ $b->category }}</span></td>
                    <td class="px-8 py-6 text-xs text-slate-400">{{ $b->author }}</td>
                    <td class="px-8 py-6 text-right space-x-4">
                        <a href="{{ route('admin.blogs.edit', $b) }}" class="text-blue-500 text-xs font-bold">Edit</a>
                        <form action="{{ route('admin.blogs.destroy', $b) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="text-rose-500 text-xs font-bold">Delete</button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pt-8">{{ $blogs->links() }}</div>
</div>
@endsection
