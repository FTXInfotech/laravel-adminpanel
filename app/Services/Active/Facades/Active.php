<?php

namespace App\Services\Active\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Active facade class.
 *
 * @author Hieu Le
 */
class Active extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'active';
    }
}
