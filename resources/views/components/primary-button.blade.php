<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-full font-bold text-sm text-white uppercase tracking-widest hover:shadow-lg hover:shadow-blue-500/30 active:scale-95 transition-all duration-150']) }}>
    {{ $slot }}
</button>
