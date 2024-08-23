<?php

use Illuminate\Support\Facades\Route;

// DynamicRobotsTxt route
Route::get('/robots.txt', function () {
    return response(view('dgo::dynamic-robots-txt'), 200, ['Content-Type' => 'text/plain']);
});

if (config('dgo-menus.guest_menu_items.login.enabled')) {
    Route::get(config('dgo-menus.guest_menu_items.login.url'), function () {
        return view('dgo::login');
    })->name(config('dgo-menus.guest_menu_items.login.route_name'));
}

if (config('dgo-menus.guest_menu_items.register.enabled')) {
    Route::get(config('dgo-menus.guest_menu_items.register.url'), function () {
        return view('dgo::register');
    })->name(config('dgo-menus.guest_menu_items.register.route_name'));
}
