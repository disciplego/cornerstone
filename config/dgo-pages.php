<?php

return [
    'index' => [
        'id' => 1,
        'title' => 'Go. Make. Disciples.',
        'title_markdown' => '~!Go.!~ Make. ~-Disciples-~.',
        'slug' => 'home',
        'hero' => [
            'icon' => 'fas-home',
            'show_icon' => true,
            'pre_title' => 'We are passionate about helping you to:',
            'description' => '~!Jesus!~ made it clear that disciples make disciples that make disciples. This site is all about providing you with resources and connections to become a disciple-maker!',
            'show_lead' => true,
            'abbreviation' => 'DGO',
            'show_badge' => true,
            'quote' => [
                'type' => 'verse',
                'text' => '19 Therefore go and make disciples of all nations, baptizing them in the name of the Father and the Son and the Holy Spirit, 20 teaching them to obey everything I have commanded you. And remember, I am with you always, to the end of the age.',
                'reference' => 'Matthew 28:19-20',
                'version' => 'net'
            ],
            'buttons' => [[
                'url' => null,
                'type' => 'signup',
                'label' => 'Subscribe',
                'route' => 'newsletter.subscribe',
            ]],

        ],
    ]
];