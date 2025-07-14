<x-layout :title="$title">
  <x-slot name="heading">{{ $heading }}</x-slot>

  <form
    x-data="{
      slug:       '{{ old('slug') }}',
      title:      '{{ old('title') }}',
      company:    '{{ old('company') }}',
      period:     '{{ old('period') }}',
      details:    '{{ old('details') }}',
      start_date: '{{ old('start_date') }}',
      end_date:   '{{ old('end_date') }}',
      tools:      {{ json_encode(old('tools', [])) }},
      dropdownTools: false,
      showToolForm: false,
      resetForm() {
        this.slug = '';
        this.title = '';
        this.company = '';
        this.period = '';
        this.details = '';
        this.start_date = '';
        this.end_date = '';
        this.tools = [];
      },
      toggle(arr,id) {
        id = +id;
        const i = arr.indexOf(id);
        if (i > -1) arr.splice(i,1);
        else        arr.push(id);
      }
    }"
    @click.away="dropdownTools = false"
    method="POST"
    action="{{ route('experience.store') }}"
    class="w-4/5 mx-auto mt-24 mb-16 space-y-12"
  >
    @csrf

    {{-- Experience Details --}}
    <div class="border-b border-gray-900/10 pb-12 space-y-6">
      <h2 class="text-base/7 font-semibold text-gray-900">Experience Details</h2>
      <p class="text-sm/6 text-gray-600">This information will be public.</p>

      <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="slug" class="block text-sm/6 font-medium text-gray-900">Slug</label>
          <input x-model="slug" type="text" name="slug" id="slug" required
                 class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                        outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"/>
        </div>
        <div class="sm:col-span-3">
          <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
          <input x-model="title" type="text" name="title" id="title" required
                 class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                        outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"/>
        </div>
        <div class="sm:col-span-3">
          <label for="company" class="block text-sm/6 font-medium text-gray-900">Company</label>
          <input x-model="company" type="text" name="company" id="company" required
                 class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                        outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"/>
        </div>
        <div class="sm:col-span-3">
          <label for="period" class="block text-sm/6 font-medium text-gray-900">Period</label>
          <input x-model="period" type="text" name="period" id="period"
                 placeholder="e.g. Jan 2024 – Jul 2025" required
                 class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                        outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"/>
        </div>
        <div class="sm:col-span-full">
          <label for="details" class="block text-sm/6 font-medium text-gray-900">Details</label>
          <textarea x-model="details" name="details" id="details" rows="4" required
                    class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                           outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
        </div>
        <div class="sm:col-span-3">
          <label for="start_date" class="block text-sm/6 font-medium text-gray-900">Start Date</label>
          <input x-model="start_date" type="date" name="start_date" id="start_date"
                 class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                        outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"/>
        </div>
        <div class="sm:col-span-3">
          <label for="end_date" class="block text-sm/6 font-medium text-gray-900">End Date</label>
          <input x-model="end_date" type="date" name="end_date" id="end_date"
                 class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                        outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"/>
        </div>
      </div>
    </div>

    {{-- Tools Multiselect --}}
    <div class="border-b border-gray-900/10 pb-12 space-y-6">
      <h2 class="text-base/7 font-semibold text-gray-900">Tools</h2>
      <div class="flex justify-between items-center mb-4">
        <span class="text-sm/6 font-medium text-gray-900">Select Tools</span>
        <button type="button" @click="showToolForm = !showToolForm"
                class="text-sm/6 font-medium text-purple-600 hover:underline">+ Add Tool</button>
      </div>

      <div class="relative">
        <div @click="dropdownTools = !dropdownTools"
             class="flex items-center justify-between rounded-md border border-gray-300 bg-white px-4 py-2 cursor-pointer">
          <div class="flex flex-wrap gap-2">
            <template x-if="tools.length === 0">
              <span class="text-gray-400">None selected…</span>
            </template>
            <template x-for="id in tools" :key="id">
              <span class="flex items-center text-xs font-medium bg-purple-100 text-purple-800 px-2 py-1 rounded-full">
                <img class="w-4 h-4 mr-1 object-contain"
                     :src="$store.tools.find(t => t.id === id).logo"
                     onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';"/>
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

        <div x-show="dropdownTools" x-cloak x-transition
             class="absolute mt-1 w-full bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-auto z-50">
          <template x-for="tool in $store.tools" :key="tool.id">
            <div class="px-4 py-2 flex items-center hover:bg-gray-100 cursor-pointer"
                 :class="tools.includes(tool.id) ? 'bg-purple-50' : ''"
                 @click.stop="toggle(tools, tool.id)">
              <input type="checkbox" class="mr-2" :checked="tools.includes(tool.id)"/>
              <img class="w-5 h-5 mr-2 object-contain"
                   :src="tool.logo"
                   onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';"/>
              <span x-text="tool.name"></span>
            </div>
          </template>
        </div>

        <template x-for="id in tools" :key="id">
          <input type="hidden" name="tools[]" :value="id">
        </template>
      </div>

      {{-- Inline New Tool Form --}}
      <div x-show="showToolForm" x-transition class="p-6 bg-purple-50 rounded-md shadow-inner mt-4">
        <h3 class="text-sm/6 font-semibold text-gray-900 mb-4">New Tool</h3>
        <form action="{{ route('tools.store') }}" method="POST" enctype="multipart/form-data"
              class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-4">
          @csrf
          <div class="sm:col-span-2">
            <label class="block text-sm/6 font-medium text-gray-900 mb-1">Name</label>
            <input name="name" type="text" required class="mt-1 block w-full rounded-md border-gray-300 px-3 py-1.5"/>
          </div>
          <div class="sm:col-span-2">
            <label class="block text-sm/6 font-medium text-gray-900 mb-1">Logo</label>
            <input name="logo" type="file" accept="image/*"
                   class="mt-1 block w-full text-sm border border-gray-300 rounded-md p-1.5 bg-white"/>
          </div>
          <div class="sm:col-span-4 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md">Save Tool</button>
          </div>
        </form>
      </div>
    </div>

    {{-- Actions --}}
    <div class="flex justify-center gap-x-6 mt-24 mb-24">
      <button type="button" @click="resetForm()"
              class="px-6 py-3 rounded-md bg-red-600 text-white font-semibold">Reset</button>
      <button type="submit"
              class="px-6 py-3 rounded-md bg-indigo-600 text-white font-semibold">Save</button>
    </div>
  </form>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('tools', @json($allTools));
    });
  </script>
</x-layout>
