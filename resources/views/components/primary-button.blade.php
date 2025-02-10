<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-yellow-500
    hover:bg-yellow-700 text-white text-md font-semibold rounded-full
    transition-all duration-300 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500
    focus:ring-offset-2']) }}>
    {{ $slot }}
</button>