{{-- resources/views/projects/edit.blade.php --}}
<x-layout title="Edit Project">
  <x-slot name="heading">Edit Project</x-slot>

  {{-- Center vertically --}}
  <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 px-6 py-8 my-32">
    <div class="max-w-3xl w-full space-y-8">
      <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data"
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 space-y-6">
        @csrf
        @method('PATCH')

        {{-- Title & Description --}}
        <div class="grid grid-cols-1 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
            <input
              type="text" name="title"
              value="{{ old('title', $project->title) }}"
              required
              class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
            <textarea
              name="description" rows="4"
              class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >{{ old('description', $project->description) }}</textarea>
            @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>
        </div>

        {{-- Type & Media --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
            <select
              name="type" required
              class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
              @foreach($allTypes as $t)
                <option value="{{ $t }}" @selected(old('type', $project->type)===$t)>{{ $t }}</option>
              @endforeach
            </select>
            @error('type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Logo / Cover Image</label>
            <input
              type="file" name="media[]" accept="image/*" multiple
              class="w-full text-gray-700 dark:text-gray-300"
            />
            @error('media') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>
        </div>

        {{-- Tags & Tools --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <x-multiselect-dropdown
              store="tags"
              selected="tags"
              name="tags"
              label="Tags"
              :fullWidth="true"
              @click.stop
            />
            @error('tags') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>
          <div>
            <x-multiselect-dropdown
              store="tools"
              selected="tools"
              name="tools"
              label="Tools"
              :fullWidth="true"
              @click.stop
            />
            @error('tools') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
          </div>
        </div>

        {{-- Actions --}}
        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
          <x-button
            variant="secondary"
            type="button"
            class="px-6"
            onclick="history.back()"
          >
            Cancel
          </x-button>
          <x-button variant="primary" type="submit" class="px-6">
            Update
          </x-button>
        </div>
      </form>
    </div>
  </div>

  {{-- Alpine stores --}}
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('tags',  @json($allTags));
      Alpine.store('tools', @json($allTools));
    });
  </script>
</x-layout>
