<?php

beforeEach(function () {
    config(['app.name' => 'Foo']);
});

it('shows app name if title not set', function () {
    $view = $this->blade('<x-dgo-layout></x-dgo-layout>');

    expect($view)->assertSee('<title>Foo</title>', false);
});

it('shows title and app name if title set with string', function () {
    $view = $this->blade('<x-dgo-layout title="Title"></x-dgo-layout>');

    expect($view)->assertSee('<title>Title | Foo</title>', false);
});

it('shows title and app name if title set with variable', function () {
    $view = $this->blade('@php $title = "Foobar" @endphp <x-dgo-layout :$title></x-dgo-layout>');

    expect($view)->assertSee('<title>Foobar | Foo</title>', false);
});
