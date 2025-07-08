{{-- resources/views/projects.blade.php --}}
@php use App\Models\Project; @endphp

<x-layout title="Projects">
  <x-slot name="heading">My Projects</x-slot>

  <section class="pt-28 pb-16 bg-gray-50">
    <div class="container mx-auto px-6 max-w-6xl">
      <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-3">

        @foreach(Project::all() as $project)
          <div class="group bg-gradient-to-b from-gray-200 via-white to-white rounded-2xl shadow-lg overflow-hidden flex flex-col hover:shadow-2xl transition">

            {{-- Banner with padding and background --}}
            <div class="p-6 flex items-center justify-center h-48 overflow-hidden">
              <img 
                src="{{ $project['image'] }}"
                onerror="this.onerror=null; this.src='{{ asset('images/logos/default-banner.png') }}'"
                alt="{{ $project['title'] }}"
                class="w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300"
                style="filter: drop-shadow(0 0 4px rgba(0,0,0,0.15));"
              >
            </div>

            <div class="p-6 flex-1 flex flex-col">

              {{-- Host logo with soft background --}}
              <div class="flex justify-end mb-4">
                <div class="bg-gray-100 p-1.5 rounded-full inline-flex items-center justify-center shadow-sm border border-gray-300">
                  <img 
                    src="{{ asset('images/logos/' . Project::hostLogo($project['link'])) }}"
                    onerror="this.onerror=null; this.src='{{ asset('images/logos/default-logo.svg') }}'"
                    alt="Host logo"
                    class="w-6 h-6 object-contain"
                  >
                </div>
              </div>

              {{-- Title & Type --}}
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-xl font-semibold leading-snug">{{ $project['title'] }}</h3>
                <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                  {{ $project['type'] }}
                </span>
              </div>

              {{-- Description --}}
              <p class="text-gray-600 flex-1 mb-6">{{ $project['description'] }}</p>

              {{-- Tech icons --}}
              <div class="flex flex-wrap gap-4 mb-6">
                @foreach($project['tech'] as $tech)
                  <img
                    src="{{ asset('images/logos/' . Project::techIcon($tech)) }}"
                    onerror="this.onerror=null; this.src='{{ asset('images/logos/default-logo.svg') }}'"
                    alt="{{ $tech }} logo"
                    title="{{ $tech }}"
                    class="w-10 h-10 object-contain"
                  >
                @endforeach
              </div>

              {{-- View button --}}
              <a
                href="{{ $project['link'] }}"
                target="_blank"
                class="mt-auto inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg text-center"
              >
                View Project →
              </a>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </section>
</x-layout>
