<?php

use Illuminate\Support\Facades\Route;

// DynamicRobotsTxt route
Route::get('/robots.txt', function () {
    return response(view('dgo::dynamic-robots-txt'), 200, ['Content-Type' => 'text/plain']);
});

if (config('cornerstone.guest.login.enabled')) {
    Route::get(config('cornerstone.guest.login.url'), function () {
        return view('dgo::login');
    })->name(config('cornerstone.guest.login.route_name'));
}

if (config('cornerstone.guest.register.enabled')) {
    Route::get(config('cornerstone.guest.register.url'), function () {
        return view('dgo::register');
    })->name(config('cornerstone.guest.register.route_name'));
}
