{{-- resources/views/experience/edit.blade.php --}}
<x-layout title="Edit Experience">
    <x-slot name="heading">Edit Experience</x-slot>

    <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 px-4 py-32">
        <div class="max-w-3xl w-full bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">

            {{-- UPDATE FORM --}}
            <form
                x-data="experienceForm()"
                @click.away="dropdownTools = false"
                method="POST"
                action="{{ route('experience.update', $experience) }}"
                class="space-y-8"
            >
                @csrf
                @method('PATCH')

                {{-- DETAILS --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Experience Details</h2>

                    {{-- Slug --}}
                    <div>
                        <x-form-label for="slug">Slug</x-form-label>
                        <x-form-input
                            name="slug"
                            id="slug"
                            x-model="slug"
                            placeholder="Enter slug…"
                            required
                        />
                        @error('slug')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Title --}}
                    <div>
                        <x-form-label for="title">Title</x-form-label>
                        <x-form-input
                            name="title"
                            id="title"
                            x-model="title"
                            placeholder="Enter title…"
                            required
                        />
                        @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Company --}}
                    <div>
                        <x-form-label for="company">Company</x-form-label>
                        <x-form-input
                            name="company"
                            id="company"
                            x-model="company"
                            placeholder="Enter company…"
                            required
                        />
                        @error('company')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Dates --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <x-form-label for="start_date">Start Date</x-form-label>
                            <x-form-input
                                type="date"
                                name="start_date"
                                id="start_date"
                                x-model="start_date"
                                required
                            />
                            @error('start_date')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <x-form-label for="end_date">
                                End Date <span class="text-xs text-gray-500">(optional)</span>
                            </x-form-label>
                            <x-form-input
                                type="date"
                                name="end_date"
                                id="end_date"
                                x-model="end_date"
                                x-bind:min="start_date"
                            />
                            @error('end_date')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Details --}}
                    <div>
                        <x-form-label for="details">Details</x-form-label>
                        <x-form-input
                            type="textarea"
                            name="details"
                            id="details"
                            x-model="details"
                            placeholder="Enter details…"
                            rows="4"
                            required
                        >{{ old('details', $experience->details) }}</x-form-input>
                        @error('details')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- SKILLS --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Skills Acquired</h3>
                    <template x-for="(skill,i) in skills" :key="i">
                        <div class="flex items-center gap-2">
                            <x-form-input
                                x-bind:name="`skills[${i}]`"
                                x-model="skills[i]"
                                placeholder="Skill name"
                            />
                            <button type="button" @click="removeSkill(i)" class="text-red-600 hover:text-red-800">×
                            </button>
                        </div>
                    </template>
                    @error('skills')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    <button type="button" @click="addSkill()" class="text-sm text-blue-600 hover:underline">+ Add
                        Skill
                    </button>
                </div>

                {{-- ACHIEVEMENTS --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Key Achievements</h3>
                    <template x-for="(ach,j) in achievements" :key="j">
                        <div class="flex items-center gap-2">
                            <x-form-input
                                type="textarea"
                                x-bind:name="`achievements[${j}]`"
                                x-model="achievements[j]"
                                placeholder="Achievement description"
                                rows="2"
                            />
                            <button type="button" @click="removeAchievement(j)" class="text-red-600 hover:text-red-800">
                                ×
                            </button>
                        </div>
                    </template>
                    @error('achievements')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    <button type="button" @click="addAchievement()" class="text-sm text-blue-600 hover:underline">+ Add
                        Achievement
                    </button>
                </div>

                {{-- TOOLS --}}
                <div>
                    <x-form-label for="tools">Tools & Technologies</x-form-label>
                    <x-multiselect-dropdown
                        store="tools"
                        selected="tools"
                        name="tools"
                        :fullWidth="true"
                        @click.stop
                    />
                    @error('tools')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- UPDATE BUTTON --}}
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <x-button variant="primary" type="submit">Update Experience</x-button>
                    <x-button variant="secondary" type="button" @click="history.back()">Cancel</x-button>
                </div>
            </form>

            {{-- DELETE FORM (now outside) --}}
            <form
                class="pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-start"
                method="POST"
                action="{{ route('experience.destroy', $experience) }}"
                onsubmit="return confirm('Delete this experience?')"
            >
                @csrf
                @method('DELETE')
                <x-button variant="danger">Delete Experience</x-button>
            </form>

        </div>
    </div>

    <script>
        function experienceForm() {
            return {
                slug:         @json(old('slug',    $experience->slug)),
                title:        @json(old('title',   $experience->title)),
                company:      @json(old('company', $experience->company)),
                start_date:   @json(old('start_date', $experience->start_date)),
                end_date:     @json(old('end_date',   $experience->end_date)),
                details:      @json(old('details',  $experience->details)),
                tools:        @json(old('tools', $experience->tools->pluck('id')->all())),
                skills:       @json(old('skills', $experience->skills->pluck('skill_name')->all() ?: [''])),
                achievements: @json(old('achievements', $experience->achievements->pluck('description')->all() ?: [''])),
                dropdownTools: false,

                addSkill() {
                    this.skills.push('')
                },
                removeSkill(i) {
                    this.skills.splice(i, 1)
                },
                addAchievement() {
                    this.achievements.push('')
                },
                removeAchievement(j) {
                    this.achievements.splice(j, 1)
                },
            }
        }

        document.addEventListener('alpine:init', () => {
            Alpine.store('tools', @json($allTools));
        });
    </script>
</x-layout>
