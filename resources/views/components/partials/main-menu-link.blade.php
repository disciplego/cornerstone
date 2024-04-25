@props(['active', 'item' => null])

@php
    $classes = ($active ?? false)
    ? 'font-semibold  text-secondary-500 dark:text-gray-100 border-secondary-500 focus:outline-none focus:border-primary-700'
    : 'font-medium text-gray-400 border-transparent dark:text-gray-100   hover:text-primary-500 hover:border-secondary-500 focus:outline-none focus:text-primary-700 focus:border-gray-300';
    $iconActiveClass = ($active ?? false)
    ? 'text-primary-700'
    : ''
@endphp

<a @isset($item) data-popover-target="{{'target_' .$item['id'] .$item['url']}}"  data-popover-placement="bottom" @endisset {{ $attributes->merge(['class' => 'h-full z-20 whitespace-nowrap inline-flex items-center xl:w-30 xl:px-4 pt-1 border-b-2 text-sm  leading-5 ' . $classes . ' md:transition ease-in-out delay-150 md:hover:-translate-y-0.5 hover:-translate-y-0.5 hover:scale-100 md:hover:scale-110']) }}>
   @isset($item['icon']) <x-icon
            name="{{$item['icon']}}" class="{{$iconActiveClass}} h-6 lg:inline-block mr-2 hidden" />@endisset
    <span class="md:hidden lg:inline-block">{{ $slot }}</span>
</a>

@if(isset($item) && isset($item['help_text']))
    <div data-popover id="{{'target_' .$item['id'] .$item['url']}}" role="tooltip"
         class=" absolute z-10 invisible inline-block text-center text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-200 dark:border-gray-600 dark:bg-gray-800">
        <div class="px-3 py-2">
            <p>{{$item['help_text']}}</p>
        </div>
        <div data-popper-arrow></div>
    </div>
@endif