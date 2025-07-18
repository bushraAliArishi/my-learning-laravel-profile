{{-- resources/views/experience/edit.blade.php --}}
<x-layout :title="$title">
  <x-slot name="heading">{{ $heading }}</x-slot>

  <form
    x-data="experienceForm()"
    @click.away="dropdownTools = false"
    method="POST"
    action="{{ route('experience.update', $exp->id) }}"
    class="w-4/5 mx-auto py-24 space-y-12"
  >
    @csrf
    @method('PATCH')

    {{-- Experience Details --}}
    <div class="border-b border-gray-200 pb-12 space-y-6">
      <h2 class="text-xl font-semibold text-gray-900">Experience Details</h2>
      <p class="text-sm text-gray-600">This information will be public.</p>

      <div class="grid grid-cols-1 gap-6 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="slug" class="block text-sm font-medium text-gray-900">Slug</label>
          <input
            x-model="slug"
            type="text"
            name="slug"
            id="slug"
            required
            class="mt-2 block w-full rounded-md border-gray-300 px-3 py-2 focus:outline-indigo-600"
          />
        </div>
        <div class="sm:col-span-3">
          <label for="title" class="block text-sm font-medium text-gray-900">Title</label>
          <input
            x-model="title"
            type="text"
            name="title"
            id="title"
            required
            class="mt-2 block w-full rounded-md border-gray-300 px-3 py-2 focus:outline-indigo-600"
          />
        </div>
        <div class="sm:col-span-3">
          <label for="company" class="block text-sm font-medium text-gray-900">Company</label>
          <input
            x-model="company"
            type="text"
            name="company"
            id="company"
            required
            class="mt-2 block w-full rounded-md border-gray-300 px-3 py-2 focus:outline-indigo-600"
          />
        </div>
        <div class="sm:col-span-3">
          <label for="period" class="block text-sm font-medium text-gray-900">Period</label>
          <input
            x-model="period"
            type="text"
            name="period"
            id="period"
            placeholder="e.g. Jan 2024 – Jul 2025"
            required
            class="mt-2 block w-full rounded-md border-gray-300 px-3 py-2 focus:outline-indigo-600"
          />
        </div>
        <div class="sm:col-span-full">
          <label for="details" class="block text-sm font-medium text-gray-900">Details</label>
          <textarea
            x-model="details"
            name="details"
            id="details"
            rows="4"
            required
            class="mt-2 block w-full rounded-md border-gray-300 px-3 py-2 focus:outline-indigo-600"
          ></textarea>
        </div>
        <div class="sm:col-span-3">
          <label for="start_date" class="block text-sm font-medium text-gray-900">Start Date</label>
          <input
            x-model="start_date"
            type="date"
            name="start_date"
            id="start_date"
            class="mt-2 block w-full rounded-md border-gray-300 px-3 py-2 focus:outline-indigo-600"
          />
        </div>
        <div class="sm:col-span-3">
          <label for="end_date" class="block text-sm font-medium text-gray-900">End Date</label>
          <input
            x-model="end_date"
            type="date"
            name="end_date"
            id="end_date"
            class="mt-2 block w-full rounded-md border-gray-300 px-3 py-2 focus:outline-indigo-600"
          />
        </div>
      </div>
    </div>

    {{-- Tools Multiselect --}}
    <div class="border-b border-gray-200 pb-12 space-y-6">
      <h2 class="text-xl font-semibold text-gray-900">Tools</h2>
      <div class="flex justify-between items-center">
        <span class="text-sm font-medium text-gray-900">Select Tools</span>
        <button
          type="button"
          @click="showToolForm = !showToolForm"
          class="text-sm font-medium text-purple-600 hover:underline"
        >+ Add Tool</button>
      </div>

      <div class="relative">
        <div
          @click="dropdownTools = !dropdownTools"
          class="flex items-center justify-between rounded-md border border-gray-300 bg-white px-4 py-2 cursor-pointer"
        >
          <div class="flex flex-wrap gap-2">
            <template x-if="tools.length === 0">
              <span class="text-gray-400">None selected…</span>
            </template>
            <template x-for="id in tools" :key="id">
              <span class="flex items-center text-xs font-medium bg-purple-100 text-purple-800 px-2 py-1 rounded-full">
                <img
                  class="w-4 h-4 mr-1 object-contain"
                  :src="$store.tools.find(t => t.id === id).logo"
                  onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';"
                />
                <span x-text="$store.tools.find(t => t.id === id).name"></span>
                <button class="ml-1" @click.stop="toggle(tools, id)">×</button>
              </span>
            </template>
          </div>
          <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7"/>
          </svg>
        </div>

        <div
          x-show="dropdownTools"
          x-cloak x-transition
          class="absolute mt-1 w-full bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-auto z-50"
        >
          <template x-for="tool in $store.tools" :key="tool.id">
            <div
              @click.stop="toggle(tools, tool.id)"
              :class="tools.includes(tool.id) ? 'bg-purple-50' : ''"
              class="px-4 py-2 flex items-center hover:bg-gray-100 cursor-pointer"
            >
              <input type="checkbox" class="mr-2" :checked="tools.includes(tool.id)" />
              <img
                class="w-5 h-5 mr-2 object-contain"
                :src="tool.logo"
                onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';"
              />
              <span x-text="tool.name"></span>
            </div>
          </template>
        </div>

        <template x-for="id in tools" :key="id">
          <input type="hidden" name="tools[]" :value="id" />
        </template>
      </div>
    </div>

    {{-- Actions + Delete --}}
    <div class="flex items-center justify-between mt-8">
      {{-- Delete on the left --}}
      <form
        method="POST"
        action="{{ route('experience.destroy', $exp->id) }}"
        onsubmit="return confirm('Are you sure you want to delete this experience?');"
      >
        @csrf
        @method('DELETE')
        <x-button variant="secondary" type="submit">
          Delete
        </x-button>
      </form>

      {{-- Reset + Save on the right --}}
      <div class="flex gap-4">
        <x-button variant="warning" type="button" @click="resetForm()">
          Reset
        </x-button>
        <x-button variant="success" type="submit">
          Save
        </x-button>
      </div>
    </div>
  </form>

  <script>
    function experienceForm() {
      return {
        slug:       '{{ old('slug',    $exp->slug) }}',
        title:      '{{ old('title',   $exp->title) }}',
        company:    '{{ old('company', $exp->company) }}',
        period:     '{{ old('period',  $exp->period) }}',
        details:    `{{ old('details', $exp->details) }}`,
        start_date: '{{ old('start_date',$exp->start_date) }}',
        end_date:   '{{ old('end_date',  $exp->end_date) }}',
        tools:      {{ json_encode(old('tools', $exp->tools->pluck('id')->all())) }},
        dropdownTools: false,
        showToolForm:  false,
        resetForm() {
          this.slug       = '{{ $exp->slug }}';
          this.title      = '{{ $exp->title }}';
          this.company    = '{{ $exp->company }}';
          this.period     = '{{ $exp->period }}';
          this.details    = `{{ $exp->details }}`;
          this.start_date = '{{ $exp->start_date }}';
          this.end_date   = '{{ $exp->end_date }}';
          this.tools      = {{ json_encode($exp->tools->pluck('id')->all()) }};
        },
        toggle(arr,id) {
          id = +id;
          const i = arr.indexOf(id);
          if (i > -1) arr.splice(i,1);
          else        arr.push(id);
        }
      }
    }

    document.addEventListener('alpine:init', () => {
      Alpine.store('tools', @json($allTools));
    });
  </script>
</x-layout>
