<x-admin-layout>
  <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
    <form action="{{ route('post.update', ['post' => $post]) }} " method="POST" novalidate enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div>
        @if ($errors->any())
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }} </li>
            @endforeach
          </ul>
        @endif
      </div>

      <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
        <div class="col-span-2">
          <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Post Title</label>
          <input type="text" name="title" id="title" placeholder="Type Title" value="{{ $post->title }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
          @error('title')
            <p style= "color: red"> {{ $message }} </p>
          @enderror
        </div>
        <select name="category_id" placeholder="Select Category" class="categories-selection js-states form-control">
          <option value="{{ $post->category->id }}" selected>{{ $post->category->name }}</option>
        </select>
        <pre class="pre-categories-data" hidden>{{ $categories }}</pre>
        <pre class="pre-tags-data" hidden>{{ $tags }}</pre>
        <select name="tag_id[]" multiple class="tags-selection form-control">
          @foreach ($post->tags as $tag)
            <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
          @endforeach
        </select>
        <div {{-- class="sm:col-span-2" --}}>
          <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Ed Your Post</label>
          <textarea id="body" rows="8" name="body" placeholder="Your post here"
            class="form-control block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">{{ $post->body }}</textarea>
        </div>
        <div class="flex items-center justify-center w-full">
          <label for="image"
            class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <img src="{{ Storage::url($post->image) }}"
              alt=""class="w-full h-full rounded-lg my-4 text-gray-500 dark:text-gray-400" id="blahvvv">
            <p class="mb-2 text-sm text-white shadow-sm shadow-black dark:text-gray-400 absolute"> Click To Upload Image
            </p>
            <input id="image" onchange="readURL(this,'blahvvv');" name="image" type="file" class="hidden" />
          </label>
        </div>
      </div>
      <button type="submit"
        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-blue-800">
        Save Post</button>

    </form>
  </div>
  <script>
    $(document).ready(function() {
      const categories_data = JSON.parse($('.pre-categories-data').text());
      const tags_data = JSON.parse($('.pre-tags-data').text());
      $('.tags-selection').select2({
        data: tags_data,
        tags: true,
        placeholder: "Select tags",
        allowClear: true,
        tokenSeparators: [','],
      });
      $('.categories-selection').select2({
        data: categories_data,
      });
    });

    function readURL(input, id) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
          const imageElement = document.getElementById(id);
          imageElement.src = event.target.result;
          imageElement.hidden = false;
        };;
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>

</x-admin-layout>
