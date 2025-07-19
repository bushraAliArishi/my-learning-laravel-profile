{{-- resources/views/projects/index.blade.php --}}
<x-layout title="Projects">
  <x-slot name="heading">My Projects</x-slot>

  <div
    x-data="{
      search: '{{ request('search','') }}',
      type:   '{{ request('type','') }}',
      tags:   {{ json_encode(array_map('intval', request('tags', []))) }},
      tools:  {{ json_encode(array_map('intval', request('tools', []))) }},
      init() {
        this.$watch('search',  () => this.filter())
        this.$watch('type',    () => this.filter())
        this.$watch('tags',    () => this.filter())
        this.$watch('tools',   () => this.filter())
      },
      filter() {
        const p = new URLSearchParams()
        if (this.search) p.set('search', this.search)
        if (this.type)   p.set('type', this.type)
        this.tags.forEach(i  => p.append('tags[]',  i))
        this.tools.forEach(i => p.append('tools[]', i))
        window.location.search = p
      },
      reset() {
        this.search = ''
        this.type   = ''
        this.tags   = []
        this.tools  = []
        this.filter()
      },
    }"
    x-init="init()"
    @click.away="dropdownTags = false; dropdownTools = false"
    class="bg-gray-50 dark:bg-gray-900 min-h-screen"
  >

    {{-- Filter Cards --}}
    <section class="py-8 mb-12">
      <div class="max-w-7xl mx-auto px-6 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        
        {{-- Search --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
          <div class="relative">
            <input
              type="text"
              x-model.debounce.500ms="search"
              placeholder="Project title or description…"
              class="w-full h-10 px-4 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
            <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">🔍</span>
          </div>
        </div>

        {{-- Type --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type</label>
          <select
            x-model="type"
            class="w-full h-10 px-3 border border-gray-300 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm
                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
          >
            <option value="">All Types…</option>
            @foreach($allTypes as $t)
              <option value="{{ $t }}">{{ $t }}</option>
            @endforeach
          </select>
        </div>

        {{-- Tags --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
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
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
          <x-multiselect-dropdown
            store="tools"
            selected="tools"
            name="tools"
            label="Tools"
            :fullWidth="true"
            @click.stop
          />
        </div>

      </div>

      {{-- Reset --}}
      <div class="max-w-7xl mx-auto px-6 mt-6 flex justify-end">
        <button
          @click="reset()"
          class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow
                 focus:outline-none focus:ring-2 focus:ring-red-400"
        >
          Reset Filters
        </button>
      </div>
    </section>

    {{-- Project Cards --}}
    <section class="pb-16">
      <div class="max-w-7xl mx-auto px-6">
        <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-3">
          @foreach($projects as $project)
            <div class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-visible z-10 flex flex-col">
              
              {{-- Logo Banner --}}
              <div
                class="absolute -top-8 left-1/2 transform -translate-x-1/2
                       w-32 h-32 rounded-full border-4 border-white dark:border-gray-800 bg-gray-100 dark:bg-gray-700
                       flex items-center justify-center shadow-inner transition-transform duration-300 group-hover:scale-110"
              >
                <img
                  src="{{ optional($project->media->first())->media_url
                            ? asset($project->media->first()->media_url)
                            : asset('images/icon/NoImages.png') }}"
                  alt="{{ $project->title }}"
                  class="w-24 h-24 object-contain"
                />
              </div>

              {{-- Content --}}
              <div class="mt-16 pt-10 px-6 pb-6 flex-1 flex flex-col text-center">
                <h3 class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-3">
                  {{ $project->title }}
                </h3>
                <p class="text-gray-600 dark:text-gray-300 flex-1 mb-6">
                  {{ Str::limit($project->description, 120) }}
                </p>

                {{-- Tools Logos --}}
                <div class="flex flex-wrap justify-center gap-4 mb-6">
                  @foreach($project->tools as $tool)
                    <div class="p-1 bg-gray-100 dark:bg-gray-700 rounded-lg">
                      <img
                        src="{{ asset($tool->logo) }}"
                        alt="{{ $tool->name }}"
                        class="w-10 h-10 object-contain"
                        onerror="this.onerror=null;this.src='{{ asset('images/icon/NoImages.png') }}';"
                      />
                    </div>
                  @endforeach
                </div>

                {{-- Tags --}}
                <div class="flex flex-wrap justify-center gap-2 mb-6">
                  @foreach($project->tags as $tag)
                    <span
                      class="px-3 py-1 text-xs font-semibold rounded-full"
                      style="background-color: {{ $tag->color_hex }}33; color: {{ $tag->color_hex }};"
                    >
                      {{ $tag->name }}
                    </span>
                  @endforeach
                </div>
                {{-- Action Buttons --}}
                 <div class="flex w-full mt-auto overflow-hidden gap-4 ">
                  <a href="{{ $project->link }}" class="flex-1 w-full">
                    <x-button variant="gradient" size="lg" >
                      View
                    </x-button>
                  </a>
                  <a href="{{ route('projects.edit', $project->id) }}" class="flex-1 w-1/2">
                    <x-button variant="secondary" size="lg" >
                      Edit
                    </x-button>
                  </a>
                </div>



              </div>
            </div>
          @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12">
          {{ $projects->links() }}
        </div>
      </div>
    </section>
  </div>

  {{-- Alpine stores --}}
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('tags',  @json($allTags));
      Alpine.store('tools', @json($allTools));
    });
  </script>
</x-layout>
