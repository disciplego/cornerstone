<a {{ $attributes->merge([ 'href' => '#', 'class' => 'no-underline inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-600 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900' ]) }}>
    {{ $slot }}
</a>