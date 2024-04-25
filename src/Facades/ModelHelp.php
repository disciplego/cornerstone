<?php

namespace Dgo\Cornerstone\Facades;

use Illuminate\Support\Facades\Facade;

class ModelHelp extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'model-help';
    }
}
