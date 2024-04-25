@props([
    'wrapClasses' => 'bg-white dark:bg-gray-700 pt-4 md:pt-8',
    'first_div' => 'bg-white dark:bg-gray-900 grid max-w-screen-xl md:gap-16 px-4 py-8 mx-auto text-center',
    'second_div' => 'max-w-none format  sm:format-base md:format-lg dark:format-invert'
])
<section id="hero" {{ $attributes->merge(['class' => $wrapClasses]) }} >
    <div class="{{$first_div}}">
        <div class="{{$second_div}}">
            {{$slot}}
        </div>
    </div>
</section>