<x-layout title="Create Project">
  <x-slot name="heading">Add New Project</x-slot>

  <form
    x-data="{
      title: '{{ old('title') }}',
      link: '{{ old('link') }}',
      description: '{{ old('description') }}',
      tags: {{ json_encode(old('tags', [])) }},
      tools: {{ json_encode(old('tools', [])) }},
      dropdownTags: false,
      dropdownTools: false,
      showTagForm: false,
      showToolForm: false,
      resetForm() {
        this.title = '';
        this.link = '';
        this.description = '';
        this.tags = [];
        this.tools = [];
      },
      toggle(arr,id) {
        id = +id;
        const i = arr.indexOf(id);
        if (i > -1) arr.splice(i,1);
        else        arr.push(id);
      }
    }"
    @click.away="dropdownTags = dropdownTools = false"
    method="POST"
    action="{{ route('projects.store') }}"
    enctype="multipart/form-data"
    class="w-4/5 mx-auto mt-24 mb-16 space-y-12"
  >
    @csrf

    <div class="border-b border-gray-900/10 pb-12 space-y-6">
      <h2 class="text-base/7 font-semibold text-gray-900">Project Details</h2>
      <p class="text-sm/6 text-gray-600">This information will be public.</p>

      <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
          <div class="mt-2">
            <input
              x-model="title"
              type="text" name="title" id="title" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                     outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"
            >
          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="link" class="block text-sm/6 font-medium text-gray-900">Link</label>
          <div class="mt-2">
            <input
              x-model="link"
              type="url" name="link" id="link" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                     outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"
            >
          </div>
        </div>

        <div class="sm:col-span-full">
          <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
          <div class="mt-2">
            <textarea
              x-model="description"
              name="description" id="description" rows="3" required
              class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                     outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"
            ></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="border-b border-gray-900/10 pb-12 space-y-12 mt-40">
      <h2 class="text-base/7 font-semibold text-gray-900 mb-4">Tags & Tools</h2>

      <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <div class="space-y-4">
          <div class="flex justify-between items-center">
            <label class="block text-sm/6 font-medium text-gray-900">Select Tags</label>
            <button type="button" @click="showTagForm = !showTagForm" class="text-sm/6 font-medium text-blue-600 hover:underline">+ Add Tag</button>
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
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
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
          <template x-for="id in tags" :key="id"><input type="hidden" name="tags[]" :value="id"></template>

          <div x-show="showTagForm" x-transition class="p-6 bg-blue-50 rounded-md shadow-inner mt-4">
            <h3 class="text-sm/6 font-semibold text-gray-900 mb-4">New Tag</h3>
            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-3">
              <div>
                <label class="block text-sm/6 font-medium text-gray-900">Name</label>
                <input name="new_tag_name" type="text" class="mt-1 block w-full rounded-md border-gray-300 px-3 py-1.5">
              </div>
              <div>
                <label class="block text-sm/6 font-medium text-gray-900">Color</label>
                <input name="new_tag_color" type="color" value="#000000" class="mt-1 block w-full h-10 p-0 border-none">
              </div>
              <div class="flex items-end">
                <button type="submit" formaction="{{ route('tags.store') }}" formmethod="POST" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save Tag</button>
              </div>
            </div>
          </div>
        </div>

        <div class="space-y-4">
          <div class="flex justify-between items-center">
            <label class="block text-sm/6 font-medium text-gray-900">Select Tools</label>
            <button type="button" @click="showToolForm = !showToolForm" class="text-sm/6 font-medium text-purple-600 hover:underline">+ Add Tool</button>
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
                  <img class="w-4 h-4 mr-1 object-contain" :src="$store.tools.find(t => t.id === id).logo" />
                  <span x-text="$store.tools.find(t => t.id === id).name"></span>
                  <button class="ml-1" @click.stop="toggle(tools, id)">×</button>
                </span>
              </template>
            </div>
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
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
          <template x-for="id in tools" :key="id"><input type="hidden" name="tools[]" :value="id"></template>

          <div x-show="showToolForm" x-transition class="p-6 bg-purple-50 rounded-md shadow-inner mt-4">
            <h3 class="text-sm/6 font-semibold text-gray-900 mb-4">New Tool</h3>
            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-4">
              <div class="sm:col-span-2">
                <label class="block text-sm/6 font-medium text-gray-900">Name</label>
                <input name="new_tool_name" type="text" class="mt-1 block w-full rounded-md border-gray-300 px-3 py-1.5">
              </div>
              <div class="sm:col-span-2">
                <label class="block text-sm/6 font-medium text-gray-900">Logo</label>
                <input name="new_tool_logo" type="file" accept="image/*" class="mt-1 block w-full text-sm border border-gray-300 rounded-md p-1.5 bg-white">
              </div>
              <div class="sm:col-span-4 flex justify-end">
                <button type="submit" formaction="{{ route('tools.store') }}" formmethod="POST" class="px-4 py-2 bg-purple-600 text-white rounded-md">Save Tool</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-center gap-x-6 mt-24 mb-24">
      <button type="button" @click="resetForm()" class="px-6 py-3 rounded-md bg-red-600 text-white text-base font-semibold">Reset</button>
      <button type="submit" class="px-6 py-3 rounded-md bg-indigo-600 text-white text-base font-semibold">Save</button>
    </div>
  </form>
<div class="min-h-300">
    
</div>
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('tags', @json($allTags));
      Alpine.store('tools', @json($allTools));
    });
  </script>
</x-layout>
