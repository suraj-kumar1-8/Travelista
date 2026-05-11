@extends('layouts.admin')
@section('header', 'New Blog Post')
@section('content')
<div class="max-w-3xl">
    <form action="{{ route('admin.blogs.store') }}" method="POST" class="glass p-12 rounded-[3rem] border-white/5 space-y-8">
        @csrf
        <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Title</label><input type="text" name="title" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Category</label><input type="text" name="category" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Excerpt</label><textarea name="excerpt" rows="2" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></textarea></div>
        <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Content</label><textarea name="content" rows="8" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></textarea></div>
        <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Image URL</label><input type="url" name="image_url" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        <button type="submit" class="btn-luxury px-12 py-5">Publish Blog</button>
    </form>
</div>
@endsection
