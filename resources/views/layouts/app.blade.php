<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <!-- Scripts -->
    <wireui:scripts />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />
    <x-notifications />
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')
        @include('sidebar-menu')


        <!-- Page Content -->
        <main>
            <div class="md:ml-64">
                <!-- Page Heading -->
                @if (isset($header))
                    <div class="md:mt-16">
                        <header class="bg-white dark:bg-gray-800 shadow lg:mt-16">
                            <div class=" py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    </div>
                @endif
                {{ $slot }}
            </div>
        </main>

        @include('footer')
    </div>

    @stack('modals')

</body>
@stack('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
@livewireScripts

</html>
