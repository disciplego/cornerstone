@props([
    'wrapClasses' => 'bg-white dark:bg-gray-800',
    'sectionClasses' => 'py-8 border border-gray-200 dark:border-gray-700 bg-white dark:bg-primary-950',
    'first_div' => 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 md:flex md:items-center md:justify-between',
])
<footer {{ $attributes->merge(['class' => $wrapClasses]) }} >
<section class="{{$sectionClasses}}">
    <div class="{{$first_div}}">
        {{$slot}}
    </div>
</section>
</footer>