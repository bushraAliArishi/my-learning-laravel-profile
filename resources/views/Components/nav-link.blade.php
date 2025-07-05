@props(['href'])
@props(['type'])

@php
    $current = trim(request()->path(), '/');
    $target = trim(parse_url($href, PHP_URL_PATH), '/');

    // $isActive = $current === $target;
    // $classes = $isActive
    //     ? 'border-b-4 border-gray-800 font-semibold'
    //     : 'border-b-4 border-transparent hover:border-gray-400';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => "hover:text-blue-400 pb-1 transition " ]) }}>
    {{ $slot }}
</a>
