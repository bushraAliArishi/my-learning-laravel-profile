<x-layout title="{{ $title }}">
  <x-slot name="heading">{{ $heading }}</x-slot>

  <section class="pt-28 py-16 bg-gray-100 text-gray-800">
    <div class="container mx-auto px-6">
      <h2 class="sr-only">{{ $heading }}</h2>

      <div class="grid md:grid-cols-2 gap-8 max-w-6xl mx-auto">
        @foreach($experiences as $e)
          <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
            <h3 class="text-2xl font-semibold mb-2">{{ $e['title'] }}</h3>
            <p class="text-sm text-gray-500 mb-4">{{ $e['company'] }} • {{ $e['period'] }}</p>
            <ul class="list-disc pl-5 mb-4 space-y-1 text-gray-700">
              @foreach($e['achievements'] as $a)
                <li>{{ $a }}</li>
              @endforeach
            </ul>
            <a href="{{ url("/experience/{$e['slug']}") }}"
               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded transition">
              Read More
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>
</x-layout>
