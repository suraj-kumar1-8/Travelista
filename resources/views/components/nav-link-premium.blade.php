@props(['active', 'href'])

@php
$classes = ($active ?? false)
            ? 'relative text-xs font-black uppercase tracking-[0.2em] text-blue-500 transition-all duration-300 group'
            : 'relative text-xs font-black uppercase tracking-[0.2em] text-slate-400 hover:text-white transition-all duration-300 group';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
    <span class="absolute -bottom-2 left-0 w-0 h-px bg-blue-600 transition-all duration-500 group-hover:w-full {{ ($active ?? false) ? 'w-full' : '' }}"></span>
</a>
