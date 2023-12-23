<div class="bg-white text-gray-700 w-full sm:w-72 min-h-[10rem] shadow-lg rounded-md overflow-hidden dark:bg-gray-700 xl:scale-95">
    <img class="w-full h-56 object-cover" src="{{ $img }}" alt="{{ $imgalt }}">
    <div class="p-5 flex flex-col gap-3">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 leading-tight truncate">{{ $productTitle }}</h3>
        <p class="text-sm overflow-hidden overflow-ellipsis whitespace-nowrap text-gray-800 dark:text-gray-200">{{ $productDesc }}</p>
        <div class="flex justify-between items-center">
            <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $productPrice }}0</span>
            <button class="bg-gray-200 text-gray-700 px-3 py-1.5 rounded-md text-sm font-medium">Add to cart</button>
        </div>
    </div>
</div>
