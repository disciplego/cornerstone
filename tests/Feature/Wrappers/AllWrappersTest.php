<?php

beforeEach(function () {
    $this->class = 'some-class';
    $this->slot = 'Slot Content';
});

it('can append the wrap classes', function ($wrapperName) {

    $view = $this->blade("<x-dgo::wrappers.{$wrapperName} class=$this->class></x-dgo::wrappers.{$wrapperName}>");

    expect($view)->assertSee($this->class.'"', false);
})->with('WrappersToTest');

it('can replace the wrap classes', function ($wrapperName) {

    $view = $this->blade("<x-dgo::wrappers.{$wrapperName} wrapClasses=$this->class></x-dgo::wrappers.{$wrapperName}>");

    expect($view)->assertSee('class="'.$this->class.'"', false);
})->with('WrappersToTest');

it('can render the wraps with only the slot', function ($wrapperName) {
    $view = $this->blade("<x-dgo::wrappers.{$wrapperName}>$this->slot</x-dgo::wrappers.{$wrapperName}>");

    expect($view)->assertSee($this->slot);
})->with('WrappersToTest');
