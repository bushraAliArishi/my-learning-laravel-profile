<x-layout :title="$title">
  <x-slot name="heading">{{ $heading }}</x-slot>

  <form
    x-data="{
      slug:       '{{ old('slug', $exp->slug) }}',
      title:      '{{ old('title', $exp->title) }}',
      company:    '{{ old('company', $exp->company) }}',
      period:     '{{ old('period', $exp->period) }}',
      details:    '{{ old('details', $exp->details) }}',
      start_date: '{{ old('start_date', $exp->start_date) }}',
      end_date:   '{{ old('end_date', $exp->end_date) }}',
      tools:      {{ json_encode(old('tools', $exp->tools->pluck('id')->all())) }},
      dropdownTools: false,
      showToolForm: false,
      resetForm() {
        this.tools = {{ json_encode($exp->tools->pluck('id')->all()) }};
      },
      toggle(arr,id) {
        id = +id;
        const i = arr.indexOf(id);
        if (i > -1) arr.splice(i,1);
        else        arr.push(id);
      }
    }"
    @click.away="dropdownTools = false"
    method="POST"
    action="{{ route('experience.update', $exp->slug) }}"
    class="w-4/5 mx-auto mt-24 mb-16 space-y-12"
  >
    @csrf
    @method('PUT')

    {{-- Now copy **exactly** the same inner markup from the create form above,
         and Alpine will prefill everything from the x-data defaults. --}}
    {{-- (Experience Details section…) --}}
    {{-- (Tools dropdown section…) --}}
    {{-- (Actions buttons…) --}}

  </form>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('tools', @json($allTools));
    });
  </script>
</x-layout>
