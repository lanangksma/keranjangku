<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row bg-white dark:bg-gray-800 shadow-lg rounded-md overflow-hidden">
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg" src="{{ $product['image'] }}" alt="{{ $product['title'] }}">
                    </div>
                </div>

                <div class="p-5 md:w-1/2 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight mb-2">{{ $product['title'] }}</h3>
                        <div class="mb-2">
                            <span class="bg-blue-500 text-white px-2 py-1 rounded-md text-sm font-medium">{{ $product['category'] }}</span>
                        </div>
                        <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">{{ $product['description'] }}</p>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">Rp&nbsp;{{ $product['price'] }}</span>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-md text-sm font-medium transition duration-300">Buy now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
