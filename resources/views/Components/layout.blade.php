<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $title ?? 'Page' }}</title>
  <style> html { scroll-behavior: smooth; } </style>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-slate-200 via-white to-white">

  <nav id="navbar" class="fixed top-0 w-full z-50 bg-white/50 backdrop-blur-lg border-b border-transparent transition-all duration-300">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <h1 class="text-xl font-bold text-gray-900">Bushra Ali Arishi</h1>
      <button id="burger" class="md:hidden text-gray-700">
        ☰
      </button>
      <div id="links-desktop" class="hidden md:flex gap-6">
        <x-nav-link href="/" >Home</x-nav-link>
        <x-nav-link href="/about-us" >About Us</x-nav-link>
        <x-nav-link href="/contact" >Contact Us</x-nav-link>
        <x-nav-link href="/#about" >About me</x-nav-link>
        <x-nav-link href="/#projects" >Projects</x-nav-link>
        <x-nav-link href="/#experience" >Experience</x-nav-link>
        <x-nav-link href="/#contact" >Contact</x-nav-link>
      </div>
    </div>
    {{-- if ( : ) rpefix a name the value become boolian --}}
    <div id="links-mobile" class="md:hidden hidden flex-col gap-3 px-6 pb-4 bg-white shadow-md border-t border-gray-200">
      <x-nav-link href="/">Home</x-nav-link>
      <x-nav-link href="/about-us" >About Us</x-nav-link>
      <x-nav-link href="/contact" >Contact Us</x-nav-link>
      <x-nav-link href="#about" >About me</x-nav-link>
      <x-nav-link href="#projects" >Projects</x-nav-link>
      <x-nav-link href="#experience" >Experience</x-nav-link>
      <x-nav-link href="#contact" >Contact</x-nav-link>
    </div>
  </nav>
  <header class="bg-white shadow">
      <div class="flex flex-col p-6 bg-gray-100 space-y-4 pt-15">

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl front-bold tracking-tight text-gray-900">{{ $heading }} </h1>
    </div>
</div>
  </header>

  {{ $slot }}

  <script>
    const nav = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        nav.classList.remove('bg-white/50','backdrop-blur-lg','border-transparent');
        nav.classList.add('bg-white','shadow-md','border-gray-200');
      } else {
        nav.classList.add('bg-white/50','backdrop-blur-lg','border-transparent');
        nav.classList.remove('bg-white','shadow-md','border-gray-200');
      }
    });

    document.getElementById('burger').addEventListener('click', () => {
      document.getElementById('links-mobile').classList.toggle('hidden');
    });

    // const sections = document.querySelectorAll('section[id]');
    // const links   = document.querySelectorAll('.nav-link');

    // const observer = new IntersectionObserver((entries) => {
    //   entries.forEach(entry => {
    //     if (entry.isIntersecting) {
    //       links.forEach(a => a.classList.remove('border-b-4','border-gray-800','font-semibold'));
    //       const id = entry.target.id;
    //       const link = document.querySelector(`.nav-link[href="#${id}"], .nav-link[href="/#${id}"]`);
    //       if (link) link.classList.add('border-b-4','border-gray-800','font-semibold');
    //     }
    //   });
    // }, {
    //   rootMargin: '-50% 0px -50% 0px'
    // });

    // sections.forEach(sec => observer.observe(sec));

    // window.addEventListener('scroll', () => {
    //   if (window.scrollY < 100) {
    //     links.forEach(a => a.classList.remove('border-b-4','border-gray-800','font-semibold'));
    //     document.querySelector(`.nav-link[href="/"]`)?.classList.add('border-b-4','border-gray-800','font-semibold');
    //   }
    // });
  </script>
</body>
</html>
