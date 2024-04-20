<?php

use Illuminate\Support\Facades\Route;

// DynamicRobotsTxt route
Route::get('/robots.txt', function () {
    return response(view('dgo::dynamic-robots-txt'), 200, ['Content-Type' => 'text/plain']);
});
