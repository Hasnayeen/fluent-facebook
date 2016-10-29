<?php

namespace Iluminar\Fluent\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ Iluminar\Fluent\Core\Fluent
 */
class Fluent extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Iluminar\Fluent\Core\Fluent';
    }
}
