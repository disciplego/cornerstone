@aware(['hideMainMenu', 'mainMenuItems'])
@if(!empty($mainMenuItems) && !$hideMainMenu)
    <div class="z-50  h-full  lg:min-h-0 ml-48 md:ml-96 lg:ml-12 items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1"
         id="mobile-menu-2">
        <ul class="lg:h-full bg-white dark:bg-gray-900  flex flex-col font-medium px-4 lg:p-0  lg:mt-1 border border-gray-100  lg:flex-row lg:space-x-8 lg:mt-0 lg:border-0 dark:border-gray-700">


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