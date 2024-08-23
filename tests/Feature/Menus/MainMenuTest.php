<?php

beforeEach(function () {
    $this->mainMenuItems = [

        [
            'id' => 1,
            'title' => 'Homepage',
            'url' => '/',
            'is_activated' => true
        ],
        [
            'id' => 2,
            'title' => 'About',
            'url' => '/about',
            'is_activated' => true
        ],
        [
            'id' => 3,
            'title' => 'Contact',
            'url' => '/contact',
            'is_activated' => true
        ],
    ];
});

it('can render main menu with items', function () {

    $view = $this->blade('<x-dgo::blocks.navbar.default :mainMenuItems="$mainMenuItems" />', ['mainMenuItems' => $this->mainMenuItems]);

    expect($view)->assertSee('Homepage', false)
        ->assertSee('About', false)
        ->assertSee('Contact', false);
});

it('can hide main menu', function () {

    $view = $this->blade('<x-dgo::blocks.navbar.default :hideMainMenu="$hideMainMenu" />',
        ['hideMainMenu' => 'true']);

    expect($view)->assertDontSee('Homepage', false)
        ->assertDontSee('About', false)
        ->assertDontSee('Contact', false);
});
