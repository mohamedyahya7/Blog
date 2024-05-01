   <div class="flex flex-col justify-center items-center p-6 border-spacing-10 border rounded-lg border-gray-200 ">

     <h3 class="text-xl font-bold mb-3">Categories</h3>
     <div
       class="w-48 text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
       @php
         $categoriesArr = [];
         foreach ($categories as $cat) {
             if ($cat->posts_count) {
                 array_push($categoriesArr, $cat);
             }
       } @endphp
       @foreach ($categoriesArr as $category)
         <a href="{{ route('ui.category', $category) }}">
           <button type="button"
             class="@if ($loop->first) rounded-t-lg @endif @if ($loop->last) rounded-b-lg @endif
              gap-3 relative inline-flex items-center w-full px-4 py-2 text-sm font-medium border-b  hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white ">
             <span
               class="bg-blue-100
                text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900
                dark:text-blue-300">{{ $category->posts_count }}
             </span>
             <p>{{ $category->name }}</p>
           </button></a>
       @endforeach
     </div>
   </div>
