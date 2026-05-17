@props(['href' => '#', 'as' => 'a'])

@php
$classes = 'inline-block px-8 py-4 bg-gradient-to-r from-emerald-500 to-green-500 text-white font-bold text-sm uppercase tracking-widest rounded-full shadow-lg hover:shadow-emerald-500/50 transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500';
@endphp

@if ($as === 'button')
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@else
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@endif
