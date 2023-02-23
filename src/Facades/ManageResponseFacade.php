<?php

namespace Erjon\ManageResponse\Facades;

use Illuminate\Support\Facades\Facade;

class ManageResponseFacade extends Facade
{
    protected static function getFacadeAccessor():string
    {
        return 'manage_response';
    }
}
