<div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <div class="mt-2 text-2xl font-medium text-gray-900 dark:text-white">
        <x-button name="add-organization" icon="pencil" default label="Tambah Organisasi" />
    </div>
</div>

<div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>
        @if ($create)
            <livewire:organization.create />
        @endif
        {{-- change this to form from admin.organization.create blade when add-organization button clicked --}}
    </div>
</div>
