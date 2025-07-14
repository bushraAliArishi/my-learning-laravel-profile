<x-layout :title="$title">
  <x-slot name="heading">{{ $heading }}</x-slot>

  <form
    x-data="{
      title: '{{ old('title', $project->title) }}',
      link: '{{ old('link', $project->link) }}',
      description: `{{ old('description', $project->description) }}`,
      type: '{{ old('type', $project->type) }}',
      new_type: '{{ old('new_type') }}',
      tags: {{ json_encode(old('tags', $project->tags->pluck('id')->all())) }},
      tools: {{ json_encode(old('tools', $project->tools->pluck('id')->all())) }},
      dropdownTags: false,
      dropdownTools: false,

      filterTags() {
        this.dropdownTags = !this.dropdownTags;
      },
      filterTools() {
        this.dropdownTools = !this.dropdownTools;
      },
      toggle(arr,id) {
        id = +id;
        const idx = arr.indexOf(id);
        if (idx > -1) arr.splice(idx,1);
        else          arr.push(id);
      }
    }"
    @click.away="dropdownTags=false; dropdownTools=false"
    method="POST"
    action="{{ route('projects.update', $project->slug) }}"
    enctype="multipart/form-data"
    class="max-w-3xl mx-auto mt-16 space-y-12"
  >
    @csrf
    @method('PUT')

    {{-- -- identical form markup as "create", but binding to $project --}}
    {{-- Copy/paste the entire contents of create.blade.php’s <form> here, substituting --}}
    {{-- every old(...) binding with old(..., $project->field) and route/action names --}}
  </form>
</x-layout>
