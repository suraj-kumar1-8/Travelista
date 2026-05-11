@extends('layouts.admin')
@section('header', 'Edit Blog Post')
@section('content')
<div class="max-w-3xl">
    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" class="glass p-12 rounded-[3rem] border-white/5 space-y-8">
        @csrf @method('PUT')
        <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Title</label><input type="text" name="title" value="{{ $blog->title }}" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Category</label><input type="text" name="category" value="{{ $blog->category }}" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600"></div>
        <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Excerpt</label><textarea name="excerpt" rows="2" class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600">{{ $blog->excerpt }}</textarea></div>
        <div><label class="text-[10px] font-black text-slate-500 uppercase block mb-2 px-2">Content</label><textarea name="content" rows="8" required class="w-full bg-white/5 border-none rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600">{{ $blog->content }}</textarea></div>
        <button type="submit" class="btn-luxury px-12 py-5">Update Blog</button>
    </form>
</div>
@endsection
