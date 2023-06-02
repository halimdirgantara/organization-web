<div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>
        <x-errors title="Kami menemukan {errors} kesalahan saat validasi" />

        @csrf
        <div class="mt-4">
            <x-input icon="user" wire:model.defer="name" label="Nama" placeholder="Tuliskan nama perizinan" />
        </div>
        <div class="mt-4">
            <x-button wire:click="save" spinner="save" primary label="Simpan" />
        </div>
    </div>
</div>
