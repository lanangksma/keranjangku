<x-app-layout>
    <x-slot name="header">
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Home') }}
                </x-nav-link>

                <x-nav-link :href="route('dashboardProducts')" :active="request()->routeIs('dashboardProducts')">
                    {{ __('Product') }}
                </x-nav-link>

            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('User') }}
            </x-nav-link>
        </div>
    </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-full">
                        @include('dashboard.partials.card-information')
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-full">
                        @include('dashboard.partials.user-table')
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-full">
                        @include('dashboard.partials.product-table')
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
