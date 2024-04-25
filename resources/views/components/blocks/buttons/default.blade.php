@props(['type' => 'primary'])

@switch($type)
    @case('primary')
    <a {{ $attributes->merge([ 'href' => '#', 'class' => 'no-underline inline-flex items-center justify-center my-4 px-5 py-3 mr-3 text-base
font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-600 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900' ]) }}>
        {{ $slot }}
        <svg class="w-6 h-6 ml-2 -mr-1" fill="currentColor" viewBox="0 0 1746.52 1600"
             xmlns="http://www.w3.org/2000/svg">
            <g id="Dgo_Icon" data-name="Dgo Icon">
                <polygon
                        points="665.39 1404.23 665.39 1132.91 0 1132.91 0 467.52 665.39 467.52 665.39 196.2 1518.12 800.22 665.39 1404.23"
                        style="fill:#B4C6FC"/>
            </g>
        </svg>
    </a>
    @break
    @case('simple')
    <a {{ $attributes->merge([ 'href' => '#', 'class' => 'no-underline inline-flex items-center justify-center my-4 px-5 py-3 text-base
font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100
dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800' ]) }}>
        {{ $slot }}
    </a>
    @break
    @case('signup')
    @if (session('status'))
        <div class="max-w-3xl mx-auto inline-flex p-4 mb-4 text-lg text-primary-700 rounded-lg bg-primary-50 dark:bg-gray-800 dark:text-primary-400"
             role="alert">
            <x-icon name="fas-envelope" class="h-7 mr-3"/>
            {{ session('status') }}
        </div>

    @endif
    <form method="post" action="{{'/newsletter.subscribe'}}" id="newsletter-subscribe" class="py-3 my-4">
        @csrf
        <div class="items-center mx-auto mb-3  space-y-4 lg:max-w-screen-md sm:flex sm:space-y-0">
            <div class="relative w-full sm:w-1/4">
                <label for="first_name" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First
                    Name</label>
                <input class="block p-3 pl-4 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                       placeholder="First name" type="name" id="first_name" name="first_name">
            </div>
            <div class="relative w-full sm:w-3/4">
                <label for="email" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email
                    Address</label>
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                </div>
                <input class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                       placeholder="Your email" type="email" id="email" name="email" required="">
            </div>
            <div>
                <button type="submit"
                        class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{{ $slot ?? 'Subscribe'}}</button>
            </div>
        </div>
        <div class="mx-auto max-w-screen-md text-sm text-gray-500 newsletter-form-footer dark:text-gray-300">
            Get helpful and inspiring disciple-making content delivered to your inbox for free!
        </div>
    </form>
    @break
@endswitch