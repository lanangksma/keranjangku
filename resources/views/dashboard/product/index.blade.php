<x-app-layout>
    <x-slot name="header">
        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Home') }}
            </x-nav-link>

            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
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
                                <div class="flex items-center mt-4">
                                    <form action="{{ route('products.index') }}" method="GET">
                                        <label class="ps-2">
                                            <input type="text" name="search" placeholder="Search"
                                                   class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500">
                                        </label>
                                    </form>

                                    <label class="ps-2">
                                        <select
                                            class="px-4 pe-10 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500">
                                            <option selected value="">All Categories</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <x-nav-link :href="route('products.create')"
                                            :active="request()->routeIs('products.create')">
                                    {{ __('Add New') }}
                                </x-nav-link>
                            </div>
                        </header>
                        <div class="mt-3" id="searchRes">
                            <x-product-table>
                                <tbody id="products">
                                @if($products->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center py-4 px-10">YOU DON'T HAVE PRODUCTS TO SHOW
                                        </td>
                                    </tr>
                                @else
                                    @foreach($products as $product)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ $product->title }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $product->description }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $product->category->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                Rp.&nbsp;{{ $product->price }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if (Storage::disk('public')->exists($product->image))
                                                    @if (getimagesize(storage_path('app/public/' . $product->image)))
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                             alt="{{ $product->title }}"
                                                             class="w-20 h-20 object-cover rounded">
                                                    @else
                                                        <img src="{{ $product->image_link }}"
                                                             alt="{{ $product->title }}"
                                                             class="w-20 h-20 object-cover rounded">
                                                    @endif
                                                @else
                                                    <img src="https://via.placeholder.com/150" alt="Placeholder"
                                                         class="w-20 h-20 object-cover rounded">
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                   class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </x-product-table>
                        </div>
                        <form action="{{ route('products.generatePdf') }}" target="_blank">
                            @csrf
                            <button type="submit"
                                    class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-5">
                                Download PDF
                            </button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchForm = document.querySelector('[name="search"]');
            const searchRes = document.getElementById('searchRes');

            let delayTimer;

            searchForm.addEventListener('input', async (e) => {
                clearTimeout(delayTimer);
                const search = e.target.value;

                // Menunda permintaan fetch untuk mencegah permintaan berulang yang tidak perlu
                delayTimer = setTimeout(async () => {
                    const res = await fetch(`/dashboard/products?search=${search}`);
                    const data = await res.text();
                    searchRes.innerHTML = data;
                }, 500); // Menunda permintaan selama 500ms setelah input berhenti
            });

        });

    </script>
</x-app-layout>
