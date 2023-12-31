<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Homepage') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form action="{{ route('search') }}" method="GET">
                <div class="flex space-x-3">
                    <input type="text" placeholder="Search..." name="search"
                           class="border border-gray-300 rounded-md py-3 px-2 w-full duration-300 ease-in-out">
                    @if(isset($selectedCategory))
                        <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    @endif
                    <button
                        class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-md px-4 py-3 text-sm font-medium duration-300 ease-in-out">
                        Search
                    </button>
                </div>
            </form>

            {{-- Swipper --}}
            <div class="bg-white dark:bg-gray-800 shadow swiper">
                <div class="swiper-wrapper">
                    <img src="https://source.unsplash.com/category/shoes/960x240" alt=""
                         class="sm:rounded-lg swiper-slide" data-swiper-autoplay="6000">
                    <img src="https://source.unsplash.com/category/bag/960x240" alt=""
                         class="sm:rounded-lg swiper-slide" data-swiper-autoplay="6000">
                    <img src="https://source.unsplash.com/category/fashion/960x240" alt=""
                         class="sm:rounded-lg swiper-slide" data-swiper-autoplay="6000">
                    <img src="https://source.unsplash.com/category/shirt/960x240" alt=""
                         class="sm:rounded-lg swiper-slide" data-swiper-autoplay="6000">
                </div>
            </div>
            {{-- End Swipper --}}

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    {{-- Categories --}}
                    <div class="flex space-x-3 justify-between">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('Our Markets') }}
                        </h2>

                        <div class="flex space-x-3">
                            @foreach($categoriesDB as $category)
                                <a href=""
                                   class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 duration-300 ease-in-out px-5 py-1.5 rounded-md text-sm font-medium"
                                   aria-current="page">{{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    {{-- End Categories --}}
                    {{-- Products --}}
                    <div class="pt-4 flex items-center gap-6">
                        @if($productsDB->isEmpty())
                            <p class="text-center text-xl text-gray-500">
                                <span class="block uppercase font-bold">
                                    "{{ request()->input('search') }}" not found here
                                </span>
                            </p>
                        @else
                            @foreach ($productsDB as $product)
                                <a href="{{ route('products.show', ['id' => $product['id']]) }}"
                                   class="block hover:no-underline hover:scale-100">
                                    <x-product.card-list>
                                        <x-slot name="img">
                                            <!-- Tambahkan tag img untuk menampilkan gambar -->
                                            @if (Storage::disk('public')->exists($product->image))
                                                @if (getimagesize(storage_path('app/public/' . $product->image)))
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                         alt="{{ $product->title }}"
                                                         class="w-full h-56 object-cover">
                                                @else
                                                    <img src="{{ $product->image_link }}"
                                                         alt="{{ $product->title }}"
                                                         class="w-full h-56 object-cover">
                                                @endif
                                            @else
                                                <img src="https://via.placeholder.com/150" alt="Placeholder"
                                                     class="w-full h-56 object-cover">
                                            @endif
                                        </x-slot>
                                        <x-slot name="productTitle">{{ $product['title'] }}</x-slot>
                                        <x-slot name="productDesc">{{ $product['description'] }}</x-slot>
                                        <x-slot name="productPrice">Rp. {{ $product['price'] }}</x-slot>
                                    </x-product.card-list>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            {{-- End Products --}}

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    {{-- Categories --}}
                    <div class="flex space-x-3 justify-between">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('Other Markets') }}
                        </h2>
                        <div class="flex space-x-3">
                            @foreach($categories as $category)
                                <a href="{{ route('search', ['category' => $category]) }}"
                                   class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 duration-300 ease-in-out px-5 py-1.5 rounded-md text-sm font-medium"
                                   aria-current="page">{{ $category }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    {{-- End Categories --}}

                    {{-- Products --}}
                    <div
                        class="pt-5 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 items-center gap-6 overflow-visible">
                        @if(count($products) == 0)
                            <p class="text-center text-xl text-gray-500">
                                <span class="block uppercase font-bold">
                                    "{{ request()->input('search') }}" not found here
                                </span>
                            </p>
                        @else
                            @foreach ($products as $product)
                                <a href="{{ route('products.show', ['id' => $product['id']]) }}"
                                   class="block hover:no-underline hover:scale-100">

                                    <x-product.card-list>
                                        <x-slot name="img">
                                            <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}"
                                                 class="w-full h-56 object-cover">
                                        </x-slot>
                                        <x-slot name="productTitle">{{ $product['title'] }}</x-slot>
                                        <x-slot name="productDesc">{{ $product['description'] }}</x-slot>
                                        <x-slot name="productPrice">Rp. {{ $product['price'] }}</x-slot>
                                    </x-product.card-list>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>


        </div>


    </div>
</x-app-layout>
