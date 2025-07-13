{{-- resources/views/projects.blade.php --}}
<x-layout title="Projects">
  <x-slot name="heading">My Projects</x-slot>

  <div
    x-data="{
      search: '{{ request('search','') }}',
      tags: {{ json_encode(array_map('intval', request('tags', []))) }},
      tools: {{ json_encode(array_map('intval', request('tools', []))) }},
      allTags: {{ $allTags->toJson() }},
      allTools: {{ $allTools->toJson() }},
      dropdownTags: false,
      dropdownTools: false,

      filter() {
        const p = new URLSearchParams();
        if (this.search)        p.set('search', this.search);
        this.tags.forEach(i => p.append('tags[]', i));
        this.tools.forEach(i => p.append('tools[]', i));
        window.location.search = p;
      },
      reset() {
        this.search = '';
        this.tags = [];
        this.tools = [];
        this.filter();
      },
      toggle(arr,id) {
        id = +id;
        const idx = arr.indexOf(id);
        if (idx > -1) arr.splice(idx,1);
        else          arr.push(id);
      }
    }"
    class="mt-24"
  >

    {{-- Filters & Search --}}
    <section class="py-6 mb-8 bg-transparent">
      <div class="container mx-auto px-6">
        <div class="grid gap-4 md:grid-cols-3 lg:grid-cols-6 items-end">

          {{-- Search --}}
          <div class="col-span-3">
            <label class="block text-sm font-medium text-gray-700">Search</label>
            <input
              type="text"
              x-model.debounce.300ms="search"
              @keydown.enter="filter()"
              placeholder="Project title or description…"
              class="mt-1 block w-full max-w-[250px] min-w-[150px]
                     border border-gray-300 rounded-md shadow-sm
                     focus:ring-blue-500 focus:border-blue-500
                     px-3 py-1.5 h-10"
            />
          </div>

          {{-- Tags --}}
          <div class="relative col-span-1 w-full" @click.away="dropdownTags=false">
            <label class="block text-sm font-medium text-gray-700">Tags</label>
            <div
              @click="dropdownTags = !dropdownTags"
              class="mt-1 flex items-center justify-between w-full
                     border border-gray-300 rounded-md shadow-sm
                     px-3 py-1.5 h-10 cursor-pointer"
            >
              <div class="flex flex-wrap gap-2">
                <template x-if="tags.length === 0">
                  <span class="text-gray-400">Select tags…</span>
                </template>
                <template x-for="id in tags" :key="id">
                  <span class="flex items-center text-xs font-medium
                               bg-blue-100 text-blue-800 px-2.5 py-1 rounded-full">
                    <span x-text="allTags.find(t => t.id === id)?.name"></span>
                    <button class="ml-1" @click.stop="toggle(tags,id);filter()">×</button>
                  </span>
                </template>
              </div>
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 9l-7 7-7-7" />
              </svg>
            </div>
            <div
              x-show="dropdownTags" x-transition x-cloak
              class="absolute mt-1 w-full bg-white border border-gray-200
                     rounded-md shadow-lg max-h-60 overflow-auto z-50"
            >
              <template x-for="tag in allTags" :key="tag.id">
                <div
                  class="px-3 py-1.5 flex items-center hover:bg-gray-100 cursor-pointer"
                  :class="tags.includes(tag.id) ? 'bg-blue-50' : ''"
                  @click.stop="toggle(tags,tag.id);filter()"
                >
                  <input type="checkbox" class="mr-2" :checked="tags.includes(tag.id)" />
                  <span x-text="tag.name"></span>
                </div>
              </template>
            </div>
          </div>

          {{-- Tools --}}
          <div class="relative col-span-1 w-full" @click.away="dropdownTools=false">
            <label class="block text-sm font-medium text-gray-700">Tools</label>
            <div
              @click="dropdownTools = !dropdownTools"
              class="mt-1 flex items-center justify-between w-full
                     border border-gray-300 rounded-md shadow-sm
                     px-3 py-1.5 h-10 cursor-pointer"
            >
              <div class="flex flex-wrap gap-2">
                <template x-if="tools.length === 0">
                  <span class="text-gray-400">Select tools…</span>
                </template>
                <template x-for="id in tools" :key="id">
                  <span class="flex items-center text-xs font-medium
                               bg-purple-100 text-purple-800 px-2.5 py-1 rounded-full">
                    <span x-text="allTools.find(t => t.id === id)?.name"></span>
                    <button class="ml-1" @click.stop="toggle(tools,id);filter()">×</button>
                  </span>
                </template>
              </div>
              <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 9l-7 7-7-7" />
              </svg>
            </div>
            <div
              x-show="dropdownTools" x-transition x-cloak
              class="absolute mt-1 w-full bg-white border border-gray-200
                     rounded-md shadow-lg max-h-60 overflow-auto z-50"
            >
              <template x-for="tool in allTools" :key="tool.id">
                <div
                  class="px-3 py-1.5 flex items-center hover:bg-gray-100 cursor-pointer"
                  :class="tools.includes(tool.id) ? 'bg-purple-50' : ''"
                  @click.stop="toggle(tools,tool.id);filter()"
                >
                  <input type="checkbox" class="mr-2" :checked="tools.includes(tool.id)" />
                  <span x-text="tool.name"></span>
                </div>
              </template>
            </div>
          </div>

          {{-- Reset --}}
          <div class="col-span-6 md:col-span-1 lg:col-span-1 flex justify-end">
            <button
              @click="reset()"
              class="inline-flex items-center px-4 py-2
                     bg-blue-500 hover:bg-blue-600 text-white
                     rounded-md"
            >
              Reset
            </button>
          </div>
        </div>
      </div>
    </section>

    {{-- Project Cards --}}
    <section class="pb-16">
      <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid gap-24 md:grid-cols-2 lg:grid-cols-3 items-stretch">
          @foreach($projects as $project)
            <div class="relative group h-full">
              {{-- circular banner --}}
              <div
                class="absolute -top-5 left-1/2 transform -translate-x-1/2
                       w-28 h-28 rounded-full border-2 border-gray-200
                       bg-gray-200 flex items-center justify-center
                       shadow-inner transition-transform duration-300
                       group-hover:scale-110"
              >
                <img
                  src="{{ $project->media->isNotEmpty()
                            ? asset($project->media->first()->media_url)
                            : '' }}"
                  alt="{{ $project->title }}"
                  class="w-16 h-16 object-contain"
                  onerror="this.onerror=null;this.src='{{ asset('images/icon/NoImages.png') }}';"
                >
              </div>

              {{-- card body --}}
              <div
                class="mt-12 pt-12 bg-white rounded-2xl
                       flex flex-col justify-between items-center text-center
                       overflow-hidden shadow transition-transform duration-300
                       group-hover:scale-105 group-hover:shadow-lg h-full"
              >
                <div>
                  <h3 class="mt-6 mx-5 text-xl font-semibold text-blue-600">
                    {{ $project->title }}
                  </h3>
                  <p class="mt-2 px-4 text-gray-700">
                    {{ Str::limit($project->description, 100) }}
                  </p>
                </div>
                <div>
                  <div class="flex flex-wrap gap-4 mt-4 mb-4 mx-5 justify-center">
                    @foreach($project->tools as $tool)
                      <img
                        src="{{ asset($tool->logo) }}"
                        alt="{{ $tool->name }}"
                        class="w-16 h-16 object-contain"
                        onerror="this.onerror=null;this.src='{{ asset('images/icon/NoImages.png') }}';"
                      >
                    @endforeach
                  </div>
                  <div class="flex flex-wrap gap-2 mb-6 mx-10 justify-center">
                    @foreach($project->tags as $tag)
                      <span
                        class="text-xs font-medium px-2 py-1 rounded"
                        style="background-color: {{ $tag->color_hex }}33;
                               color: {{ $tag->color_hex }};"
                      >
                        {{ $tag->name }}
                      </span>
                    @endforeach
                  </div>
                </div>
                <a href="{{ $project->link }}" target="_blank"
                   class="text-white font-semibold w-full bg-gradient-to-br from-blue-500 to-purple-600 py-3 text-center">
                  View Project →
                </a>
              </div>
            </div>
          @endforeach
        </div>

        {{-- pagination --}}
        <div class="mt-24">{{ $projects->links() }}</div>
      </div>
    </section>

  </div>
</x-layout>
