@props(['name', 'bg', 'route', 'body'])
@php
  $bg = $bg??"";
@endphp
<a href="{{ $route }}" style="background-image: url({{ Storage::url($bg) }})"
  class=" bg-center bg-no-repeat bg-blend-multiply bg-gray-600 dark:bg-gray-800 hover:bg-gray-500 dark:hover:bg-gray-700  bg-cover my-4 max-w-sm p-6  border border-gray-200 rounded-lg shadow dark:border-gray-700 ">
  <h5 class="mb-4 text-4xl font-bold  tracking-tight drop-shadow-xl text-white  dark:text-white">{{ $name }}</h5>
  <p class="font-normal  text-xs  text-white dark:text-gray-400">{{ $body }}</p>
</a>
