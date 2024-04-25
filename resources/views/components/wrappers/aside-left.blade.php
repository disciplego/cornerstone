@props([
    'wrapClasses' => 'flex flex-col flex-grow format format-sm px-4 py-16'
])
<aside id="aside-left" {{ $attributes->merge(['class' => $wrapClasses]) }} >

        {{$slot}}

</aside>