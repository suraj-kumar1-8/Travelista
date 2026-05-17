@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full bg-slate-900/50 border border-white/10 rounded-[2rem] px-6 py-4 text-white focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all outline-none font-bold placeholder-slate-500']) !!}>
