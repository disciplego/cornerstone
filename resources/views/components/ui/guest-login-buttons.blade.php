@guest()
    @if(config('cornerstone.guest.login.enabled'))
        <div class="flex items-center lg:order-2">
            <a href="{{ route(config('cornerstone.guest.login.route_name'))}}"
               class="font-medium text-sm leading-6 pl-4 pr-5 text-gray-400 whitespace-nowrap transition duration-150 ease-in-out hover:text-gray-700"
               wire:navigate>{{config('cornerstone.guest.login.text')}}</a>
            @if(config('cornerstone.guest.register.enabled'))
                <a href="{{ route(config('cornerstone.guest.register.route_name')) }}"
                   class="inline-flex items-center text-sm justify-center px-3 py-1 font-medium leading-6 text-white whitespace-nowrap bg-primary-600 border border-transparent shadow-sm hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600 rounded-full"
                   wire:navigate>{{config('cornerstone.guest.register.text')}}</a>
            @endif
        </div>
    @endif
@endguest