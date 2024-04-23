<?php

it('shows no tag script if trackingId not set', function () {
    config(['cornerstone.google_analytics.tracking_id' => null]);
    $view = $this->blade('<x-dgo::utilities.google-tag />');

    expect($view)->assertDontSee('<!-- Google tag (gtag.js) -->', false);
});

it('shows tag script if trackingId set', function () {
    config(['cornerstone.google_analytics.tracking_id' => 'Foo42']);

    $view = $this->blade('<x-dgo::utilities.google-tag />');

    expect($view)->assertSee('<!-- Google tag (gtag.js) -->', false)
        ->assertSee('=Foo42', false);
});

it('can override trackingId', function () {
    config(['cornerstone.google_analytics.tracking_id' => 'Foo42']);

    $view = $this->blade('@php $trackingId = "Bar42" @endphp <x-dgo::utilities.google-tag :$trackingId />');

    expect($view)->assertSee('<!-- Google tag (gtag.js) -->', false)
        ->assertSee('=Bar42', false)
        ->assertDontSee('Foo42');
});

it('can override trackingID using a layout variable', function () {
    config(['app.name' => 'Foo']);
    $view = $this->blade('@php $title = "Foobar"; $trackingId = "Foo42" @endphp <x-dgo::layouts.base :$title :$trackingId></x-dgo::layouts.base>');

    expect($view)->assertSee('<title>Foobar | Foo</title>', false)
        ->assertSee('=Foo42', false);
});
