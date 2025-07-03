<!doctype html>
<html lang="en">
<head>
    <style>
  html {
    scroll-behavior: smooth;
  }
</style>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $title ?? 'Page' }}</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<script src="//unpkg.com/alpinejs" defer></script>

</head>
<body class="bg-gradient-to-b from-slate-200 via-white to-white">
<nav x-data="{ open: false }" class="fixed top-0 w-full z-50 backdrop-blur-lg bg-gray-100/80 border-b border-gray-200 shadow-sm">
  <div class="container mx-auto px-6 py-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-gray-900">Bushra Ali Arishi</h1>

    <button @click="open = !open" class="md:hidden text-gray-700 focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>

    <div class="hidden md:flex gap-6">
      <x-nav-link href="/">Home</x-nav-link>
      <x-nav-link href="/about-us">About Us</x-nav-link>
      <x-nav-link href="/contact">Contact Us</x-nav-link>
      <x-nav-link href="/#about">About me</x-nav-link>
      <x-nav-link href="/#projects">Projects</x-nav-link>
      <x-nav-link href="/#experience">Experience</x-nav-link>
      <x-nav-link href="/#contact">Contact</x-nav-link>
    </div>
  </div>

<div x-show="open" class="md:hidden px-6 pb-4 flex flex-col gap-3 bg-white border-t border-gray-200 shadow-md">

     <x-nav-link href="/" @click="open = false">Home</x-nav-link>
  <x-nav-link href="/about-us" @click="open = false">About Us</x-nav-link>
  <x-nav-link href="/contact" @click="open = false">Contact Us</x-nav-link>
  <x-nav-link href="/#about" @click="open = false">About me</x-nav-link>
  <x-nav-link href="/#projects" @click="open = false">Projects</x-nav-link>
  <x-nav-link href="/#experience" @click="open = false">Experience</x-nav-link>
  <x-nav-link href="/#contact" @click="open = false">Contact</x-nav-link>

  </div>
</nav>


  {{ $slot }}

</body>
</html>
