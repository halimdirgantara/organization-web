<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-errors title="Kami menemukan {errors} kesalahan validasi" />
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-input icon="user" name="name" label="Nama" placeholder="Tuliskan nama anda" />
            </div>

            <div class="mt-4">
                <x-input icon="mail" name="email" label="Email" placeholder="Tuliskan email anda" />
            </div>

            <div class="mt-4">
                <x-inputs.password name="password" label="Kata Sandi" value="Masukkan Kata Sandi" />
            </div>

            <div class="mt-4">
                <x-inputs.password name="password_confirmation" label="Ketik Ulang Kata Sandi" value="Masukkan Kata Sandi" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>


                <x-button-jet class="ml-4">
                    {{ __('Register') }}
                </x-button-jet>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
