<?php

use Dgo\Cornerstone\Models\Page;
use Dgo\Cornerstone\Models\PageSushi;

it('implements the page interface methods', function ($model) {
    $data = [
        'title' => 'Test Title',
        'slug' => 'test-title',
        'lead' => 'Test Content',
        'content' => 'Test Content',
        'is_activated' => true,
    ];
    if (method_exists($model, 'getRows')) {
        config(['sushi-chef.should_cache' => true]);

        $page = (new $model());
     $page::setRowData($data);

        $page = $page->whereSlug($data['slug'])->first();

    } else {
        $page = new $model($data);
    }


    expect($page->title)->toBe('Test Title')
        ->and($page->slug)->toBe('test-title')
        ->and($page->lead)->toBe('Test Content')
        ->and($page->is_activated)->toBe(true)
        ->and($page->featured_image)->toBeNull();

})->with([
    [Page::class],
    [PageSushi::class]
]);
