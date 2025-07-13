{{-- resources/views/experience/create.blade.php --}}
<x-layout :title="$title">
  <x-slot name="heading">{{ $heading }}</x-slot>

  <form action="{{ route('experience.store') }}" method="POST" class="max-w-xl mx-auto space-y-6">
    @csrf

    {{-- Slug --}}
    <div>
      <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
      <input type="text" name="slug" id="slug"
             value="{{ old('slug') }}"
             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
             required>
      @error('slug') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Title --}}
    <div>
      <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
      <input type="text" name="title" id="title"
             value="{{ old('title') }}"
             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
             required>
      @error('title') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Company --}}
    <div>
      <label for="company" class="block text-sm font-medium text-gray-700">Company</label>
      <input type="text" name="company" id="company"
             value="{{ old('company') }}"
             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
             required>
      @error('company') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Period --}}
    <div>
      <label for="period" class="block text-sm font-medium text-gray-700">Period</label>
      <input type="text" name="period" id="period"
             value="{{ old('period') }}"
             placeholder="e.g. Jan 2022 – Dec 2022"
             class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
             required>
      @error('period') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Details --}}
    <div>
      <label for="details" class="block text-sm font-medium text-gray-700">Details</label>
      <textarea name="details" id="details" rows="4"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                required>{{ old('details') }}</textarea>
      @error('details') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Start / End Dates (optional) --}}
    <div class="grid grid-cols-2 gap-4">
      <div>
        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
        <input type="date" name="start_date" id="start_date"
               value="{{ old('start_date') }}"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('start_date') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
        <input type="date" name="end_date" id="end_date"
               value="{{ old('end_date') }}"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @error('end_date') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      </div>
    </div>

    {{-- Tools multiselect --}}
    <div>
      <label for="tools" class="block text-sm font-medium text-gray-700">Tools</label>
      <select name="tools[]" id="tools" multiple
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        @foreach($allTools as $tool)
          <option value="{{ $tool->id }}"
            {{ (collect(old('tools'))->contains($tool->id)) ? 'selected' : '' }}>
            {{ $tool->name }}
          </option>
        @endforeach
      </select>
      @error('tools') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Submit --}}
    <div class="pt-4">
      <button type="submit"
              class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
        Add Experience
      </button>
    </div>
  </form>
</x-layout>
