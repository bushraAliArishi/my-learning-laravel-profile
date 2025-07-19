{{-- resources/views/experience/edit.blade.php --}}
<x-layout title="Edit Experience">
  <x-slot name="heading">Edit Experience</x-slot>

  <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 px-4 py-8">
    <div class="max-w-3xl w-full bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">

      <form
        x-data="experienceForm()"
        @click.away="dropdownTools = false"
        method="POST"
        action="{{ route('experience.update', $exp->id) }}"
        class="space-y-8"
      >
        @csrf
        @method('PATCH')

        {{-- DETAILS --}}
        <div class="space-y-6">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Experience Details</h2>

          {{-- Slug --}}
          <div>
            <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Slug</label>
            <input
              x-model="slug"
              type="text" name="slug" id="slug" required
              class="mt-2 block w-full rounded-lg border border-gray-300 dark:border-gray-700 px-4 py-2
                     bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          {{-- Title --}}
          <div>
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
            <input
              x-model="title"
              type="text" name="title" id="title" required
              class="mt-2 block w-full rounded-lg border border-gray-300 dark:border-gray-700 px-4 py-2
                     bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          {{-- Company --}}
          <div>
            <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company</label>
            <input
              x-model="company"
              type="text" name="company" id="company" required
              class="mt-2 block w-full rounded-lg border border-gray-300 dark:border-gray-700 px-4 py-2
                     bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          {{-- Dates --}}
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
              <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
              <input
                x-model="start_date"
                type="date" name="start_date" id="start_date" required
                class="mt-2 block w-full rounded-lg border border-gray-300 dark:border-gray-700 px-4 py-2
                       bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <div>
              <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                End Date <span class="text-xs text-gray-500">(optional)</span>
              </label>
              <input
                x-model="end_date"
                type="date" name="end_date" id="end_date"
                class="mt-2 block w-full rounded-lg border border-gray-300 dark:border-gray-700 px-4 py-2
                       bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
          </div>

          {{-- Details --}}
          <div>
            <label for="details" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Details</label>
            <textarea
              x-model="details"
              name="details" id="details" rows="4" required
              class="mt-2 block w-full rounded-lg border border-gray-300 dark:border-gray-700 px-4 py-2
                     bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
            ></textarea>
          </div>
        </div>

        {{-- SKILLS --}}
        <div class="space-y-4">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Skills Acquired</h3>
          <template x-for="(skill, i) in skills" :key="i">
            <div class="flex items-center gap-2">
              <input
                x-model="skills[i]"
                :name="`skills[${i}]`"
                type="text"
                placeholder="Skill name"
                class="flex-1 rounded-lg border border-gray-300 dark:border-gray-700 px-3 py-2
                       bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
              <button type="button" @click="removeSkill(i)" class="text-red-600 hover:text-red-800">×</button>
            </div>
          </template>
          <button type="button" @click="addSkill()" class="text-sm text-blue-600 hover:underline">+ Add Skill</button>
        </div>

        {{-- ACHIEVEMENTS --}}
        <div class="space-y-4">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Key Achievements</h3>
          <template x-for="(ach, j) in achievements" :key="j">
            <div class="flex items-center gap-2">
              <textarea
                x-model="achievements[j]"
                :name="`achievements[${j}]`"
                rows="2"
                placeholder="Achievement description"
                class="flex-1 rounded-lg border border-gray-300 dark:border-gray-700 px-3 py-2
                       bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
              ></textarea>
              <button type="button" @click="removeAchievement(j)" class="text-red-600 hover:text-red-800">×</button>
            </div>
          </template>
          <button type="button" @click="addAchievement()" class="text-sm text-blue-600 hover:underline">
            + Add Achievement
          </button>
        </div>

        {{-- TOOLS --}}
        <div>
          <x-multiselect-dropdown
            store="tools"
            selected="tools"
            name="tools"
            label="Tools & Technologies"
            :fullWidth="true"
            @click.stop
          />
        </div>

        {{-- ACTIONS --}}
        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
          <x-button variant="secondary" type="button" @click="history.back()">Cancel</x-button>
          <x-button variant="primary" type="submit">Update</x-button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function experienceForm() {
      return {
        slug:         {!! json_encode(old('slug',    $exp->slug)) !!},
        title:        {!! json_encode(old('title',   $exp->title)) !!},
        company:      {!! json_encode(old('company', $exp->company)) !!},
        start_date:   {!! json_encode(old('start_date', $exp->start_date)) !!},
        end_date:     {!! json_encode(old('end_date',   $exp->end_date)) !!},
        details:      {!! json_encode(old('details',  $exp->details)) !!},
        tools:        {!! json_encode(old('tools', $exp->tools->pluck('id')->all())) !!},
        skills:       {!! json_encode(old('skills', $exp->skills->pluck('skill_name')->all() ?: [''])) !!},
        achievements: {!! json_encode(old('achievements', $exp->achievements->pluck('description')->all() ?: [''])) !!},
        dropdownTools: false,

        addSkill()          { this.skills.push('') },
        removeSkill(i)      { this.skills.splice(i,1) },
        addAchievement()    { this.achievements.push('') },
        removeAchievement(i){ this.achievements.splice(i,1) },
      }
    }

    document.addEventListener('alpine:init', () => {
      Alpine.store('tools', @json($allTools));
    });
  </script>
</x-layout>
