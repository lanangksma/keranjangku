<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <p class="text-neutral-500 dark:text-neutral-400">Welcome to your dashboard, {{ Auth::user()->name }}!</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{--{{ __("You're logged in!") }}--}}
                    <div class="text-gray-900 dark:text-gray-100">
                        <h2 class="text-3xl font-semibold">Statistik</h2>
                    </div>
                    <x-dashboard-card/>
                    <div class="text-gray-900 dark:text-gray-100">
                        <h2 class="text-3xl font-semibold">Detail</h2>
                    </div>
                    <x-product-table/>
                    <x-user-table />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
