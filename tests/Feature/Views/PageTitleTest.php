<?php

beforeEach(function () {
    config(['app.name' => 'Foo']);
});

it('shows app name if title not set', function () {
    $view = $this->blade('<x-dgo::layouts.base></x-dgo::layouts.base>');

    expect($view)->assertSee('<title>Foo</title>', false);
});

it('shows title and app name if title set with string', function () {
    $view = $this->blade('<x-dgo::layouts.base title="Title"></x-dgo::layouts.base>');

    expect($view)->assertSee('<title>Title | Foo</title>', false);
});

it('shows title and app name if title set with variable', function () {
    $view = $this->blade('@php $title = "Foobar" @endphp <x-dgo::layouts.base :$title></x-dgo::layouts.base>');

    expect($view)->assertSee('<title>Foobar | Foo</title>', false);
});
