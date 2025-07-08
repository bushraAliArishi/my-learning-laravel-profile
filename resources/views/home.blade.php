<x-layout title="{{ $title }}" >
        <x-slot:heading>{{ $heading }}</x-slot:heading>

  {{-- Hero Section --}}

<section
  class="pt-28 min-h-screen bg-gradient-to-b from-blue-50 to-white flex items-center justify-center text-center text-gray-900">    <div class="max-w-4xl mx-auto px-6 text-center">
      <div class="mb-8 animate-bounce">
        <div class="w-32 h-32 mx-auto bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 18l6-6-6-6M8 6l-6 6 6 6"/>
          </svg>
        </div>
      </div>

      <h1 class="text-5xl md:text-6xl font-bold mb-4">
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">Backend Developer</span><br />
        <span class="text-gray-300">& No-Code Specialist</span>
      </h1>

      <p class="text-lg md:text-xl text-gray-400 mb-8 max-w-3xl mx-auto leading-relaxed">
        Empowering internal operations with scalable backend systems, no-code automation, and smart IT administration.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
        <a href="#contact" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md">Get In Touch</a>
<a href="#projects" class="border border-gray-800 text-gray-800 py-2 px-6 rounded-md hover:bg-gray-800 hover:text-white">
  View Projects
</a>
      </div>

      <div class="flex justify-center gap-6 text-gray-400 text-sm">
        <div class="flex items-center gap-2">
          <svg class="w-4 h-4" fill="currentColor"><circle cx="12" cy="12" r="10"/></svg>
          Riyadh, Saudi Arabia
        </div>
        <div class="flex items-center gap-2">
          <svg class="w-4 h-4" fill="currentColor"><path d="M3 5h12M9 3v2m0 16v2m3-6h6m-3-3v6"/></svg>
          +966 530 577 725
        </div>
      </div>
    </div>
  </section>
  {{-- About Section --}}
<section
  class="pt-28 min-h-screen
         bg-gradient-to-b from-white to-blue-50
         flex items-center justify-center text-center
         text-gray-900"
>    <div class="container mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold mb-6">About Me</h2>
      <p class="max-w-3xl mx-auto text-lg leading-relaxed">
        I'm a backend developer and no-code specialist passionate about automating internal systems and delivering scalable solutions for digital platforms. I focus on backend logic, system design, and managing platforms like Google Workspace, Bubble, and more.
      </p>
    </div>
  </section>
  {{-- Contact Section --}}
  <section id="contact" class="py-16 bg-gradient-to-b from-blue-50 to-white text-gray-800">
    <div class="container mx-auto px-6 text-center max-w-2xl">
      <h2 class="text-4xl font-bold mb-6">Get In Touch</h2>
      <p class="text-lg text-gray-600 mb-8">Let’s discuss how I can help bring your project to life.</p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="mailto:bushra.ali.arishi@gmail.com" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Email Me</a>
        <a href="https://github.com/bushraAliArishi" target="_blank" class="border border-gray-800 text-gray-800 px-6 py-2 rounded-md hover:bg-gray-800 hover:text-white">GitHub</a>
      </div>
    </div>
  </section>
</x-layout>
