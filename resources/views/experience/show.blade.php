<x-layout title="{{ $title }}">
  <x-slot name="heading">{{ $heading }}</x-slot>

  <section class="pt-28 py-16 bg-white text-gray-800">
    <div class="container mx-auto px-6 max-w-3xl">
      <h2 class="text-3xl font-bold mb-4">{{ $exp['title'] }}</h2>
      <p class="text-sm text-gray-500 mb-6">{{ $heading }}</p>

      <h3 class="text-xl font-semibold mb-3">Key Achievements</h3>
      <ul class="list-disc pl-5 mb-6 space-y-2 text-gray-700">
        @foreach($exp['achievements'] as $a)
          <li>{{ $a }}</li>
        @endforeach
      </ul>

      <h3 class="text-xl font-semibold mb-3">Details</h3>
      <p class="leading-relaxed text-gray-700 mb-8">{{ $exp['details'] }}</p>

      <div class="text-center">
        <a href="/experience" class="text-indigo-600 hover:underline font-medium">
          ← Back to all experiences
        </a>
      </div>
    </div>
  </section>
</x-layout>
