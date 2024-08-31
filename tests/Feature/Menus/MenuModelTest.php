<?php

use Dgo\Cornerstone\Models\Menu;
use Dgo\Cornerstone\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create a menu', function () {
    $menu = Menu::create(['name' => 'Test Menu']);

    expect($menu)->toBeInstanceOf(Menu::class)
        ->and($menu->name)->toBe('Test Menu');
});

it('can create a menu item', function () {
    $menu = MenuItem::create(['title' => 'Test Item']);

    expect($menu)->toBeInstanceOf(MenuItem::class)
        ->and($menu->title)->toBe('Test Item');
});

it('can create a menu item and associate it with a menu', function () {
    $menu = Menu::create(['name' => 'Main Menu']);

    $menuItem = MenuItem::create(['title' => 'Home', 'menu_id' => $menu->id]);

    expect($menuItem)->toBeInstanceOf(MenuItem::class)
        ->and($menuItem->menu_id)->toBe($menu->id)
        ->and($menu->items->first()->id)->toBe($menuItem->id);
})->todo();

it('can have many menu items', function () {
    $menu = Menu::create(['name' => 'Main Menu']);
    $menu->items()->createMany([
        ['title' => 'Home'],
        ['title' => 'About'],
    ]);

    expect($menu->items)->toHaveCount(2)
        ->and($menu->items->first()->title)->toBe('Home')
        ->and($menu->items->last()->title)->toBe('About');
});

it('can attach items to multiple menus', function () {
    $menu1 = Menu::create(['name' => 'Main Menu']);
    $menu2 = Menu::create(['name' => 'Footer Menu']);

    $item = MenuItem::create(['title' => 'Home']);
    $item->menus()->attach($menu1);
    $item->menus()->attach($menu2);

    expect($item->menus)->toHaveCount(2)
        ->and($item->menus->first()->name)->toBe('Main Menu')
        ->and($item->menus->last()->name)->toBe('Footer Menu');
});