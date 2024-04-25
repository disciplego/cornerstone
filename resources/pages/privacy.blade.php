
<x-dgo::layouts.app :$title :$trackingId >



    <x-slot:main>
{{--        <x-slot:aside-left>--}}
{{--            <h1>Aside</h1>--}}
{{--            <x-toc>--}}
{{--                {!! MarkdownHelp::getBodyMarkdownFromSlug('privacy') !!}--}}
{{--            </x-toc>--}}
{{--        </x-slot:aside-left>--}}
        <x-slot:article >
           {!! MarkdownHelp::getBodyContentFromSlug('privacy') !!}
        </x-slot:article>
    </x-slot:main>

    <x-slot:preFooter>

    </x-slot:preFooter>

    <x-slot:footer>

    </x-slot:footer>
</x-dgo::layouts.app>


