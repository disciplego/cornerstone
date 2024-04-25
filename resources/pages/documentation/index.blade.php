<?php
    $slug = 'documentation';
    $files = MarkdownHelp::getFileListFromDirectory($slug);
    ?>
<x-dgo::layouts.app :$title :$trackingId >



    <x-slot:main>
        <x-slot:aside-left>
            <h1>Menu</h1>
            @foreach($files as $item)

                <x-toc>
                    ## {{$item[0]}}
                    {!! MarkdownHelp::getBodyMarkdownFromSlug("documentation/$item[0]") !!}
                </x-toc>

            @endforeach

        </x-slot:aside-left>
        <x-slot:article >
            <div id="accordion-collapse" data-accordion="collapse" class="py-4">
            @foreach($files as $item)
                    <h2 id="accordion-collapse-heading-{{$item[0]}}">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-{{$item[0]}}" aria-expanded="true" aria-controls="accordion-collapse-body-{{$item[0]}}">
                            <span id="{{$item[0]}}">{{$item[0]}}</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-{{$item[0]}}" class="" aria-labelledby="accordion-collapse-heading-{{$item[0]}}">
                        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            {!! MarkdownHelp::getBodyContentFromSlug("documentation/$item[0]") !!}
                        </div>
                    </div>
            @endforeach
            </div>

        </x-slot:article>
    </x-slot:main>

    <x-slot:preFooter>

    </x-slot:preFooter>

    <x-slot:footer>

    </x-slot:footer>
</x-dgo::layouts.app>


