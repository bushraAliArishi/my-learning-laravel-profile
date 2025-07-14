{{-- resources/views/projects/index.blade.php --}}
<x-layout title="Projects">
  <x-slot name="heading">My Projects</x-slot>

  <div
    x-data="{
      search: '{{ request('search','') }}',
      type:   '{{ request('type','') }}',
      tags:   {{ json_encode(array_map('intval', request('tags', []))) }},
      tools:  {{ json_encode(array_map('intval', request('tools', []))) }},
      filter() {
        const p = new URLSearchParams();
        if (this.search) p.set('search', this.search);
        if (this.type)   p.set('type', this.type);
        this.tags.forEach(i  => p.append('tags[]',  i));
        this.tools.forEach(i => p.append('tools[]', i));
        window.location.search = p;
      },
      reset() {
        this.search = '';
        this.type   = '';
        this.tags   = [];
        this.tools  = [];
        this.filter();
      },
    }"
    @click.away="dropdownTags = false; dropdownTools = false"

    >

    {{-- Filters & Search --}}
    <section class="py-6 mb-8">
      <div class="container mx-auto px-6">
        <div class="grid gap-4 md:grid-cols-4 lg:grid-cols-8 items-end">

          {{-- Search --}}
          <div class="col-span-2 lg:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Search</label>
            <input
              type="text"
              x-model.debounce.300ms="search"
              @keydown.enter="filter()"
              placeholder="Project title or description…"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm
                     focus:ring-blue-500 focus:border-blue-500 px-3 py-1.5 h-10"
            />
          </div>

          {{-- Type --}}
          <div class="col-span-2 lg:col-span-1">
            <label class="block text-sm font-medium text-gray-700">Type</label>
            <select
              x-model="type"
              @change="filter()"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm
                     focus:ring-blue-500 focus:border-blue-500 px-3 py-1.5 h-10"
            >
              <option value="">All Types…</option>
              @foreach($allTypes as $t)
                <option value="{{ $t }}">{{ $t }}</option>
              @endforeach
            </select>
          </div>

          {{-- Tags --}}
          <div class="col-span-2 md:col-span-1 lg:col-span-2">
            <x-multiselect-dropdown
              store="tags"
              selected="tags"
              name="tags"
              label="Tags"
              :fullWidth="true"
              @click.stop
            />
          </div>

          {{-- Tools --}}
          <div class="col-span-2 md:col-span-1 lg:col-span-2">
            <x-multiselect-dropdown
              store="tools"
              selected="tools"
              name="tools"
              label="Tools"
              :fullWidth="true"
              @click.stop
            />
          </div>

          {{-- Reset --}}
          <div class="col-span-4 lg:col-span-1 flex justify-end">
            <button
              @click="reset()"
              class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md"
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
                       w-28 h-28 rounded-full border-2 border-gray-200 bg-gray-200
                       flex items-center justify-center shadow-inner
                       transition-transform duration-300 group-hover:scale-110"
              >
                <img
                  src="{{ $project->media->first()?->media_url
                            ? asset($project->media->first()->media_url)
                            : asset('images/icon/NoImages.png') }}"
                  alt="{{ $project->title }}"
                  class="w-16 h-16 object-contain"
                >
              </div>

              {{-- card body --}}
              <div
                class="mt-12 pt-12 bg-white rounded-2xl flex flex-col justify-between
                       items-center text-center overflow-hidden shadow transition-transform
                       duration-300 group-hover:scale-105 group-hover:shadow-lg h-full"
              >
                <div>
                  <h3 class="mt-6 mx-5 text-xl font-semibold text-blue-600">
                    {{ $project->title }}
                  </h3>
                  <p class="mt-2 px-4 text-gray-700">
                    {{ Str::limit($project->description, 100) }}
                  </p>
                </div>
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
                      style="background-color: {{ $tag->color_hex }}33; color: {{ $tag->color_hex }};"
                    >
                      {{ $tag->name }}
                    </span>
                  @endforeach
                </div>
                <a href="{{ $project->link }}" target="_blank"
                   class="text-white font-semibold w-full
                          bg-gradient-to-br from-blue-500 to-purple-600 py-3 text-center"
                >
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

  {{-- Initialize Alpine stores --}}
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('tags',  @json($allTags));
      Alpine.store('tools', @json($allTools));
    });
  </script>
</x-layout>
