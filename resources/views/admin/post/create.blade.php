<x-admin-layout>
  <style>
    /* Change the appearence of the search input field */
    .select2-search input {
      border-radius: 0.5rem;
      border-width: 0px !important;
      outline: none;
      border-color: #D1D5DB !important;
      width: 100% !important;
      color: #111827 !important;
      width: 100% !important;
      background-color: #F9FAFB !important;
    }

    /* Change the appearence of the search results container */
    .select2-results {
      border-radius: 0.5rem;
      border-width: 1px;
      border-color: #D1D5DB;
      background-color: #F9FAFB !important;
    }

    /* Change the appearence of the dropdown select container */
    .select2-container--default .select2-selection {
      border-radius: 0.5rem;
      border-width: 0px;
      border-color: #D1D5DB !important;
      color: #111827 !important;
      background-color: #F9FAFB !important;
    }

    /* Change the caret down arrow symbol to white */
    .select2-container--default .select2-selection--single {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") !important;
    }

    /* Change the color of the default selected item i.e. the first option */
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      background-color: #F9FAFB !important;
      border-radius: 0.5rem;
      width: 100% !important;
      border-width: 1px;
      border-color: #D1D5DB;
      color: #111827 !important;
    }
  </style>

  <section class="bg-white mx-auto   max-w-2xl dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <div class="flex justify-between">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a Post</h2>
        <div class="flex gap-4 justify-center">
          {{-- <x-modal-form :name="'Tag'" :id="'name'" :route="'admin.tag.store'" /> --}}
          <x-modal-form :name="'Category'" :id="'name'" :route="'admin.category.store'" />

        </div>
      </div>
      <form action="{{ route('post.store') }} " method="POST" novalidate enctype="multipart/form-data">
        @csrf
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
            <input type="text" name="title" id="title" placeholder="Type Title" value="{{ old('title') }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            @error('title')
              <p style= "color: red"> {{ $message }} </p>
            @enderror
          </div>
          {{-- @php
            $fields = [['id' => 'category_id', 'type' => 'number'], ['id' => 'user_id', 'type' => 'number']];
          @endphp
          @foreach ($fields as $field)
            <div class="w-full">
              <label for="{{ $field['id'] }}"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst($field['id']) }}</label>
              <input type="{{ $field['type'] }}" name="{{ $field['id'] }}" id="{{ $field['id'] }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="{{ ucfirst($field['id']) }}" value="{{ old($field['id']) }}" required="">
              @error($field['id'])
                <p style="color: red">{{ $message }}</p>
              @enderror
            </div>
          @endforeach --}}

          <select name="category_id" placeholder="Select Category" class="categories-selection js-states form-control">
            <option value="" disabled selected>Select Category</option>
          </select>

          <select name="tag_id[]" multiple class="tags-selection form-control">
          </select>
          <div {{-- class="sm:col-span-2" --}}>
            <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
              Enter Your Post</label>
            <textarea id="body" rows="8" name="body" placeholder="Your post here"
              class="form-control block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">{{ old('body') }}</textarea>
          </div>
          <div class="flex items-center justify-center w-full">
            <label for="image"
              class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
              <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-8 h-8 my-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                </svg>
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                  <span class="font-semibold">Click to upload</span> or drag and drop
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.800x400px)</p>
                <img src="" hidden
                  alt=""class="w-16 h-16 rounded-lg my-4 text-gray-500 dark:text-gray-400" id="blahvvv">
              </div>
              <input id="image" onchange="readURL(this,'blahvvv');" name="image" type="file" class="hidden" />
            </label>
          </div>
        </div>
        <button
          type="submit"class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-blue-800">Add
          Post</button>
        <a class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-blue-800"
          href="{{ route('post.index') }}">Show Posts</a>

      </form>
      <pre class="pre-categories-data" hidden>{{ $categories }}</pre>
      <pre class="pre-tags-data" hidden>{{ $tags }}</pre>
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
            const imageElement = document.getElementById(id); // Assuming your image element has this ID
            imageElement.src = event.target.result;
            imageElement.hidden = false;
          };;
          reader.readAsDataURL(input.files[0]);
        }
      }
    </script>
  </section>
</x-admin-layout>
