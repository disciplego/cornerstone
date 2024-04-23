<?php
$page = config('dgo-pages.index');
?>
<x-dgo::layouts.app :$title :$trackingId >

    <x-slot:hero>
        <x-dgo::blocks.hero.default :$page />
    </x-slot:hero>

{{--    <x-slot:main>--}}
{{--    </x-slot:main>--}}

    <x-slot:preFooter>

    </x-slot:preFooter>

    <x-slot:footer>

    </x-slot:footer>
</x-dgo::layouts.app>


