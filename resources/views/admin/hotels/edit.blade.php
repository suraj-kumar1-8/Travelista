@extends('layouts.admin')
@section('header', 'Edit Hotel')
@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.hotels.update', $hotel) }}" method="POST" enctype="multipart/form-data" class="glass p-12 rounded-[3rem] border-white/5 space-y-8">
        @csrf @method('PUT')
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
                <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Name</label>
                <input type="text" name="name" value="{{ $hotel->name }}" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Destination</label>
                <select name="destination_id" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                    @foreach($destinations as $d)
                        <option value="{{$d->id}}" {{ $hotel->destination_id == $d->id ? 'selected' : '' }} class="bg-slate-900">{{$d->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Price/Night (₹)</label>
                <input type="number" name="price_per_night" value="{{ $hotel->price_per_night }}" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Type</label>
                <select name="type" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                    @foreach(['Resort','Villas','Budget','Luxury'] as $t)
                        <option value="{{$t}}" {{ $hotel->type === $t ? 'selected' : '' }} class="bg-slate-900">{{$t}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Rating</label>
                <select name="rating" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                    @for($i=5;$i>=1;$i--)
                        <option value="{{$i}}" {{ $hotel->rating == $i ? 'selected' : '' }} class="bg-slate-900">{{$i}} Star</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Category</label>
                <select name="category" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                    @foreach(['Luxury','Budget','Premium','Boutique'] as $c)
                        <option value="{{$c}}" {{ $hotel->category === $c ? 'selected' : '' }} class="bg-slate-900">{{$c}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Status</label>
                <select name="status" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                    <option value="active" {{ $hotel->status === 'active' ? 'selected' : '' }} class="bg-slate-900">Active</option>
                    <option value="hidden" {{ $hotel->status === 'hidden' ? 'selected' : '' }} class="bg-slate-900">Hidden</option>
                </select>
            </div>
        </div>

        <div>
            <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Description</label>
            <textarea name="description" rows="4" required class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">{{ $hotel->description }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Upload Multiple Images</label>
                <input type="file" name="upload_images[]" multiple accept="image/*" class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-3 text-white font-bold focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-blue-600/20 file:text-blue-500 hover:file:bg-blue-600/30">
                <p class="text-[9px] text-slate-500 mt-2 ml-2">Note: Uploading new images will append to existing ones.</p>
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Or Provide Image URL (Legacy)</label>
                <input type="url" name="image_url" value="{{ $hotel->image_url }}" class="w-full bg-slate-900 border border-white/5 rounded-2xl px-6 py-4 text-white font-bold focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
            </div>
        </div>
        
        @if($hotel->images)
        <div>
            <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Current Images</label>
            <div class="flex flex-wrap gap-4">
                @foreach(json_decode($hotel->images, true) as $img)
                    <img src="{{ asset($img) }}" class="w-24 h-24 object-cover rounded-xl border border-white/10" alt="Hotel Image">
                @endforeach
            </div>
        </div>
        @elseif($hotel->image_url)
        <div>
            <label class="text-[10px] font-black text-slate-500 uppercase block mb-3 px-2 tracking-widest">Current Legacy Image</label>
            <img src="{{ asset($hotel->image_url) }}" class="w-32 h-32 object-cover rounded-xl border border-white/10" alt="Hotel Image">
        </div>
        @endif

        <div class="pt-6">
            <button type="submit" class="btn-luxury w-full py-6 text-sm">Update Luxury Stay</button>
        </div>
    </form>
</div>
@endsection
