<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $title ?? 'Page' }}</title>

  {{-- Tailwind CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  {{-- Alpine.js --}}
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <style>
    html { scroll-behavior: smooth; }
    /* تمت إزالة الخلفية هنا */

</style>
</head>
<body
  x-data
  class="relative bg-gradient-to-b from-slate-200 via-white to-white overflow-x-hidden"
>
  {{-- navbar --}}
  <nav
    id="navbar"
    class="fixed top-0 w-full z-50 bg-white/50 backdrop-blur-lg border-b border-transparent transition-all duration-300"
  >
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold text-gray-900">Bushra Ali Arishi</h1>
      <button id="burger" class="md:hidden text-gray-700">☰</button>
      <div id="links-desktop" class="hidden md:flex gap-6">
        <x-nav-link href="/"           :active="request()->is('/')">Home</x-nav-link>
        <x-nav-link href="/about-us"   :active="request()->is('about-us')">About</x-nav-link>
        <x-nav-link href="/projects"   :active="request()->is('projects')">Projects</x-nav-link>
        <x-nav-link href="/experience" :active="request()->is('experience')">Experience</x-nav-link>
        <x-nav-link type="button" variant="dark" @click="location = '{{ url('/contact') }}'">
          Contact
        </x-nav-link>
      </div>
    </div>
    <div id="links-mobile" class="md:hidden hidden flex-col gap-3 px-6 pb-4 bg-white shadow-md border-t border-gray-200">
      <x-nav-link href="/"           :active="request()->is('/')">Home</x-nav-link>
      <x-nav-link href="/about-us"   :active="request()->is('about-us')">About</x-nav-link>
      <x-nav-link href="/projects"   :active="request()->is('projects')">Projects</x-nav-link>
      <x-nav-link href="/experience" :active="request()->is('experience')">Experience</x-nav-link>
      <x-nav-link href="/contact"    :active="request()->is('contact')">Contact</x-nav-link>
    </div>
  </nav>

  {{-- page content --}}
  <div class="relative z-10">
    {{ $slot }}
  </div>

  {{-- scroll behavior script --}}
  <script>
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
    document.getElementById('burger').addEventListener('click', () => {
      document.getElementById('links-mobile').classList.toggle('hidden');
    });
  </script>
</body>
</html>
