<!-- Dropdown menu -->
<div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
    <div class="px-4 py-3">
        <span class="flex w-full text-sm text-gray-900 dark:text-white"><x-icon name="heroicon-s-user-circle" class="mr-2 h-5 w-5 rtl:ml-2 rtl:mr-0 text-gray-500" />{{ Auth::user()->name }}</span>
        <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
    </div>
    @if (filament()->hasDarkMode() && (! filament()->hasDarkModeForced()))
        <x-filament::dropdown.list>
            <x-filament-panels::theme-switcher />
        </x-filament::dropdown.list>
    @endif
    <ul class="py-2" aria-labelledby="user-menu-button">
        @if(isset($menu) && isset($items))
            @foreach ($items as $item)
                @isset($item['url'])
                    @if($item['title'] == 'Dashboard')
                        @guest()
                            @continue
                        @endguest
                    @endif
                @endisset
                    <li>

                        <a href="{{$item['url']}}"
                           class="flex px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">@isset($item['icon'])
                                <x-icon name="{{$item['icon']}}"
                                        class="icon h-5 mr-2"/>@endisset{{$item['title']}}</a>
                    </li>
            @endforeach
        @endif

        <li>
            <!-- Authentication -->
            <form method="POST" action="{{ route('filament.dgo-admin.auth.logout') }}">
                @csrf
                <button type="submit" href="{{route('filament.dgo-admin.auth.logout')}}"
                        @click.prevent="$root.submit();"
                        class="flex mx-auto px-4 py-2 rounded-full bg-gray-50 text-sm text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 dark:text-gray-500 dark:hover:text-white">
                    <x-icon name="fas-sign-out-alt" class="h-5 mr-2"/>
                    Sign out
                </button>
            </form>
        </li>
    </ul>
</div>