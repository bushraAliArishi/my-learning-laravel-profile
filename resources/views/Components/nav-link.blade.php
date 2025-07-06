@props([
  'href'     => '#',
  'active'   => false,
  'type'     => 'a',
  'variant'  => 'default',
])

@if ($type === 'button' || $variant === 'dark')
<button
  type="button"
  {{ $attributes->merge(['class' =>
      'bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-2xl transition duration-200'
  ]) }}
>
  {{ $slot }}
</button>
@else
<a
  href="{{ $href }}"
  {{ $attributes->merge(['class' =>
      $active
        ? 'px-3 py-2 text-sm font-medium pb-1 border-b-4 border-gray-800 text-gray-900'
        : 'px-3 py-2 text-sm font-medium pb-1 border-b-4 border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300'
  ]) }}
>
  {{ $slot }}
</a>
@endif
