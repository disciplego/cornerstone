<?php

it('gets short class name correctly', function () {
    $result = ModelHelp::getShortClassName('App\\Models\\User');
    expect($result)->toBe('user');
});

it('gets snake case class name correctly', function () {
    $result = ModelHelp::getSnakeCaseClassName('App\\Models\\UserProfile');
    expect($result)->toBe('user_profile');
});

it('gets camel case class name correctly', function () {
    $result = ModelHelp::getCamelCaseClassName('App\\Models\\UserProfile');
    expect($result)->toBe('userProfile');
});

it('gets slug case class name correctly', function () {
    $result = ModelHelp::getSlugCaseClassName('App\\Models\\UserProfile');
    expect($result)->toBe('user-profile');
});