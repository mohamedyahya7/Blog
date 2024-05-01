<x-admin-layout :categories="$categories">
  <div class="flex gap-8 justify-end  align-middle flex-wrap">
    @foreach ($categories as $category)
      <x-category-card :name="$category->name" :body="$category->description" :bg="$category->image" :route="route('ui.category', ['category' => $category])" />
      {{--@if ($category->posts_count)
      @endif --}}
    @endforeach
  </div>
</x-admin-layout>
