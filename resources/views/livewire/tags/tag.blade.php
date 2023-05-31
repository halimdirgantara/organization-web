<div>
    <div
        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
        <div class="mt-2 text-2xl font-medium text-gray-900 dark:text-white">
            @if ($createForm || $editForm)
                <x-button icon="x-circle" negative label="Batal" wire:click="#" />
            @else
                {{-- <x-button icon="pencil" primary label="Tambah Perizinan" wire:click="toggleForm" /> --}}
                <x-button icon="pencil" primary label="Tambah Perizinan" wire:click="#" />
            @endif
        </div>
    </div>

    {{-- @if($createForm)
        @include('admin.permission.create-form')
    @endif
    @if($editForm)
        @include('admin.permission.edit-form')
    @endif --}}
</div>
