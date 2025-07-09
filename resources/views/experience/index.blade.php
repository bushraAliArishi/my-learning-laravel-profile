<x-layout :title="$title">
  <x-slot name="heading">{{ $heading }}</x-slot>

  <section class="pt-32 pb-16 bg-gray-100 text-gray-800">
    <div class="container mx-auto px-6">
      <h2 class="text-4xl font-bold text-center mb-12">Professional Experience Timeline</h2>

      <div class="relative max-w-2xl mx-auto">
        <div class="absolute top-0 bottom-0 left-1/2 transform -translate-x-1 w-1 bg-gray-300 rounded"></div>

        {{-- نستخدم هنا المتغيّر experiences بدل experience --}}
        @foreach($experiences as $exp)
          <div class="relative mb-16 flex items-start">
            <div class="w-full bg-white rounded-lg shadow-lg p-6  
                        @if($loop->iteration % 2 === 0)  
                          ml-50   {{-- بطاقات زوجية يمين الخط --}}
                        @else  
                          mr-50   {{-- بطاقات فردية يسار الخط --}}
                        @endif">
              <div class="flex justify-between items-start">
                <div>
                  {{-- نستعمل object syntax --}}
                  <h3 class="text-2xl font-semibold mb-1">{{ $exp->title }}</h3>
                  <p class="text-sm text-gray-500 mb-2">
                    {{ $exp->company }} &bull; {{ $exp->period }}
                  </p>
                </div>
                <a href="{{ url('/experience/'.$exp->slug) }}"
                   class="text-gray-400 hover:text-blue-600 transition transform hover:translate-x-1">
                  <svg xmlns="http://www.w3.org/2000/svg"
                       class="w-6 h-6"
                       fill="none" viewBox="0 0 24 24"
                       stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 5l7 7-7 7" />
                  </svg>
                </a>
              </div>

              {{-- تفاصيل (details) لوثيقة واحدة، ممكن تعرضينها هنا --}}
              <ul class="list-disc pl-5 text-gray-700 mt-4 space-y-1">
                <li>{{ $exp->details }}</li>
              </ul>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </section>
</x-layout>
