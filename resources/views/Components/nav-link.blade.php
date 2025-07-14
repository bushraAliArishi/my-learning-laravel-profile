{{-- resources/views/components/nav-link.blade.php --}}
@props([
  'href'    => '#',
  'active'  => false,
  'type'    => 'a',
  'variant' => 'default',
])

@php
  // Full palette of button variants
  $btnClasses = [
    'default' => 'bg-gray-200 hover:bg-gray-300 text-gray-800',
    'primary' => 'bg-blue-600 hover:bg-blue-700 text-white',
    'secondary' => 'bg-indigo-500 hover:bg-indigo-600 text-white',
    'purple'  => 'bg-purple-600 hover:bg-purple-700 text-white',
    'red'     => 'bg-red-600 hover:bg-red-700 text-white',
    'green'   => 'bg-green-600 hover:bg-green-700 text-white',
    'yellow'  => 'bg-yellow-400 hover:bg-yellow-500 text-gray-900',
    'dark'    => 'bg-gray-800 hover:bg-gray-900 text-white',
    'light'   => 'bg-white hover:bg-gray-50 text-gray-800 border border-gray-300',
    'outline' => 'border border-blue-600 text-blue-600 hover:bg-blue-50',
  ];

  // Pick the button classes for this variant, or fallback to 'default'
  $chosenBtn = $btnClasses[$variant] ?? $btnClasses['default'];

  // Shared sizing & shape for buttons
  $commonBtn = 'font-medium py-3 px-6 rounded-2xl transition duration-200';

  // Link classes when rendering <a>
  $linkActive  = 'px-3 py-2 text-sm font-medium pb-1 border-b-4 border-gray-800 text-gray-900';
  $linkDefault = 'px-3 py-2 text-sm font-medium pb-1 border-b-4 border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300';
@endphp

@if($type === 'button')
  <button
    {{ $attributes->merge(['class' => "$chosenBtn $commonBtn"]) }}
  >
    {{ $slot }}
  </button>
@else
  <a
    href="{{ $href }}"
    {{ $attributes->merge([
      'class' => $active ? $linkActive : $linkDefault
    ]) }}
  >
    {{ $slot }}
  </a>
@endif
