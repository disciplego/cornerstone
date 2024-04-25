@aware(['hideMainMenu', 'mainMenuItems'])
<x-dgo::brand.nav-logo href="/" :active="request()->is('/')"/>
<div class="flex ml-auto items-center md:order-2">
    <x-dgo::ui.guest-login-buttons/>
    @auth()
        <button type="button"
                class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            <div class="relative">
                <x-dgo::partials.user-avatar :user="auth()->user()"/>
                <span class="bottom-0 left-7 absolute  w-3.5 h-3.5 bg-primary-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
            </div>
        </button>
        <x-dgo::ui.user-dropdown-menu/>
    @endauth
    <x-dgo::ui.theme-toggle-button/>
    <button data-collapse-toggle="mobile-menu-2" type="button"
            class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="mobile-menu-2" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
             xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"></path>
        </svg>
    </button>
</div>
<x-dgo::ui.main-menu/>