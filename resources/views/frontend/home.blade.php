<x-admin-layout >
  <div class="flex flex-col w-full items-center lg:items-end justify-center">
    <div  class="grid justify-items-end  grid-cols-1 md:grid-cols-2  gap-12">
      @foreach ($posts as $post)
        <x-post-card route="#" :body="$post->body" :image="Storage::url($post->image)" :title="$post->title" />
      @endforeach
    </div>
  </div>
</x-admin-layout>