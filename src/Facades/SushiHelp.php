<?php

namespace Dgo\Cornerstone\Facades;

use Illuminate\Support\Facades\Facade;

class SushiHelp extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'sushi-help';
    }
}
