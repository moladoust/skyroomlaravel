<?php

namespace Moladoust\Skyroomlaravel\Facades;

use Illuminate\Support\Facades\Facade;

class SkyroomLaravel extends Facade
{
    const SERVICE_STATUS__INACTIVE = 0;
    const SERVICE_STATUS__ACTIVE = 1;

    const ROOM_STATUS__INACTIVE = 0;
    const ROOM_STATUS__ACTIVE = 1;

    const USER_STATUS__INACTIVE = 0;
    const USER_STATUS__ACTIVE = 1;

    const USER_GENDER__UNKNOWN = 0;
    const USER_GENDER__MALE = 1;
    const USER_GENDER__FEMALE = 2;

    const ROOM_ACCESS__NORMAL_USER = 1;
    const ROOM_ACCESS__NORMAL_INSTRUCTOR = 2;
    const ROOM_ACCESS__NORMAL_OPERATION = 3;
    
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'skyroomLaravel';
    }
}
