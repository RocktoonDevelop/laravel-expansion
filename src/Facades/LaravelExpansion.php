<?php

namespace Rocktoon\LaravelExpansion\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rocktoon\LaravelExpansion\LaravelExpansion
 */
class LaravelExpansion extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Rocktoon\LaravelExpansion\LaravelExpansion::class;
    }
}
