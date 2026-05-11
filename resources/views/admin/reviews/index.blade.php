@extends('layouts.admin')
@section('header', 'Guest Reviews')
@section('content')
<div class="space-y-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6" data-aos="fade-down">
        <div>
            <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Community <span class="text-rose-500 italic">Feedback</span></h2>
            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-2">{{ $reviews->total() }} reviews submitted</p>
        </div>
    </div>

    @if(session('success'))
        <div class="glass p-6 rounded-2xl border-emerald-500/20 text-emerald-400 font-bold text-sm">{{ session('success') }}</div>
    @endif

    <!-- Table -->
    <div class="glass rounded-[3rem] border-white/5 overflow-hidden shadow-2xl" data-aos="fade-up">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/2 border-b border-white/5">
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Traveler</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Item Reviewed</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Rating</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Comment</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest">Date</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($reviews as $review)
                    <tr class="group hover:bg-white/2 transition-colors">
                        <td class="px-10 py-8">
                            <div class="flex items-center space-x-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name ?? 'Guest') }}&background=1e293b&color=3b82f6" class="w-10 h-10 rounded-xl border border-white/10" alt="">
                                <span class="text-sm font-black text-white">{{ $review->user->name ?? 'Guest' }}</span>
                            </div>
                        </td>
                        <td class="px-10 py-8">
                            <p class="text-sm font-black text-white">{{ Str::limit($review->reviewable->name ?? 'Unknown', 28) }}</p>
                            <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest">{{ class_basename($review->reviewable_type ?? '') }}</span>
                        </td>
                        <td class="px-10 py-8">
                            <div class="flex items-center space-x-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-amber-500' : 'text-slate-700' }} fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                                <span class="text-[10px] font-black text-slate-500 ml-2">{{ $review->rating }}/5</span>
                            </div>
                        </td>
                        <td class="px-10 py-8">
                            <p class="text-xs text-slate-400 max-w-xs leading-relaxed">{{ Str::limit($review->comment, 80) }}</p>
                        </td>
                        <td class="px-10 py-8">
                            <p class="text-xs text-slate-400">{{ $review->created_at->format('d M, Y') }}</p>
                            <p class="text-[9px] text-slate-600">{{ $review->created_at->diffForHumans() }}</p>
                        </td>
                        <td class="px-10 py-8 text-right">
                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="inline" onsubmit="return confirm('Delete this review?')">
                                @csrf @method('DELETE')
                                <button class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-rose-600/10 text-rose-500 hover:bg-rose-600 hover:text-white transition-all" title="Delete Review">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-12 py-24 text-center text-slate-500 font-bold italic">No reviews yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="pt-4">{{ $reviews->links() }}</div>
</div>
@endsection

