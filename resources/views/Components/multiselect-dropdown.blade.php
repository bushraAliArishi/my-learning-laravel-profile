@props([
  'store',           // Alpine store name: "tags" or "tools"
  'selected',        // Alpine data array property
  'name',            // form field name (e.g. "tags")
  'label'   => '',   // label text
  'fullWidth'=> false,
])

<div x-data
     @click.away="$refs.menu.classList.add('hidden')"
     class="relative overflow-visible {{ $fullWidth ? 'w-full' : 'w-48' }}">
  {{-- Label --}}
  @if($label)
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
      {{ $label }}
    </label>
  @endif

  {{-- Trigger --}}
  <div @click="$refs.menu.classList.toggle('hidden')"
       class="mt-1 w-full flex flex-wrap items-start justify-between
              px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm cursor-pointer
              dark:bg-gray-900 dark:border-gray-700">
    <div class="flex flex-wrap gap-1">
      <template x-if="{{ $selected }}.length === 0">
        <span class="text-gray-400 truncate">None selected…</span>
      </template>
      <template x-for="id in {{ $selected }}" :key="id">
        <span class="flex items-center text-xs font-medium
                     bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                     px-2 py-0.5 rounded-full">
          <img x-show="'{{ $store }}' === 'tools'"
               class="w-4 h-4 mr-1 object-contain"
               :src="`${@js(asset(''))}${$store.{{ $store }}.find(i=>i.id===id).logo}`"
               onerror="this.src='/images/icon/NoImages.png'" />
          <span class="truncate"
                x-text="$store.{{ $store }}.find(i=>i.id===id).name"></span>
          <button @click.stop="{{ $selected }}.splice({{ $selected }}.indexOf(id),1)"
                  class="ml-1 text-gray-500">×</button>
        </span>
      </template>
    </div>
    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 9l-7 7-7-7" />
    </svg>
  </div>

  {{-- Dropdown Menu --}}
  <div x-ref="menu"
       class="hidden absolute z-50 mt-1 min-w-full w-auto max-h-60 overflow-auto
              rounded-md border border-gray-200 bg-white shadow-lg
              dark:border-gray-700 dark:bg-gray-800">
    <template x-for="item in $store.{{ $store }}" :key="item.id">
      <div @click.stop="
            if (!{{ $selected }}.includes(item.id)) {{ $selected }}.push(item.id);
            else {{ $selected }}.splice({{ $selected }}.indexOf(item.id),1);
          "
           class="px-3 py-2 flex items-center hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
           :class="{{ $selected }}.includes(item.id) ? 'bg-blue-50 dark:bg-blue-900' : ''">
        <input type="checkbox" class="mr-2" :checked="{{ $selected }}.includes(item.id)" />
        <img x-show="'{{ $store }}' === 'tools'"
             class="w-5 h-5 mr-2 object-contain"
             :src="`${@js(asset(''))}${item.logo}`"
             onerror="this.src='/images/icon/NoImages.png'" />
        <span class="truncate" x-text="item.name"></span>
      </div>
    </template>
  </div>

  {{-- Hidden Inputs --}}
  <template x-for="id in {{ $selected }}" :key="id">
    <input type="hidden" name="{{ $name }}[]" :value="id" />
  </template>
</div>
