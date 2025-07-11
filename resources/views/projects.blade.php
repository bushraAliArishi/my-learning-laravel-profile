{{-- resources/views/projects.blade.php --}}
<x-layout title="Projects">
  <x-slot name="heading">My Projects</x-slot>
<section class="py-6 mt-20">
    <div class="container mx-auto px-6">
      <form id="filters" method="get" class="grid gap-4 md:grid-cols-3 lg:grid-cols-5 items-end">
        <div class="col-span-3">
          <label class="block text-sm font-medium text-gray-700">Search</label>
          <input
            x-data
            @input="$el.form.submit()"
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Project title or description…"
            class="mt-1 block w-full h-10 border rounded-md px-3"
          >
        </div>

        <div x-data="multiSelect(@json($allTags->pluck('name','id')), @json(request('tags', [])))" @click.away="open=false">
          <label class="block text-sm font-medium text-gray-700">Tags</label>
          <div class="mt-1 relative">
            <div class="p-2 border rounded-md flex flex-wrap gap-1 cursor-pointer" @click="open = true">
              <template x-for="id in selected" :key="id">
                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full flex items-center">
                  <span x-text="options[id]"></span>
                  <button type="button" class="ml-1" @click.stop="remove(id)">×</button>
                </span>
              </template>
              <input
                x-model="query"
                placeholder="Select tags…"
                class="border-none flex-1 h-8 focus:ring-0 focus:outline-none text-sm"
              >
            </div>
            <ul
              x-show="open"
              x-cloak
              class="absolute bg-transparent border rounded-md mt-1 w-full max-h-48 overflow-auto z-20"
            >
              <template x-for="(name, id) in filtered" :key="id">
                <li
                  class="px-3 py-2 hover:bg-gray-100 cursor-pointer text-sm"
                  @click="choose(id)"
                  x-text="name"
                ></li>
              </template>
            </ul>
          </div>
          <template x-for="id in selected" :key="id">
            <input type="hidden" name="tags[]" :value="id">
          </template>
        </div>

        <div x-data="multiSelect(@json($allTools->pluck('name','id')), @json(request('tools', [])))" @click.away="open=false">
          <label class="block text-sm font-medium text-gray-700">Tools</label>
          <div class="mt-1 relative">
            <div class="p-2 border rounded-md flex flex-wrap gap-1 cursor-pointer" @click="open = true">
              <template x-for="id in selected" :key="id">
                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full flex items-center">
                  <span x-text="options[id]"></span>
                  <button type="button" class="ml-1" @click.stop="remove(id)">×</button>
                </span>
              </template>
              <input
                x-model="query"
                placeholder="Select tools…"
                class="border-none flex-1 h-8 focus:ring-0 focus:outline-none text-sm"
              >
            </div>
            <ul
              x-show="open"
              x-cloak
              class="absolute bg-transparent border rounded-md mt-1 w-full max-h-48 overflow-auto z-20"
            >
              <template x-for="(name, id) in filtered" :key="id">
                <li
                  class="px-3 py-2 hover:bg-gray-100 cursor-pointer text-sm"
                  @click="choose(id)"
                  x-text="name"
                ></li>
              </template>
            </ul>
          </div>
          <template x-for="id in selected" :key="id">
            <input type="hidden" name="tools[]" :value="id">
          </template>
        </div>
      </form>
    </div>
  </section>

  <section class="pb-16 bg-gray-50">
    <div class="container mx-auto px-6 max-w-6xl">
      <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-3">
        @foreach($projects as $project)
          <div class="group bg-white rounded-2xl shadow hover:shadow-lg overflow-hidden flex flex-col">
            <div class="p-6 flex justify-center">
              <img
                src="{{ asset('images/logos/' . \App\Models\Project::hostLogo($project->link)) }}"
                alt="Host logo"
                class="w-16 h-16 object-contain"
              >
            </div>
            <div class="px-6 pb-6 flex-1 flex flex-col">
              <h3 class="text-lg font-semibold mb-2">{{ $project->title }}</h3>
              <p class="text-gray-600 flex-1">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</p>
              <div class="mt-4 flex flex-wrap gap-2">
                @foreach($project->tags as $tag)
                  <span
                    class="text-xs font-medium px-2 py-1 rounded"
                    style="background-color: {{ $tag->color_hex }}33; color: {{ $tag->color_hex }};"
                  >{{ $tag->name }}</span>
                @endforeach
              </div>
              <a href="{{ $project->link }}" target="_blank" class="mt-4 inline-block text-blue-600 hover:underline">
                View →
              </a>
            </div>
          </div>
        @endforeach
      </div>
      <div class="mt-8">{{ $projects->links() }}</div>
    </div>
  </section>

  <script>
    function multiSelect(options, initial = []) {
      return {
        options,
        selected: initial,
        open: false,
        query: '',
        get filtered() {
          return Object.entries(this.options)
            .filter(([id, name]) =>
              name.toLowerCase().includes(this.query.toLowerCase()) &&
              !this.selected.includes(Number(id))
            )
            .reduce((obj, [id, name]) => (obj[id] = name, obj), {});
        },
        choose(id) {
          this.selected.push(Number(id));
          this.open = false;
          this.query = '';
          document.getElementById('filters').submit();
        },
        remove(id) {
          this.selected = this.selected.filter(i => i !== id);
          document.getElementById('filters').submit();
        }
      }
    }
  </script>
</x-layout>
