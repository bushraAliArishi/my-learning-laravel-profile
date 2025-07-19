{{-- resources/views/components/button.blade.php --}}
@props([
  'variant' => 'primary',
  'shape'   => 'default',
  'size'    => 'base',
  'type'    => 'button',
  'class'   => '',
])

@php
  // Base & text size
  $base        = 'inline-flex items-center justify-center font-semibold transition focus:outline-none focus:ring-2 focus:ring-offset-2';
  $textSizes   = ['sm'=>'text-sm','base'=>'text-base','lg'=>'text-lg'];
  $textSize    = $textSizes[$size] ?? $textSizes['base'];

  // Variant colors
  $variants = [
    'primary'   => 'bg-blue-600 hover:bg-blue-700 text-white focus:ring-blue-500',
    'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-800 focus:ring-gray-400',
    'danger'    => 'bg-red-600 hover:bg-red-700 text-white focus:ring-red-500',
    'warning'   => 'bg-yellow-500 hover:bg-yellow-600 text-white focus:ring-yellow-400',
    'success'   => 'bg-green-600 hover:bg-green-700 text-white focus:ring-green-500',
    'gradient'  => 'bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white focus:ring-indigo-500',
  ];

  // Shape / padding
  $shapes = match($shape) {
    'pill'        => 'rounded-full px-6 py-2',
    'circle'      => 'rounded-full p-2',
    'square-icon' => 'rounded bg-gray-100 p-2',
    default       => 'rounded-md px-4 py-2',
  };

  // Disabled state
  $isDisabled = $attributes->has('disabled');
  if ($isDisabled) {
    $variantClasses = 'bg-gray-300 text-gray-500 cursor-not-allowed';
    $hoverRing      = '';
  } else {
    $variantClasses = $variants[$variant] ?? $variants['primary'];
    $hoverRing      = '';
  }

  $classes = trim("{$base} {$textSize} {$variantClasses} {$hoverRing} {$shapes} {$class}");
@endphp

<button
  type="{{ $type }}"
  {{ $attributes->merge(['class' => $classes]) }}
  @if($isDisabled) disabled @endif
>
  {{ $slot }}
</button>
