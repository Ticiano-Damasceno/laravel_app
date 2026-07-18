<a {{ $attributes->merge([
    'class' => '
        inline-block px-4 py-2 
        bg-indigo-600 text-black text-sm 
        font-medium rounded 
        hover:bg-indigo-700
        border border-gray-300  hover:bg-gray-50 
        focus:outline-none focus:ring-2 
        focus:ring-indigo-500 focus:ring-offset-2 
        disabled:opacity-25 transition 
        ease-in-out duration-150
    ']) }}>
    {{ $slot }}
</a>