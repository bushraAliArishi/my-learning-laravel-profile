@php use Carbon\Carbon; @endphp
{{-- resources/views/experience/index.blade.php --}}
<x-layout title="{{ $title }}">
    <x-slot name="heading">{{ $heading }}</x-slot>

    <section class="mt-24 py-16 bg-gray-50 dark:bg-gray-900">
        <div class="mx-auto max-w-4xl px-6 space-y-8">

            @foreach($experiences as $exp)
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 flex flex-col sm:flex-row sm:justify-between sm:items-start">

                    {{-- LEFT: Details --}}
                    <div class="sm:flex-1">
                        <h3 class="text-2xl font-semibold text-blue-600 dark:text-blue-400">
                            {{ $exp->title }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ $exp->company }} •
                            {{ Carbon::parse($exp->start_date)->format('M Y') }}
                            – {{ $exp->end_date
                     ? Carbon::parse($exp->end_date)->format('M Y')
                     : 'Present' }}
                        </p>
                        <p class="mt-4 text-gray-700 dark:text-gray-300">
                            {{ Str::limit($exp->details, 200) }}
                        </p>
                    </div>

                    {{-- RIGHT: Actions --}}
                    <div class="mt-6 sm:mt-0 sm:ml-6 flex gap-4">
                        <a
                            href="{{ route('experience.show', $exp->id) }}"
                            @class([
                              'w-full' => !auth()->check() || auth()->user()->role !== 'admin',
                              'block' => true
                            ])
                        >
                            <x-button
                                variant="gradient"
                                size="lg"
                                class="w-full"
                            >
                                View
                            </x-button>
                        </a>

                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a
                                href="{{ route('experience.edit', $exp->id) }}"
                                class="block"
                            >
                                <x-button
                                    variant="secondary"
                                    size="lg"
                                    class="w-full"
                                >
                                    Edit
                                </x-button>
                            </a>
                        @endif
                    </div>

                </div>
            @endforeach

            {{-- Pagination --}}
            <div class="pt-8">
                {{ $experiences->links() }}
            </div>
        </div>
    </section>
</x-layout>
