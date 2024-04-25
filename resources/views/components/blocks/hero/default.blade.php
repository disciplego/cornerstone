@aware(['page'])

<x-dgo::wrappers.hero>
                @if(isset($page['hero']['pre_title']))<h6
                        class="md:text-xl mb-4 dark:text-white uppercase transition ease-in-out delay-150 translate-y-1">{{$page['hero']['pre_title']}} </h6>@endif
                <h1 class="hero mb-4 text-6xl font-extrabold tracking-tight leading-none md:text-7xl text-gray-600 dark:text-gray-400">
                    @if(isset($page['hero']['show_icon']) && $page['hero']['show_icon'] == true && isset($page['hero']['icon']))
                        <x-icon name="{{$page['hero']['icon']}}"
                                class="icon h-12 inline-block mr-1 mb-2 text-primary-700"/>
                    @endif
                    @titleTextRender($page['title_markdown']) @if(isset($page['hero']['abbreviation']) and isset($page['hero']['show_badge']) and $page['hero']['show_badge'])
                        <span class="bg-gray-500 ml-2 text-lg font-medium text-white mb-4 px-2.5 py-0.5 rounded-lg uppercase align-middle">{{$page['hero']['abbreviation']}}</span>@endif
                </h1>
                @if(isset($page['hero']['show_lead']) and isset($page['hero']['description']))<p
                        class="mx-auto text-3xl">{!! MarkdownHelp::convertLeadParagraph($page['hero']['description']) !!}</p>@endif


                @if(isset($page['hero']['quote']['reference']) ?? isset($page['hero']['quote']['text']))
                        @php
                            $quoteType = $page['hero']['quote']['type'];
                        @endphp
                        @if($quoteType === 'verse')
                            <x-dgo::blocks.blockquote.verse />
                        @else
                            <x-dgo::blocks.blockquote.default />
                        @endif

                @endif

                    @isset($page['hero']['buttons'])
                        @foreach($page['hero']['buttons'] as $button)
                            <x-dgo::blocks.buttons.default href="{{$button['url']}}" type="{{$button['type']}}">
                                {{$button['label']}}
                            </x-dgo::blocks.buttons.default>
                        @endforeach
                    @endisset

                @isset($page['hero']['image'])
                    <div class="h-auto max-w-full col-span-1 @isset($page['hero']['image']['order']){{$page['hero']['image']['order']}}@endisset">
                        <img src="{{asset('storage/img/dgo-hero-image.jpg')}}" alt="">
                    </div>
                @endisset

</x-dgo::wrappers.hero>