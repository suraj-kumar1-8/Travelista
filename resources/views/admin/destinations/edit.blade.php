@extends('layouts.admin')
@section('header', 'Edit Destination')
@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data" class="glass p-12 rounded-[3rem] border-white/5 space-y-8">
        @csrf @method('PUT')
        <h2 class="text-2xl font-black text-white uppercase tracking-tighter mb-8">Edit <span class="text-blue-600 italic">{{ $destination->name }}</span></h2>
        
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
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Name</label>
                <input type="text" name="name" value="{{ $destination->name }}" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Location</label>
                <input type="text" name="location" value="{{ $destination->location }}" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Category</label>
                <select name="category" class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
                    @foreach(['Mountains','Beaches','Nature','Heritage','Adventure','Religious'] as $c)
                        <option value="{{$c}}" {{ $destination->category === $c ? 'selected' : '' }} class="bg-slate-900">{{$c}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Status</label>
                <select name="status" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
                    <option value="active" {{ $destination->status === 'active' ? 'selected' : '' }} class="bg-slate-900">Active</option>
                    <option value="hidden" {{ $destination->status === 'hidden' ? 'selected' : '' }} class="bg-slate-900">Hidden</option>
                </select>
            </div>
        </div>

        <div>
            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Description</label>
            <textarea name="description" rows="4" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">{{ $destination->description }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Upload Multiple Images</label>
                <input type="file" name="upload_images[]" multiple accept="image/*" class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-3 text-white font-bold focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-blue-600/20 file:text-blue-500 hover:file:bg-blue-600/30">
                <p class="text-[9px] text-slate-500 mt-2 ml-2">Note: Uploading new images will append to existing ones.</p>
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest block mb-3 px-2">Or Provide Image URL (Legacy)</label>
                <input type="url" name="image_url" value="{{ $destination->getRawOriginal('image_url') }}" class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 transition-all">
            </div>
        </div>
        
        @if($destination->images)
        <div>
            <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Current Images</label>
            <div class="flex flex-wrap gap-4">
                @foreach(json_decode($destination->images, true) as $img)
                    <img src="{{ asset($img) }}" class="w-24 h-24 object-cover rounded-xl border border-white/10" alt="Destination Image">
                @endforeach
            </div>
        </div>
        @elseif($destination->getRawOriginal('image_url'))
        <div>
            <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Current Legacy Image</label>
            <img src="{{ asset($destination->getRawOriginal('image_url')) }}" class="w-32 h-32 object-cover rounded-xl border border-white/10" alt="Destination Image">
        </div>
        @endif

        <div class="pt-6">
            <button type="submit" class="btn-luxury w-full py-6 text-sm">Update Destination</button>
        </div>
    </form>
</div>
@endsection
