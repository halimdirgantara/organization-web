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

    @if ($showForm)
    <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
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
                </div>
                <div class="mt-4">
                    <div class="col-span-full">
                        <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Logo</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    @if ($logo)
                                        <img src="{{ $logo->temporaryUrl() }}" alt="Logo" class="mb-3 object-cover w-48 h-48">
                                    @else
                                        <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                    @endif
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to upload</span></p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 250
                                        KB)</p>
                                </div>
                                <input wire:model="logo" id="dropzone-file" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <x-button wire:click="save" spinner="save" primary label="Simpan" />
                </div>
            </div>
        @endif
</div>
