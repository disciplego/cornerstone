@isset($socialMenuItems)
    <div class="flex ml-0 mt-2 md:mt-0 justify-center gap-2">
        @foreach($socialMenuItems as $item)
            @if($item['is_activated'] === true)
                <a data-popover-target="{{'target_' .$item['id'] .$item['slug']}}" data-popover-placement="bottom"
                   href="@isset($item['url']){{$item['url']}}@endisset"
                   class="text-gray-500 hover:text-gray-900 dark:hover:text-white" wire:navigate>
                    @isset($item['icon'])
                        <x-icon name="{{$item['icon']}}" class="h-5"/>
                    @endisset
                    <span class="sr-only">{{$item['title']}} | @isset($item['help_text'])
                            {{$item['help_text']}}
                        @endisset</span>
                </a>
                <x-dgo::partials.link-popover-text :item="$item"/>
            @endif
        @endforeach
    </div>
@endisset