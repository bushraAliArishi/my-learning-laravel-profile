{{-- resources/views/projects/edit.blade.php --}}
<x-layout title="Edit Project">
    <x-slot name="heading">Edit Project</x-slot>

    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-6 py-32">
        <!-- Card itself is now white -->
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-8 space-y-6">

            <h2 class="text-2xl font-semibold text-gray-900">Edit Project</h2>

            {{-- UPDATE FORM --}}
            <form
                x-data="projectForm()"
                method="POST"
                action="{{ route('projects.update', $project) }}"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                @csrf
                @method('PATCH')

                {{-- Title --}}
                <div>
                    <x-form-label for="title">Title</x-form-label>
                    <x-form-input
                        name="title"
                        id="title"
                        placeholder="Enter project title…"
                        value="{{ old('title', $project->title) }}"
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
                    >{{ old('description', $project->description) }}</x-form-input>
                    @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Type --}}
                <div>
                    <x-form-label for="type">Type</x-form-label>
                    <select
                        name="type"
                        id="type"
                        x-model="type"
                        class="block w-full mt-1 rounded-md border-gray-300 bg-white"
                        required
                    >
                        <option value="">Select a type…</option>
                        @foreach($allTypes as $t)
                            <option value="{{ $t }}" @selected(old('type', $project->type) === $t)>{{ $t }}</option>
                        @endforeach
                        <option value="__other">Other…</option>
                    </select>
                    @error('type')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror

                    <div x-show="type==='__other'" class="mt-2">
                        <x-form-input
                            type="text"
                            name="type_other"
                            placeholder="Enter new type…"
                            value="{{ old('type_other', $project->type) }}"
                        />
                        @error('type_other')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Current Images --}}
                <div>
                    <x-form-label>Current Images</x-form-label>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($project->media as $media)
                            <div class="relative border rounded-lg overflow-hidden">
                                <img
                                    src="{{ Storage::url($media->media_url) }}"
                                    alt=""
                                    class="w-full h-40 object-cover"
                                />
                                <label class="absolute top-1 right-1 bg-white rounded-full p-1 cursor-pointer">
                                    <input type="checkbox" name="remove_media[]" value="{{ $media->id }}"
                                           class="hidden"/>
                                    <span class="text-red-600 font-bold">×</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('remove_media.*')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Add New Images --}}
                <div>
                    <x-form-label for="media">Add New Images</x-form-label>
                    <x-form-input
                        type="file"
                        name="media[]"
                        id="media"
                        multiple
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

                {{-- Buttons --}}
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <x-button variant="secondary" type="button" @click="history.back()">Cancel</x-button>
                    <x-button variant="primary" type="submit">Update Project</x-button>
                </div>
            </form>

            {{-- DELETE FORM --}}
            <form
                method="POST"
                action="{{ route('projects.destroy', $project) }}"
                onsubmit="return confirm('Delete this project?')"
                class="pt-4 border-t border-gray-200 flex justify-start"
            >
                @csrf
                @method('DELETE')
                <x-button variant="danger">Delete Project</x-button>
            </form>
        </div>
    </div>

    <script>
        function projectForm() {
            return {
                type:  @json(old('type', $project->type)),
                tags:  @json(old('tags', $project->tags->pluck('id')->all())),
                tools: @json(old('tools', $project->tools->pluck('id')->all())),
            }
        }

        document.addEventListener('alpine:init', () => {
            Alpine.store('tags',  @json($allTags));
            Alpine.store('tools', @json($allTools));
        });
    </script>
</x-layout>
