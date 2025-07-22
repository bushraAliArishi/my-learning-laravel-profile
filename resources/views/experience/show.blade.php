{{-- resources/views/experience/show.blade.php --}}
<x-layout title="View Experience">
  <x-slot name="heading">Experience Details</x-slot>

  <section class="pt-28 pb-16 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="container mx-auto px-6 max-w-3xl space-y-8">

      {{-- Header --}}
      <div class="space-y-2 text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
          {{ $experience->title }}
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          {{ $experience->company }} • {{ $experience->period }}
        </p>
      </div>

      {{-- Details --}}
      <div class="prose prose-lg mx-auto text-gray-700 dark:text-gray-300">
        {!! nl2br(e($experience->details)) !!}
      </div>

      {{-- Skills --}}
      @if($experience->skills->count())
        <div>
          <h3 class="text-xl font-semibold mb-2">Skills Acquired</h3>
          <ul class="list-disc pl-6 space-y-1">
            @foreach($experience->skills as $skill)
              <li>{{ $skill->skill_name }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Achievements --}}
      @if($experience->achievements->count())
        <div>
          <h3 class="text-xl font-semibold mb-2">Key Achievements</h3>
          <ul class="list-disc pl-6 space-y-1">
            @foreach($experience->achievements as $ach)
              <li>{{ $ach->description }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Tools --}}
      @if($experience->tools->count())
        <div>
          <h3 class="text-xl font-semibold mb-2">Tools & Technologies</h3>
          <div class="flex flex-wrap gap-4">
            @foreach($experience->tools as $tool)
              <span class="inline-flex items-center bg-indigo-100 dark:bg-indigo-600 
                           text-indigo-800 dark:text-indigo-100 text-xs font-medium 
                           px-2 py-0.5 rounded-full">
                <img
                  class="w-12 h-12 py-2 px-2 mr-2 object-contain rounded"
                  src="{{ asset($tool->logo) }}"
                  onerror="this.src='{{ asset('images/icon/NoImages.png') }}';"
                  alt="{{ $tool->name }} logo"
                />
                {{ $tool->name }}
              </span>
            @endforeach
          </div>
        </div>
      @endif

      
      </div>

    </div>
  </section>
</x-layout>
