<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $title ?? 'Page' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style> html { scroll-behavior: smooth; } </style>
</head>
<body
  x-data
  class="relative bg-gradient-to-b from-slate-200 via-white to-white overflow-x-hidden"
>
  {{-- NAVBAR --}}
  <nav
    id="navbar"
    class="fixed top-0 w-full z-50 bg-white/50 backdrop-blur-lg border-b border-transparent transition-all duration-300"
  >
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold text-gray-900">Bushra Ali Arishi</h1>

      <button id="burger" class="md:hidden text-gray-700">☰</button>

      <div id="links-desktop" class="hidden md:flex gap-6 items-center">
        <x-nav-link href="/"           :active="request()->is('/')">Home</x-nav-link>
        <x-nav-link href="/projects"   :active="request()->is('projects*')">Projects</x-nav-link>
        <x-nav-link href="/experience" :active="request()->is('experience*')">Experience</x-nav-link>

        @guest
          {{-- Login Link --}}
          <a
            href="{{ route('login') }}"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition"
          >Login</a>

          {{-- Register Link --}}
          <a
            href="{{ route('register') }}"
            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition"
          >Register</a>
        @else
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button
              type="submit"
              class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg transition"
            >
              Logout
            </button>
          </form>
        @endguest
      </div>
    </div>

    {{-- Mobile menu --}}
    <div id="links-mobile" class="md:hidden hidden flex-col gap-3 px-6 pb-4 bg-white shadow-md border-t border-gray-200">
      <x-nav-link href="/"           :active="request()->is('/')">Home</x-nav-link>
      <x-nav-link href="/projects"   :active="request()->is('projects*')">Projects</x-nav-link>
      <x-nav-link href="/experience" :active="request()->is('experience*')">Experience</x-nav-link>

      @guest
        <a
          href="{{ route('login') }}"
          class="block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-center"
        >Login</a>
        <a
          href="{{ route('register') }}"
          class="block mt-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg text-center"
        >Register</a>
      @else
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button
            type="submit"
            class="w-full text-left px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg"
          >
            Logout
          </button>
        </form>
      @endguest
    </div>
  </nav>

  {{-- PAGE HEADER (Projects & Experience index only) --}}
  @if((request()->routeIs('projects.index') || request()->routeIs('experience.index')) && auth()->check() && auth()->user()->role === 'admin')
    <header class="container mx-auto w-full pt-24 pb-12 bg-white rounded-lg relative">
      <div class="sm:flex sm:justify-between inset-0 p-6 gap-3 mx-auto">
        <h1 class="mt-2 text-4xl font-semibold text-gray-600">{{ $heading }}</h1>
        <x-nav-link
          type="button"
          :variant="request()->routeIs('projects.index') ? 'primary' : 'purple'"
          @click="location='{{ request()->routeIs('projects.index')
              ? url('/projects/create')
              : url('/experience/create') }}'"
        >
          <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Add {{ request()->routeIs('projects.index') ? 'Project' : 'Experience' }}
        </x-nav-link>
      </div>
    </header>
  @endif

  {{-- CONTENT --}}
  <div class="relative z-10">
    {{ $slot }}
  </div>

  <script>
    // Navbar scroll effect
    const nav = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        nav.classList.replace('bg-white/50','bg-white');
        nav.classList.replace('backdrop-blur-lg','shadow-md');
        nav.classList.replace('border-transparent','border-gray-200');
      } else {
        nav.classList.replace('bg-white','bg-white/50');
        nav.classList.replace('shadow-md','backdrop-blur-lg');
        nav.classList.replace('border-gray-200','border-transparent');
      }
    });

    // Mobile menu toggle
    document.getElementById('burger').addEventListener('click', () => {
      document.getElementById('links-mobile').classList.toggle('hidden');
    });
  </script>
</body>
</html>