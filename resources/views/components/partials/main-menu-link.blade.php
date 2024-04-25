@props(['active', 'item' => null])

@php
    $classes = ($active ?? false)
    ? 'font-semibold text-secondary-500 dark:text-gray-100 border-secondary-500 focus:outline-none focus:border-primary-700'
    : 'font-medium text-gray-400 border-transparent dark:text-gray-100   hover:text-primary-500 hover:border-secondary-500 focus:outline-none focus:text-primary-700 focus:border-gray-300';
    $iconActiveClass = ($active ?? false)
    ? 'text-primary-700'
    : ''
@endphp

<a @isset($item) data-popover-target="{{'target_' .$item['id'] .$item['url']}}"  data-popover-placement="bottom" @endisset {{ $attributes->merge(['class' => 'h-10 lg:h-full   z-50 whitespace-nowrap inline-flex items-center mt-4 lg:m-0 lg:pb-0 py-4  xl:w-30 xl:px-4 pt-1 border-b-2 text-sm  leading-5 ' . $classes . ' lg:transition ease-in-out delay-150 lg:hover:-translate-y-0.5 hover:-translate-y-0.5 lg:hover:scale-100 lg:hover:scale-110']) }} wire:navigate>
   @isset($item['icon']) <x-icon
            name="{{$item['icon']}}" class="{{$iconActiveClass}} h-6 inline-block mr-2 " />@endisset
    <span class=" inline-block">{{ $slot }}</span>
</a>

@if(isset($item) && isset($item['help_text']))
    <div data-popover id="{{'target_' .$item['id'] .$item['url']}}" role="tooltip"
         class=" absolute z-50 hidden invisible lg:inline-block text-center text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-200 dark:border-gray-600 dark:bg-gray-800">
        <div class="px-3 py-2">
            <p>{{$item['help_text']}}</p>
        </div>
        <div data-popper-arrow></div>
    </div>
@endif