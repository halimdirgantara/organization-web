<button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
    aria-controls="sidebar-multi-level-sidebar" type="button"
    class="inline-flex items-center p-4 mt-16 overflow-auto ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
    Menu
</button>

<aside id="sidebar-multi-level-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full pt-24 px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center mx-auto mb-4">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto mr-4" />
                    </a>
                </div>
            </div>
        </ul>
        <ul class="space-y-2 font-medium mt-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'border-b-2 bg-gray-200' : '' }}">
                    <x-icon name="desktop-computer" class="w-5 h-5" solid />
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('master-data.*') ? 'border-b-2 bg-gray-200' : '' }}"
                    aria-controls="dropdown-master-data" data-collapse-toggle="dropdown-master-data">
                    <x-icon name="database" class="w-5 h-5" solid />
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Master Data</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul id="dropdown-master-data" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('master-data.organizations.index') }}"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                {{ request()->routeIs('master-data.organizations.index') ? 'border-b-2 bg-gray-200' : '' }}">
                            Organisasi
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 {{ request()->routeIs('setting.*') ? 'border-b-2 bg-gray-200' : '' }}"
                    aria-controls="dropdown-setting" data-collapse-toggle="dropdown-setting">
                    <x-icon name="cog" class="w-5 h-5" solid />
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Pengaturan</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul id="dropdown-setting" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('setting.users.index') }}"
                            class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700
                                {{ request()->routeIs('setting.users.index') ? 'border-b-2 bg-gray-200' : '' }}">
                            Pengguna
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</aside>