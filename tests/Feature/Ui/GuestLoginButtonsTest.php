<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

beforeEach(function () {

    Route::get(config('cornerstone.guest.login.url'), function () {
        return view('dgo::login');
    })->name(config('cornerstone.guest.login.route_name'));

    Route::get(config('cornerstone.guest.register.url'), function () {
        return view('dgo::register');
    })->name(config('cornerstone.guest.register.route_name'));

});

it('does not show guest login button with false config', function () {
    Config::set('cornerstone.guest.login.enabled', false);
    $view = $this->blade('<x-dgo::ui.guest-login-buttons />');
    expect($view)->assertDontSee(config('cornerstone.guest.login.text'), false);
});

it('shows guest login button with true config', function () {
    config()->set('cornerstone.guest.login.enabled', true);
    config()->set('cornerstone.guest.register.enabled', false);
    $view = $this->blade('<x-dgo::ui.guest-login-buttons />');
    expect($view)->assertSee(config('cornerstone.guest.login.text'), false)
        ->assertDontSee(config('cornerstone.guest.register.text'), false);
});

it('shows guest register button with true config', function () {
    config()->set('cornerstone.guest.login.enabled', true);
    config()->set('cornerstone.guest.register.enabled', true);
    $view = $this->blade('<x-dgo::ui.guest-login-buttons />');
    expect($view)->assertSee(config('cornerstone.guest.register.text'), false);
});
