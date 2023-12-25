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
                    <section>
                        <header class="flex justify-between items-center mb-4">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('User Information') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __("Information about users") }}
                                </p>
                            </div>
                            <div>
                                <x-nav-link :href="route('dashboardProducts.create')" :active="request()->routeIs('dashboardProducts.create')">
                                    {{ __('Add New') }}
                                </x-nav-link>
                            </div>
                        </header>
                        <div class="mt-3">
                            <x-product-table>
                                @foreach($products as $product)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $product['title'] }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $product['description'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product['category'] }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $product['price'] }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="#"
                                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-product-table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>