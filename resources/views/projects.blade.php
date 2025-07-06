<x-layout title="{{ $title }}">
  <x-slot name="heading">{{ $heading }}</x-slot>

  <section class="py-16 bg-white text-gray-800">
    <div class="container mx-auto px-6">
      <h2 class="text-4xl font-bold text-center mb-12">{{ $heading }}</h2>
      <div class="grid md:grid-cols-2 gap-8 max-w-6xl mx-auto">
        @foreach($projects as $project)
          <div class="p-6 bg-gray-50 rounded-lg shadow hover:shadow-lg transition">
            <div class="flex justify-between items-start mb-4">
              <h3 class="text-2xl font-semibold">{{ $project['title'] }}</h3>
              <span class="text-sm text-gray-500">{{ $project['type'] }}</span>
            </div>
            <p class="text-gray-600 mb-4">{{ $project['description'] }}</p>
            <ul class="list-disc pl-5 space-y-1 mb-4 text-gray-700">
              @foreach($project['highlights'] as $highlight)
                <li>{{ $highlight }}</li>
              @endforeach
            </ul>
            <div class="flex flex-wrap gap-2 mb-6">
              @foreach($project['tech'] as $tech)
                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $tech }}</span>
              @endforeach
            </div>
            <div class="text-right">
              <a
                href="{{ $project['link'] }}"
                target="_blank"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition"
              >
                View Project
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
</x-layout>
