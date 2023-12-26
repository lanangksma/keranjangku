<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row bg-white dark:bg-gray-800 shadow-lg rounded-md overflow-hidden">
                <div class="md:w-1/2">
                    <img class="w-full h-auto md:h-96 object-cover" src="coba.jpg" alt="coba">
                </div>
                <div class="p-5 md:w-1/2 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight mb-2">Halo coba</h3>
                        <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">Test</p>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-gray-800 dark:text-gray-200">100000</span>
                        </div>
                    </div>
                    <button class="mt-4 bg-gray-200 text-gray-700 px-5 py-2 rounded-md text-sm font-medium self-end">Buy now</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
