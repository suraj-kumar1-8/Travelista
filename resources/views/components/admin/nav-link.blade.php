@props(['active', 'href'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 bg-blue-600 text-white rounded-2xl shadow-lg shadow-blue-600/20 font-bold transition-all'
            : 'flex items-center px-4 py-3 text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-2xl transition-all font-bold';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
