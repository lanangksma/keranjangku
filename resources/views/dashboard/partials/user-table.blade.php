<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('User Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Information about users") }}
        </p>
    </header>
    <div class="mt-3">
        <x-dashboard-table>
            <x-slot:thead1> {{ __('Name') }} </x-slot:thead1>
            <x-slot:thead2> {{ __('Email') }} </x-slot:thead2>
            <x-slot:thead3> {{ __('Created At') }} </x-slot:thead3>
            <x-slot:thead4> {{ __('Updated At') }} </x-slot:thead4>
        </x-dashboard-table>
    </div>
</section>
