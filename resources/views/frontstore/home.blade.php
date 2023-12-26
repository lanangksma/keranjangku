<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Homepage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

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
                            {{ __('Categories') }}
                        </h2>
                        <div class="flex space-x-3">
                            @foreach($categories as $category)
                                <a href=""
                                   class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 px-5 py-1.5 rounded-md text-sm font-medium"
                                   aria-current="page">{{ $category }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    {{-- End Categories --}}
                    {{-- Products --}}
                    <div class="pt-4 flex items-center gap-6">
                        Soon
                    </div>
                </div>
            </div>
            {{-- End Products --}}

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-full">
                    {{-- Categories --}}
                    <div class="flex space-x-3 justify-between">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('Categories') }}
                        </h2>
                        <div class="flex space-x-3">
                            <a href=""
                               class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 px-5 py-1.5 rounded-md text-sm font-medium"
                               aria-current="page">
                                All
                            </a>
                        </div>
                    </div>
                    {{-- End Categories --}}

                    {{-- Products --}}
                    <div
                        class="pt-5 grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 items-center gap-6 overflow-visible">
                        @foreach ($products as $product)

                                <x-product.card-list>
                                    <x-slot name="img">{{ $product['image'] }}</x-slot>
                                    <x-slot name="imgalt">{{ $product['title'] }}</x-slot>
                                    <x-slot name="productTitle">{{ $product['title'] }}</x-slot>
                                    <x-slot name="productDesc">{{ $product['description'] }}</x-slot>
                                    <x-slot name="productPrice">Rp. {{ $product['price'] }}</x-slot>
                                </x-product.card-list>

                        @endforeach
                    </div>
                </div>
            </div>


        </div>


    </div>
</x-app-layout>
