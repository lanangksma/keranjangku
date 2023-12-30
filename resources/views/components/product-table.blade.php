<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <caption
            class="invisible">
            Table
        </caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                {{ __('Name') }}
            </th>
            <th scope="col" class="px-6 py-3">
                {{ __('Description') }}
            </th>
            <th scope="col" class="px-6 py-3">
                {{ __('Category') }}
            </th>
            <th scope="col" class="px-6 py-3">
                {{ __('Price') }}
            </th>
            <th scope="col" class="px-6 py-3">
                {{ __('Image') }}
            </th>
            <th scope="col" class="px-6 py-3">
                <span class="sr-only">Action</span>
            </th>
        </tr>
        </thead>
        <tbody>
        {{ $slot }}
        </tbody>
    </table>
</div>
