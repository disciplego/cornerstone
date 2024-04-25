@props([
    'wrapClasses' => 'bg-white border-gray-200 dark:border-gray-600 border dark:bg-gray-900'
//    'wrapClasses' => 'max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 mx-auto bg-white border-gray-200 dark:border-gray-600 border dark:bg-gray-900'
])
<header {{ $attributes->merge(['class' => $wrapClasses]) }} >
    {{ $slot }}
</header>