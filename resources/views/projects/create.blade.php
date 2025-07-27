{{-- resources/views/projects/create.blade.php --}}
<x-layout title="Create Project">
    <x-slot name="heading">Create Project</x-slot>

    <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 px-6 py-32">
        <!-- White card on gray page -->
        <div class="w-full max-w-3xl bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 space-y-6">

            <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">Create New Project</h2>

            <form
                x-data="projectForm()"
                method="POST"
                action="{{ route('projects.store') }}"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                @csrf

                {{-- Title --}}
                <div>
                    <x-form-label for="title">Title</x-form-label>
                    <x-form-input
                        name="title"
                        id="title"
                        placeholder="Enter project title…"
                        value="{{ old('title') }}"
                        required
                    />
                    @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Description --}}
                <div>
                    <x-form-label for="description">Description</x-form-label>
                    <x-form-input
                        type="textarea"
                        name="description"
                        id="description"
                        rows="4"
                        placeholder="Enter project description…"
                        required
                    >{{ old('description') }}</x-form-input>
                    @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Type --}}
                <div>
                    <x-form-label for="type">Type</x-form-label>
                    <select
                        name="type"
                        id="type"
                        x-model="type"
                        class="block w-full mt-1 rounded-md border-gray-300 bg-white dark:bg-gray-900"
                        required
                    >
                        <option value="">Select a type…</option>
                        @foreach($allTypes as $t)
                            <option value="{{ $t }}" @selected(old('type')===$t)>{{ $t }}</option>
                        @endforeach
                        <option value="__other">Other…</option>
                    </select>
                    @error('type')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror

                    <div x-show="type==='__other'" x-cloak class="mt-2">
                        <x-form-input
                            type="text"
                            name="type_other"
                            placeholder="Enter new type…"
                            value="{{ old('type_other') }}"
                            required
                        />
                        @error('type_other')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Logo / Cover Image --}}
                <div>
                    <x-form-label for="media">Logo / Cover Image</x-form-label>
                    <x-form-input
                        type="file"
                        name="media[]"
                        id="media"
                        accept="image/*"
                    />
                    @error('media.*')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Tags --}}
                <div>
                    <x-form-label for="tags">Tags</x-form-label>
                    <x-multiselect-dropdown
                        store="tags"
                        selected="tags"
                        name="tags"
                        :fullWidth="true"
                    />
                    @error('tags')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Tools --}}
                <div>
                    <x-form-label for="tools">Tools</x-form-label>
                    <x-multiselect-dropdown
                        store="tools"
                        selected="tools"
                        name="tools"
                        :fullWidth="true"
                    />
                    @error('tools')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Actions --}}
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <x-button variant="secondary" type="button" @click="history.back()">Cancel</x-button>
                    <x-button variant="primary" type="submit">Create Project</x-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function projectForm() {
            return {
                type:  @json(old('type','')),
                tags:  @json(old('tags', [])),
                tools: @json(old('tools', [])),
            }
        }

        document.addEventListener('alpine:init', () => {
            Alpine.store('tags',  @json($allTags));
            Alpine.store('tools', @json($allTools));
        });
    </script>
</x-layout>
