@isset($footerMenuItems)
<ul class="flex flex-wrap justify-center items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0">

    @foreach($footerMenuItems as $item)

        <li>
            <a href="{{ isset($item['route']) ? route($item['route']) : $item['url'] }}"
               class="mr-4 hover:underline md:mr-6 ">@isset($item['title']){{$item['title']}}@endisset</a>
        </li>
    @endforeach

</ul>
@endisset