@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center py-4">
  <span class="flex items-center space-x-2">

    {{-- Previous Arrow --}}
      @if ($paginator->onFirstPage())
          <span
              class="w-10 h-10 inline-flex items-center justify-center text-gray-400 bg-white
               border border-gray-300 rounded-full cursor-default"
              aria-disabled="true"
          >
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293
                   3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0
                   010-1.414l4-4a1 1 0 011.414 0z"
                clip-rule="evenodd"/>
        </svg>
      </span>
      @else
          <a
              href="{{ $paginator->previousPageUrl() }}"
              rel="prev"
              class="w-10 h-10 inline-flex items-center justify-center text-gray-600 bg-white
               border border-gray-300 rounded-full hover:text-gray-800 hover:bg-gray-50
               focus:outline-none focus:ring focus:ring-blue-300"
              aria-label="{{ __('pagination.previous') }}"
          >
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293
                   3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0
                   010-1.414l4-4a1 1 0 011.414 0z"
                clip-rule="evenodd"/>
        </svg>
      </a>
      @endif

      {{-- Page Numbers --}}
      @foreach ($elements as $element)
          {{-- "Three Dots" --}}
          @if (is_string($element))
              <span class="w-10 h-10 inline-flex items-center justify-center text-gray-500 bg-white
                     border border-gray-300 rounded-full cursor-default">
          {{ $element }}
        </span>
          @endif

          {{-- Array Of Links --}}
          @if (is_array($element))
              @foreach ($element as $page => $url)
                  @if ($page == $paginator->currentPage())
                      <span
                          class="w-10 h-10 inline-flex items-center justify-center
                     bg-blue-600 text-white font-bold border border-blue-600 rounded-full"
                          aria-current="page"
                      >
              {{ $page }}
            </span>
                  @else
                      <a
                          href="{{ $url }}"
                          class="w-10 h-10 inline-flex items-center justify-center text-gray-700 bg-white
                     border border-gray-300 rounded-full hover:bg-gray-50 hover:text-gray-800
                     focus:outline-none focus:ring focus:ring-blue-300"
                          aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                      >
              {{ $page }}
            </a>
                  @endif
              @endforeach
          @endif
      @endforeach

      {{-- Next Arrow --}}
      @if ($paginator->hasMorePages())
          <a
              href="{{ $paginator->nextPageUrl() }}"
              rel="next"
              class="w-10 h-10 inline-flex items-center justify-center text-gray-600 bg-white
               border border-gray-300 rounded-full hover:text-gray-800 hover:bg-gray-50
               focus:outline-none focus:ring focus:ring-blue-300"
              aria-label="{{ __('pagination.next') }}"
          >
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586
                   10 7.293 6.707a1 1 0 011.414-1.414l4 4a1
                   1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"/>
        </svg>
      </a>
      @else
          <span
              class="w-10 h-10 inline-flex items-center justify-center text-gray-400 bg-white
               border border-gray-300 rounded-full cursor-default"
              aria-disabled="true"
          >
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586
                   10 7.293 6.707a1 1 0 011.414-1.414l4 4a1
                   1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"/>
        </svg>
      </span>
      @endif

  </span>
    </nav>
@endif
