<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center px-4 py-2 mx-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
