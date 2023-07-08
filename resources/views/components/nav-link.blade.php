@props(['active'])

@php
    $classes = $active ?? false ? 'flex items-center p-2 text-blue-600 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700' : 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300 dark:hover:bg-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
