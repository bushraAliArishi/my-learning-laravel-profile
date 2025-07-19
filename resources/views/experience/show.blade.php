{{-- resources/views/experience/show.blade.php --}}
<x-layout title="View Experience">
  <x-slot name="heading">Experience Details</x-slot>

  <section class="pt-28 pb-16 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="container mx-auto px-6 max-w-3xl space-y-8">

      {{-- Header --}}
      <div class="space-y-2 text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $exp->title }}</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          {{ $exp->company }} &bull; {{ $exp->period }}
        </p>
      </div>

      {{-- Details --}}
      <div class="prose prose-lg mx-auto text-gray-700 dark:text-gray-300">
        {!! nl2br(e($exp->details)) !!}
      </div>

      {{-- Skills --}}
      @if($exp->skills->count())
        <div>
          <h3 class="text-xl font-semibold mb-2">Skills Acquired</h3>
          <ul class="list-disc pl-6 space-y-1">
            @foreach($exp->skills as $skill)
              <li>{{ $skill->skill_name }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Achievements --}}
      @if($exp->achievements->count())
        <div>
          <h3 class="text-xl font-semibold mb-2">Key Achievements</h3>
          <ul class="list-disc pl-6 space-y-1">
            @foreach($exp->achievements as $ach)
              <li>{{ $ach->description }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Tools --}}
      @if($exp->tools->count())
        <div>
          <h3 class="text-xl font-semibold mb-2">Tools & Technologies</h3>
          <div class="flex flex-wrap gap-4">
            @foreach($exp->tools as $tool)
              <span
                class="inline-flex items-center bg-indigo-100 dark:bg-indigo-600 text-indigo-800 dark:text-indigo-100 text-xs font-medium px-2 py-0.5 rounded-full"
              >
                <img
                  class="w-6 h-6 mr-2 object-contain rounded"
                  src="{{ asset($tool->logo) }}"
                  onerror="this.src='/images/icon/NoImages.png';"
                  alt="{{ $tool->name }} logo"
                />
                {{ $tool->name }}
              </span>
            @endforeach
          </div>
        </div>
      @endif

      {{-- Actions --}}
      <div class="flex justify-center gap-6 mt-12">
        <a href="{{ route('experience.index') }}">
          <x-button variant="secondary">← Back</x-button>
        </a>
        <a href="{{ route('experience.edit', $exp->id) }}">
          <x-button variant="primary">Edit</x-button>
        </a>
        <form method="POST" action="{{ route('experience.destroy', $exp->id) }}"
              onsubmit="return confirm('Delete this entry?');">
          @csrf @method('DELETE')
          <x-button variant="danger">Delete</x-button>
        </form>
      </div>

    </div>
  </section>
</x-layout>
