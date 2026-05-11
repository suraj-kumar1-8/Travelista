@extends('layouts.admin')
@section('header', 'Add Package')
@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data" class="glass p-12 rounded-[3rem] border-white/5 space-y-8">
        @csrf
        @if($errors->any())
            <div class="p-6 rounded-2xl bg-rose-500/10 text-rose-400 text-sm font-bold border border-rose-500/20">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Package Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Destination</label>
                <select name="destination_id" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
                    @foreach($destinations as $d)
                        <option value="{{$d->id}}" class="bg-slate-900">{{$d->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="lg:col-span-1">
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Price (₹)</label>
                <input type="number" name="price" value="{{ old('price') }}" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
            </div>
            <div class="lg:col-span-1">
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Duration (Days)</label>
                <input type="number" name="duration_days" value="{{ old('duration_days') }}" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
            </div>
            <div class="lg:col-span-1">
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Category</label>
                <select name="category" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
                    @foreach(['Adventure','Family','Honeymoon','Budget','Premium'] as $c)
                        <option value="{{$c}}" class="bg-slate-900">{{$c}}</option>
                    @endforeach
                </select>
            </div>
            <div class="lg:col-span-1">
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Status</label>
                <select name="status" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
                    <option value="active" class="bg-slate-900">Active</option>
                    <option value="hidden" class="bg-slate-900">Hidden</option>
                </select>
            </div>
        </div>

        <div>
            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Description</label>
            <textarea name="description" rows="4" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Upload Multiple Images</label>
                <input type="file" name="upload_images[]" multiple accept="image/*" class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-3 text-white font-bold focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-blue-600/20 file:text-blue-500 hover:file:bg-blue-600/30">
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Or Provide Image URL (Legacy)</label>
                <input type="url" name="image_url" value="{{ old('image_url') }}" class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
            </div>
        </div>

        <div class="pt-6">
            <button type="submit" class="btn-luxury w-full py-6 text-sm">Create Package</button>
        </div>
    </form>
</div>
@endsection
