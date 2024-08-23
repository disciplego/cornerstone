<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

beforeEach(function () {

    Route::get(config('dgo-menus.guest_menu_items.login.url'), function () {
        return view('dgo::login');
    })->name(config('dgo-menus.guest_menu_items.login.route_name'));

    Route::get(config('dgo-menus.guest_menu_items.register.url'), function () {
        return view('dgo::register');
    })->name(config('dgo-menus.guest_menu_items.register.route_name'));

});

it('does not show guest login button with false config', function () {
    Config::set('dgo-menus.guest_menu_items.login.enabled', false);
    $view = $this->blade('<x-dgo::ui.guest-login-buttons />');
    expect($view)->assertDontSee(config('dgo-menus.guest_menu_items.login.text'), false);
});

it('shows guest login button with true config', function () {
    config()->set('dgo-menus.guest_menu_items.login.enabled', true);
    config()->set('dgo-menus.guest_menu_items.register.enabled', false);
    $view = $this->blade('<x-dgo::ui.guest-login-buttons />');
    expect($view)->assertSee(config('dgo-menus.guest_menu_items.login.text'), false)
        ->assertDontSee(config('dgo-menus.guest_menu_items.register.text'), false);
});

it('shows guest register button with true config', function () {
    config()->set('dgo-menus.guest_menu_items.login.enabled', true);
    config()->set('dgo-menus.guest_menu_items.register.enabled', true);
    $view = $this->blade('<x-dgo::ui.guest-login-buttons />');
    expect($view)->assertSee(config('dgo-menus.guest_menu_items.register.text'), false);
});
