<x-dgo::layouts.base>

    <x-slot:header>
        <x-dgo::wrappers.header>
            @isset($topBar)
                <x-dgo::wrappers.top-bar>
                    {{ $topBar }}
                </x-dgo::wrappers.top-bar>
            @endisset

            <x-dgo::wrappers.nav>
                <x-dgo::blocks.navbar.default :$mainMenuItems/>
            </x-dgo::wrappers.nav>


            @isset($banner)
                <x-dgo::wrappers.banner>
                    {{ $banner }}
                </x-dgo::wrappers.banner>

            @endisset
        </x-dgo::wrappers.header>
    </x-slot:header>
    @isset($hero)
        <x-slot:hero>
                {{ $hero }}
        </x-slot:hero>
    @endisset

@isset($main)
    <x-slot:main>
        <x-dgo::wrappers.main>
            {{ $main }}
            @isset($asideLeft)
                <x-dgo::wrappers.aside-left>
                    {{ $asideLeft }}
                </x-dgo::wrappers.aside-left>
            @endisset

            @isset($article)
                <x-dgo::wrappers.article>
                    {{ $article }}
                </x-dgo::wrappers.article>
            @endisset

            @isset($asideRight)
                <x-dgo::wrappers.aside-right>
                    {{ $asideRight }}
                </x-dgo::wrappers.aside-right>
            @endisset

        </x-dgo::wrappers.main>
    </x-slot:main>
    @endisset

    {{$slot}}

    @isset($preFooter)
        <x-slot:preFooter>
            {{ $preFooter }}
        </x-slot:preFooter>
    @endisset


    <x-slot:footer>
        <x-dgo::wrappers.footer>
            <x-dgo::blocks.footer.default :$footerMenuItems :$socialMenuItems/>
        </x-dgo::wrappers.footer>
    </x-slot:footer>


</x-dgo::layouts.base>