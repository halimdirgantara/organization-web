<div>
    <div
        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
        <div class="mt-2 text-2xl font-medium text-gray-900 dark:text-white">
            @if ($showForm)
                <x-button icon="x-circle" negative label="Batal" wire:click="toggleForm" />
            @else
                <x-button icon="pencil" primary label="Tambah Organisasi" wire:click="toggleForm" />
            @endif
        </div>
    </div>

    <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
        @if ($showForm)
            <div>
                <x-errors title="Kami menemukan {errors} kesalahan saat validasi" />

                    @csrf
                    <x-input icon="office-building" wire:model.defer="name" label="Nama"
                        placeholder="Tuliskan nama organisasi" />
                    <div class="mt-4">
                        <x-input icon="minus" wire:model.defer="abbreviation" label="Singkatan"
                            placeholder="Tuliskan singkatan organisasi" />
                    </div>
                    <div class="mt-4">
                        <x-textarea wire:model.defer="description" label="Deskripsi"
                            placeholder="Tuliskan deskripsi singkat tentang organisasi" />
                    </div>
                    <div class="mt-4">
                        <x-textarea wire:model.defer="address" label="Alamat"
                            placeholder="Tuliskan alamat lengkap organisasi" />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="mt-4">
                            <x-input icon="location-marker" wire:model.defer="latitude" label="Latitude"
                                placeholder="Tuliskan latitude" />
                        </div>

                        <div class="mt-4">
                            <x-input icon="location-marker" wire:model.defer="longitude" label="Longitude"
                                placeholder="Tuliskan longitude" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-input icon="mail" wire:model.defer="email" label="Email"
                            placeholder="Tuliskan alamat email organisasi" />
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="mt-4">
                            <x-input icon="phone" wire:model.defer="phone" label="Telepon"
                                placeholder="Tuliskan nomor telepon organisasi" />
                        </div>
                        <div class="mt-4">
                            <x-input icon="phone" wire:model.defer="fax" label="Fax"
                                placeholder="Tuliskan nomor fax organisasi" />
                        </div>
                        <div class="mt-4">

                        </div>
                    </div>
                    <div class="mt-4">
                        <x-button wire:click="confirmSave" spinner="save" primary label="Simpan" />
                    </div>

            </div>
        @endif
    </div>
</div>

