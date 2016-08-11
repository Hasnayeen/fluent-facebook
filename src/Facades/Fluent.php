<?php

namespace Iluminar\Fluent\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Laravel\Socialite\SocialiteManager
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
