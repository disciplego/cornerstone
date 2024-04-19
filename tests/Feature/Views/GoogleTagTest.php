<?php

it('shows no tag script if id not set', function () {
    $view = $this->blade('<x-dgo::utilities.google-tag />');

    expect($view)->assertDontSee('<!-- Google tag (gtag.js) -->', false);
});

it('shows tag script if id set', function () {
    config(['cornerstone.google_analytics.tracking_id'=>'42']);

    $view = $this->blade('<x-dgo::utilities.google-tag />');

    expect($view)->assertSee('<!-- Google tag (gtag.js) -->', false);
});