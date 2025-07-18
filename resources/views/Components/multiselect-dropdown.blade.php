{{-- resources/views/components/multiselect-dropdown.blade.php --}}
@props([
  'store',           // Alpine store name: "tags" or "tools"
  'selected',        // Alpine data array property: "tags" or "tools"
  'name',            // form field name (will render inputs like <input name="tags[]" ...>)
  'label',           // dropdown label
  'fullWidth' => false, // if true, dropdown will span the full parent width
])

<div
  x-data
  class="relative {{ $fullWidth ? 'w-full' : 'w-48' }}"
  @click.away="$refs.menu.classList.add('hidden')"
>
  {{-- Label --}}
  <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>

  {{-- Trigger --}}
  <div
    @click="$refs.menu.classList.toggle('hidden')"
    class="mt-1 h-10 px-3 flex items-center justify-between border border-gray-300 bg-white rounded-md shadow-sm cursor-pointer"
  >
    <div class="flex flex-wrap gap-1 overflow-hidden">
      <template x-if="{{ $selected }}.length === 0">
        <span class="text-gray-400 truncate">None selected…</span>
      </template>
      <template x-for="id in {{ $selected }}" :key="id">
        <span class="flex items-center max-w-full text-xs font-medium bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full">
          <img
            x-show="$store.{{ $store }}[0]?.logo"
            class="w-4 h-4 mr-1 object-contain"
            :src="$store.{{ $store }}.find(i => i.id === id).logo"
            onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';"
          />
          <span class="truncate" x-text="$store.{{ $store }}.find(i => i.id === id).name"></span>
          <button
            class="ml-1 text-gray-500"
            @click.stop="{{ $selected }}.splice({{ $selected }}.indexOf(id),1)"
          >×</button>
        </span>
      </template>
    </div>
    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 9l-7 7-7-7" />
    </svg>
  </div>

  {{-- Dropdown menu --}}
  <div
    x-ref="menu"
    class="hidden absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md border border-gray-200 bg-white shadow-lg"
  >
    <template x-for="item in $store.{{ $store }}" :key="item.id">
      <div
        @click.stop="
          if (!{{ $selected }}.includes(item.id)) {{ $selected }}.push(item.id);
          else {{ $selected }}.splice({{ $selected }}.indexOf(item.id),1);
        "
        class="px-3 py-2 flex items-center hover:bg-gray-100 cursor-pointer"
        :class="{{ $selected }}.includes(item.id) ? 'bg-blue-50' : ''"
      >
        <input
          type="checkbox"
          class="mr-2"
          :checked="{{ $selected }}.includes(item.id)"
        />
        <img
          x-show="$store.{{ $store }}[0]?.logo"
          class="w-5 h-5 mr-2 object-contain"
          :src="item.logo"
          onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';"
        />
        <span x-text="item.name"></span>
      </div>
    </template>
  </div>

  {{-- Hidden inputs so the form will actually submit your selections --}}
  <template x-for="id in {{ $selected }}" :key="id">
    <input type="hidden" name="{{ $name }}[]" :value="id" />
  </template>
</div>
