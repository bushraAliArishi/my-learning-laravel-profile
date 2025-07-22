@props([
  'type'        => 'text',
  'required'    => false,
  'xModel'      => null,
  'placeholder' => '',
])

@php
  $base = 'mt-2 block w-full rounded-lg border border-gray-300 dark:border-gray-700 '.
          'px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 '.
          'focus:outline-none focus:ring-2 focus:ring-blue-500';
@endphp

@if($type === 'textarea')
  <textarea
    {{ $attributes->merge(['class' => $base]) }}
    @if($xModel) x-model="{{ $xModel }}" @endif
    placeholder="{{ $placeholder }}"
    @if($required) required @endif
  >{{ $slot }}</textarea>
@else
  <input
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $base]) }}
    @if($xModel) x-model="{{ $xModel }}" @endif
    placeholder="{{ $placeholder }}"
    @if($required) required @endif
  />
@endif
