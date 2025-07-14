{{-- resources/views/experience/show.blade.php --}}
<x-layout :title="$title">
  <x-slot name="heading">{{ $heading }}</x-slot>

  <section class="pt-28 pb-16 bg-white text-gray-800">
    <div class="container mx-auto px-6 max-w-3xl space-y-8">

      {{-- Title & Period --}}
      <div class="space-y-2 text-center">
        <h2 class="text-3xl font-bold">{{ $exp->title }}</h2>
        <p class="text-sm text-gray-500">
          {{ $exp->company }} &bull;
          {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }}
          &ndash;
          {{ $exp->end_date
              ? \Carbon\Carbon::parse($exp->end_date)->format('M Y')
              : 'Present' }}
        </p>
      </div>

      {{-- Details --}}
      <div class="prose prose-lg mx-auto text-gray-700">
        <p>{{ $exp->details }}</p>
      </div>

      {{-- Skills Section --}}
      <div>
        <h3 class="text-xl font-semibold mb-4">Skills Acquired</h3>
        <ul class="list-disc pl-6 space-y-2">
          @foreach($exp->skills as $skill)
            <li>{{ $skill->skill_name }}</li>
          @endforeach
        </ul>
      </div>

      {{-- Achievements --}}
      <div>
        <h3 class="text-xl font-semibold mb-4">Key Achievements</h3>
        <ul class="list-disc pl-6 space-y-2">
          @foreach($exp->achievements as $achievement)
            <li>{{ $achievement->description }}</li>
          @endforeach
        </ul>
      </div>

      {{-- Tools & Technologies --}}
      <div>
        <h3 class="text-xl font-semibold mb-4">Tools & Technologies</h3>
        <div class="flex flex-wrap gap-6 justify-center">
          @foreach($exp->tools as $tool)
            <div class="flex flex-col items-center w-24">
              <img
                src="{{ asset($tool->logo) }}"
                alt="{{ $tool->name }} logo"
                class="w-16 h-16 object-contain mb-2"
                onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';"
              >
              <span class="text-xs text-gray-600 text-center">{{ $tool->name }}</span>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Back Link --}}
      <div class="text-center">
        <a href="{{ route('experience.index') }}"
           class="text-blue-600 hover:underline font-medium">
          &larr; Back to all experiences
        </a>
      </div>

    </div>
  </section>
</x-layout>
