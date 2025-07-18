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

      {{-- Skills --}}
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

      {{-- Actions: Back / Edit / Delete --}}
      <div class="flex justify-center gap-x-6 mt-12">
        <a href="{{ route('experience.index') }}"
           class="px-6 py-3 rounded-md bg-gray-200 text-gray-800 hover:bg-gray-300 font-medium">
          &larr; Back
        </a>

        <a href="{{ route('experience.edit', $exp->id) }}"
           class="px-6 py-3 rounded-md bg-blue-600 text-white hover:bg-blue-700 font-medium">
          Edit
        </a>

        <form method="POST"
              action="{{ route('experience.destroy', $exp->id) }}"
              onsubmit="return confirm('Delete this entry?');"
        >
          @csrf
          @method('DELETE')
          <button type="submit"
                  class="px-6 py-3 rounded-md bg-red-600 text-white hover:bg-red-700 font-medium">
            Delete
          </button>
        </form>
      </div>

    </div>
  </section>
</x-layout>
