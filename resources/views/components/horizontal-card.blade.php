@props(['title', 'route', 'image', 'body'])
<a href="{{ $route }}"
  class="flex flex-col my-7 h-48 items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-screen-md hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
  <img class=" w-full rounded-t-lg h-52 object-cover md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
    src="{{ $image }}" alt="{{ $title }} ">
  <div class="flex flex-col justify-between p-4 leading-normal">
    <h5 class="mb-2 max-w-xl text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $title }}</h5>
    <p class="mb-3 font-normal max-w-xl h-24 overflow-hidden text-gray-700 dark:text-gray-400">{{ $body }}</p>
  </div>
</a>





<a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="{{ $image }}" alt="">
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
    </div>
</a>
