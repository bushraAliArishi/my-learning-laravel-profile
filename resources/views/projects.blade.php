{{-- resources/views/projects.blade.php --}}
@php
  use App\Models\Project;
  use Illuminate\Support\Str;

  // 1) جيب كل المشاريع مع العلاقات
  $dbProjects = Project::with(['media','tags','tools'])->get();

  // 2) إذا الفهرس فاضي، رجع للمصفوفة الثابتة
  if ($dbProjects->isEmpty()) {
      $projects   = Project::allStatic();  // المصفوفة الثابتة
      $useStatic  = true;
  } else {
      $projects  = $dbProjects;
      $useStatic = false;
  }
@endphp

<x-layout :title="$title">
  <x-slot name="heading">{{ $heading }}</x-slot>

  <section class="pt-28 pb-16 bg-gray-50">
    <div class="container mx-auto px-6 max-w-6xl">
      <div class="grid gap-12 md:grid-cols-2 lg:grid-cols-3">

        @foreach($projects as $project)
          <div class="group bg-gradient-to-b from-gray-200 via-white to-white rounded-2xl shadow-lg overflow-hidden flex flex-col hover:shadow-2xl transition">

            {{-- Banner --}}
            <div class="p-6 flex items-center justify-center h-48 overflow-hidden">
              @if($useStatic)
                <img 
                  src="{{ $project['image'] }}"
                  alt="{{ $project['title'] }}"
                  class="w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300"
                >
              @else
                @if($project->media->isNotEmpty())
                  <img 
                    src="{{ asset($project->media->first()->media_url) }}"
                    alt="{{ $project->title }}"
                    class="w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-300"
                  >
                @else
                  <img 
                    src="{{ asset('images/logos/default-banner.png') }}"
                    alt="{{ $project->title }}"
                    class="w-full max-h-full object-contain"
                  >
                @endif
              @endif
            </div>

            <div class="p-6 flex-1 flex flex-col">

              {{-- Host logo --}}
              <div class="flex justify-end mb-4">
                <div class="bg-gray-100 p-1.5 rounded-full inline-flex items-center justify-center shadow-sm border border-gray-300">
                  @if($useStatic)
                    <img 
                      src="{{ asset('images/logos/' . Project::hostLogo($project['link'])) }}"
                      alt="Host logo"
                      class="w-6 h-6 object-contain"
                    >
                  @else
                    <img 
                      src="{{ asset('images/logos/' . Project::hostLogo($project->link)) }}"
                      alt="Host logo"
                      class="w-6 h-6 object-contain"
                    >
                  @endif
                </div>
              </div>

              {{-- Title & Type --}}
              <div class="flex items-center justify-between mb-3">
                <h3 class="text-xl font-semibold leading-snug">
                  {{ $useStatic ? $project['title'] : $project->title }}
                </h3>
                <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                  {{ $useStatic ? $project['type'] : $project->type }}
                </span>
              </div>

              {{-- Description --}}
              <p class="text-gray-600 flex-1 mb-6">
                {{ $useStatic ? $project['description'] : $project->description }}
              </p>

              {{-- Tech / Tools --}}
              <div class="flex flex-wrap gap-4 mb-6">
                @if($useStatic)
                  @foreach($project['tech'] as $tech)
                    <img
                      src="{{ asset('images/logos/' . Project::techIcon($tech)) }}"
                      alt="{{ $tech }} logo"
                      title="{{ $tech }}"
                      class="w-10 h-10 object-contain"
                    >
                  @endforeach
                @else
                  @foreach($project->tools as $tool)
                    <img
                      src="{{ asset($tool->logo) }}"
                      alt="{{ $tool->name }} logo"
                      title="{{ $tool->name }}"
                      class="w-10 h-10 object-contain"
                    >
                  @endforeach
                @endif
              </div>

              {{-- Tags --}}
              <div class="flex flex-wrap gap-2 mb-6">
                @if($useStatic)
                  @foreach($project['tags'] as $tag)
                    @php
                      $base = $tag['color_hex'];
                      $bg   = Str::of($base)->replace('#','')->prepend('#')->__toString() . '33';
                    @endphp
                    <span
                      class="px-3 py-1 rounded-full text-xs font-medium"
                      style="background-color: {{ $bg }}; color: {{ $base }};">
                      {{ $tag['name'] }}
                    </span>
                  @endforeach
                @else
                  @foreach($project->tags as $tag)
                    @php
                      $base = $tag->color_hex;
                      $bg   = $base . '33';
                    @endphp
                    <span
                      class="px-3 py-1 rounded-full text-xs font-medium"
                      style="background-color: {{ $bg }}; color: {{ $base }};">
                      {{ $tag->name }}
                    </span>
                  @endforeach
                @endif
              </div>

              {{-- View button --}}
              <a
                href="{{ $useStatic ? $project['link'] : $project->link }}"
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
