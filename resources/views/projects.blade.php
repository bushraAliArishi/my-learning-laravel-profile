<x-layout title="Projects">
    <x-slot:heading>Projects</x-slot:heading>

  {{-- Hero Section --}}
<section
  class="pt-28 min-h-screen
         bg-gradient-to-b from-blue-50 to-white
         flex items-center justify-center text-center
         text-gray-900"
>    <div class="container mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold mb-12">Featured Projects</h2>
      <div class="grid md:grid-cols-2 gap-8 max-w-6xl mx-auto text-left">
        <div class="p-6 rounded-lg shadow bg-gray-50">
          <h3 class="text-xl font-semibold mb-2">Focus – Booking Management System</h3>
          <p class="mb-2">A backend system for photographers and editors, built with Java and Spring Boot.</p>
          <ul class="list-disc pl-5 text-sm text-gray-600 space-y-1">
            <li>Booking logic</li>
            <li>Role-based access</li>
            <li>API testing</li>
          </ul>
        </div>
        <div class="p-6 rounded-lg shadow bg-gray-50">
          <h3 class="text-xl font-semibold mb-2">Bani – Equipment Marketplace</h3>
          <p class="mb-2">A no-code rental platform for heavy equipment, built with Bubble.</p>
          <ul class="list-disc pl-5 text-sm text-gray-600 space-y-1">
            <li>Login system</li>
            <li>Payment flow</li>
            <li>Team leadership</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</x-layout>