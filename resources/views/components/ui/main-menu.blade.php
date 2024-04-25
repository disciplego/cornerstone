@aware(['hideMainMenu', 'mainMenuItems'])
@if(!empty($mainMenuItems) && !$hideMainMenu)
    <div class=" h-full bg-white dark:bg-gray-900 ml-12 items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
         id="mobile-menu-2">
        <ul class="h-full flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100  md:flex-row md:space-x-8 md:mt-0 md:border-0 dark:border-gray-700">


            @foreach ($mainMenuItems as $item)
                @if($item['is_activated'] === true)

{{--                    @guest()--}}
{{--                        @continue--}}
{{--                    @endguest--}}
                    @isset($item['url'])
                        @if($item['title'] == 'Dashboard')
                            @guest()
                                @continue
                            @endguest
                        @endif

                        <x-dgo::partials.main-menu-link :href="$item['url']"
                                                        :item="$item"
                                                        :active="request()->url() === url($item['url'])"
                                                        :wire:key="($item['url'])"
                        >

                            {{ $item['title'] }}
                        </x-dgo::partials.main-menu-link>

                    @endisset
                @endif
            @endforeach
        </ul>
    </div>
@endif