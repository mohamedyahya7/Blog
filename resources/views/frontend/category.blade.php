<x-admin-layout >
  {{-- <pre>{{ $category }}</pre>
  --}}
  <div class="flex flex-col w-full items-center lg:items-end justify-center">
    <div class="flex  justify-center items-center mb-10 mx-auto">
      <x-category-card :name="$category->name" route="#" :body="$category->description" />
    </div>
    <div  class="grid justify-items-end  grid-cols-1 md:grid-cols-2  gap-12">
      @foreach ($posts as $post)
        <x-post-card route="#" :body="$post->body" :image="Storage::url($post->image)" :title="$post->title" />
      @endforeach
    </div>
  </div>
<x-trandy-blog />
  {{--<pre >{{ $posts }}</pre>--}}
</x-admin-layout>
