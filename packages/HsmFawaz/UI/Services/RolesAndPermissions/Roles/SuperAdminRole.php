<?php

namespace HsmFawaz\UI\Services\RolesAndPermissions\Roles;

use HsmFawaz\UI\Services\RolesAndPermissions\RolesEnum;
use Spatie\Permission\Models\Role;

class SuperAdminRole
{
    public function execute()
    {
        $role = Role::updateOrCreate(['name' => RolesEnum::super()->value, 'guard_name' => 'web']);
    }
}
