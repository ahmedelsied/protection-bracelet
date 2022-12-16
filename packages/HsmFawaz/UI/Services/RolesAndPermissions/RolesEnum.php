<?php

namespace HsmFawaz\UI\Services\RolesAndPermissions;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self super()
 * @method static self admin()
 * @method static self user()
 **/
class RolesEnum extends Enum
{
    protected static function values()
    {
        return [
            'super' => 'Super Admin',
            'admin' => 'Admin',
            'user' => 'User',
        ];
    }
}
