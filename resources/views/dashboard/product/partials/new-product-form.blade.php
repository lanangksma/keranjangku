<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add New Product') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Add a new product to your inventory.') }}
        </p>
    </header>

    <form method="post" action="{{ route('products.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" />
            @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" class="mt-1 block w-full"></textarea>
            @error('description')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-input-label for="category" :value="__('Category')" />
            <x-text-input id="category" name="category" type="text" class="mt-1 block w-full" />
            @error('category')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" />
            @error('price')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-input-label for="image" :value="__('Image')" />
            <input id="image" name="image" type="file" class="mt-1 block w-full">
            @error('image')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('success'))
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ session('success') }}</p>
            @endif
        </div>
    </form>
</section>
