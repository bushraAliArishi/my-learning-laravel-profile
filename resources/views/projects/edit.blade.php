{{-- resources/views/projects/edit.blade.php --}}
<x-layout :title="$title">
  <x-slot name="heading">{{ $heading }}</x-slot>

  <form
    x-data="{
      title:       '{{ old('title', $project->title) }}',
      link:        '{{ old('link', $project->link) }}',
      description: `{{ old('description', $project->description) }}`,
      type:        '{{ old('type', $project->type) }}',
      new_type:    '{{ old('new_type') }}',
      tags:        {{ json_encode(old('tags', $project->tags->pluck('id')->all())) }},
      tools:       {{ json_encode(old('tools', $project->tools->pluck('id')->all())) }},
      dropdownTags:  false,
      dropdownTools: false,
      showTagForm:   false,
      showToolForm:  false,

      resetForm() {
        this.title       = '{{ $project->title }}';
        this.link        = '{{ $project->link }}';
        this.description = `{{ $project->description }}`;
        this.type        = '{{ $project->type }}';
        this.new_type    = '';
        this.tags        = {{ json_encode($project->tags->pluck('id')->all()) }};
        this.tools       = {{ json_encode($project->tools->pluck('id')->all()) }};
      },

      toggle(arr, id) {
        id = +id;
        const i = arr.indexOf(id);
        if (i > -1) arr.splice(i,1);
        else        arr.push(id);
      }
    }"
    @click.away="dropdownTags = dropdownTools = false"
    method="POST"
    action="{{ route('projects.update', $project->id) }}"
    enctype="multipart/form-data"
    class="w-4/5 mx-auto mt-24 mb-16 space-y-12"
  >
    @csrf
    @method('PATCH')

    {{-- PROJECT DETAILS --}}
    <div class="border-b border-gray-900/10 pb-12 space-y-6">
      <h2 class="text-base/7 font-semibold text-gray-900">Project Details</h2>
      <p class="text-sm/6 text-gray-600">This information will be public.</p>

      <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        {{-- Title --}}
        <div class="sm:col-span-3">
          <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
          <input
            x-model="title"
            type="text" name="title" id="title" required
            class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                   outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"
          >
        </div>

        {{-- Link --}}
        <div class="sm:col-span-3">
          <label for="link" class="block text-sm/6 font-medium text-gray-900">Link</label>
          <input
            x-model="link"
            type="url" name="link" id="link"
            class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                   outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"
          >
        </div>

        {{-- Description --}}
        <div class="sm:col-span-full">
          <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
          <textarea
            x-model="description"
            name="description" id="description" rows="3" required
            class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                   outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"
          ></textarea>
        </div>

        {{-- Type / Other --}}
        <div class="sm:col-span-3">
          <label for="type" class="block text-sm/6 font-medium text-gray-900">Type</label>
          <select
            x-model="type"
            name="type" id="type"
            class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                   outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"
          >
            <option value="">— select —</option>
            @foreach($allTypes as $t)
              <option value="{{ $t }}">{{ $t }}</option>
            @endforeach
            <option value="other">Other…</option>
          </select>
        </div>
        <div class="sm:col-span-3" x-show="type === 'other'">
          <label for="new_type" class="block text-sm/6 font-medium text-gray-900">New Type</label>
          <input
            x-model="new_type"
            type="text" name="new_type" id="new_type"
            class="mt-2 block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                   outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"
          >
        </div>
      </div>
    </div>

    {{-- TAGS & TOOLS --}}
    <div class="border-b border-gray-900/10 pb-12 space-y-12">
      <h2 class="text-base/7 font-semibold text-gray-900">Tags & Tools</h2>

      <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        {{-- Tags --}}
        <div class="space-y-4">
          <div class="flex justify-between items-center">
            <label class="block text-sm/6 font-medium text-gray-900">Select Tags</label>
            <button
              type="button"
              @click="showTagForm = !showTagForm"
              class="text-sm/6 font-medium text-blue-600 hover:underline"
            >+ Add Tag</button>
          </div>

          <div
            @click="dropdownTags = !dropdownTags"
            class="flex items-center justify-between rounded-md border border-gray-300 bg-white px-4 py-2 cursor-pointer"
          >
            <div class="flex flex-wrap gap-2">
              <template x-if="tags.length === 0">
                <span class="text-gray-400">None selected…</span>
              </template>
              <template x-for="id in tags" :key="id">
                <span class="flex items-center text-xs font-medium bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                  <span x-text="$store.tags.find(t => t.id === id).name"></span>
                  <button class="ml-1" @click.stop="toggle(tags, id)">×</button>
                </span>
              </template>
            </div>
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7"/>
            </svg>
          </div>

          <div
            x-show="dropdownTags"
            x-cloak
            x-transition
            class="bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-auto z-50"
          >
            <template x-for="tag in $store.tags" :key="tag.id">
              <div
                class="px-4 py-2 flex items-center hover:bg-gray-100 cursor-pointer"
                :class="tags.includes(tag.id) ? 'bg-blue-50' : ''"
                @click.stop="toggle(tags, tag.id)"
              >
                <input type="checkbox" class="mr-2" :checked="tags.includes(tag.id)" />
                <span x-text="tag.name"></span>
              </div>
            </template>
          </div>
          <template x-for="id in tags" :key="id">
            <input type="hidden" name="tags[]" :value="id">
          </template>

          {{-- Inline New Tag Form --}}
          <div x-show="showTagForm" x-transition class="p-6 bg-blue-50 rounded-md shadow-inner mt-4">
            <h3 class="text-sm/6 font-semibold text-gray-900 mb-4">New Tag</h3>
            <form action="{{ route('tags.store') }}" method="POST" class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-3">
              @csrf
              <div>
                <label class="block text-sm/6 font-medium text-gray-900">Name</label>
                <input name="name" type="text" required class="mt-1 block w-full rounded-md border-gray-300 px-3 py-1.5"/>
              </div>
              <div>
                <label class="block text-sm/6 font-medium text-gray-900">Color</label>
                <input name="color" type="color" value="#000000" class="mt-1 block w-full h-10 p-0 border-none"/>
              </div>
              <div class="flex items-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save Tag</button>
              </div>
            </form>
          </div>
        </div>

        {{-- Tools --}}
        <div class="space-y-4">
          <div class="flex justify-between items-center">
            <label class="block text-sm/6 font-medium text-gray-900">Select Tools</label>
            <button
              type="button"
              @click="showToolForm = !showToolForm"
              class="text-sm/6 font-medium text-purple-600 hover:underline"
            >+ Add Tool</button>
          </div>

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

          <div
            x-show="dropdownTools"
            x-cloak
            x-transition
            class="bg-white border border-gray-200 rounded-md shadow-lg max-h-60 overflow-auto z-50"
          >
            <template x-for="tool in $store.tools" :key="tool.id">
              <div
                class="px-4 py-2 flex items-center hover:bg-gray-100 cursor-pointer"
                :class="tools.includes(tool.id) ? 'bg-purple-50' : ''"
                @click.stop="toggle(tools, tool.id)"
              >
                <input type="checkbox" class="mr-2" :checked="tools.includes(tool.id)" />
                <img class="w-5 h-5 mr-2 object-contain" :src="tool.logo" />
                <span x-text="tool.name"></span>
              </div>
            </template>
          </div>
          <template x-for="id in tools" :key="id">
            <input type="hidden" name="tools[]" :value="id">
          </template>

          {{-- Inline New Tool Form --}}
          <div x-show="showToolForm" x-transition class="p-6 bg-purple-50 rounded-md shadow-inner mt-4">
            <h3 class="text-sm/6 font-semibold text-gray-900 mb-4">New Tool</h3>
            <form action="{{ route('tools.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-4">
              @csrf
              <div class="sm:col-span-2">
                <label class="block text-sm/6 font-medium text-gray-900 mb-1">Name</label>
                <input name="name" type="text" required class="mt-1 block w-full rounded-md border-gray-300 px-3 py-1.5"/>
              </div>
              <div class="sm:col-span-2">
                <label class="block text-sm/6 font-medium text-gray-900 mb-1">Logo</label>
                <input name="logo" type="file" accept="image/*" class="mt-1 block w-full text-sm border border-gray-300 rounded-md p-1.5 bg-white"/>
              </div>
              <div class="sm:col-span-4 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md">Save Tool</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- ACTIONS --}}
    <div class="flex justify-center gap-x-6 mt-24 mb-24">
      <button
        type="button"
        @click="resetForm()"
        class="px-6 py-3 rounded-md bg-red-600 text-white font-semibold"
      >Reset</button>
      <button
        type="submit"
        class="px-6 py-3 rounded-md bg-indigo-600 text-white font-semibold"
      >Save</button>
    </div>
  </form>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('tags', @json($allTags));
      Alpine.store('tools', @json($allTools));
    });
  </script>
</x-layout>
