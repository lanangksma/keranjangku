<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class=" bg-white dark:bg-gray-800 shadow sm:rounded-lg">
    <div class="container mx-auto py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div>
                <img src="https://source.unsplash.com/random" alt="Product Image" class="w-full h-97 object-cover">
            </div>
            <div>
                <h1 class="text-4xl font-bold mb-5">Travel Bags Everyday Ruck Snack</h1>
                <p class="text-2xl mb-5">$220</p>
                <p class="text-lg mb-5">Don't compromise on snack-carrying capacity with this lightweight and spacious bag. The drawstring top keeps all your favorite chips, crisps, fries, biscuits, crackers, and cookies secure.</p>
                <p class="text-green-600 text-lg mb-5">✓ In stock and ready to ship</p>
                <div class="mb-5">
                    <span class="text-lg font-bold">Size:</span>
                    <span class="text-lg ml-3">18L</span>
                </div>
                <p class="text-lg mb-5">Perfect for a reasonable amount of snacks.</p>
                <div class="text-lg mb-5">
                    <span>1624 reviews</span>
                    <span class="text-green-600 ml-3">✓ Best Seller</span>
                </div>
                <p class="text-lg mb-5">What size should I buy?</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="bg-white p-3 rounded shadow">
                        <p class="text-xl font-bold">20L</p>
                        <p class="text-lg">Enough room for a serious amount of snacks.</p>
                    </div>
                    <div class="bg-white p-3 rounded shadow">
                        <p class="text-xl font-bold">18L</p>
                        <p class="text-lg">Perfect for a reasonable amount of snacks.</p>
                    </div>
                </div>
                <button class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">Add to bag</button>
                <p class="text-sm mt-5">Lifetime Guarantee</p>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
