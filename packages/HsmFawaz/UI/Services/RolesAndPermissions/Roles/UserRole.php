<?php

namespace HsmFawaz\UI\Services\RolesAndPermissions\Roles;

use App\Domain\Management\Enums\ManagementPermissions;
use HsmFawaz\UI\Services\RolesAndPermissions\Concerns\HasPermissionMap;
use HsmFawaz\UI\Services\RolesAndPermissions\RolesEnum;
use Spatie\Permission\Models\Role;

class UserRole
{
    use HasPermissionMap;

    protected array $permissions = [
        ManagementPermissions::class,
    ];

    public function execute()
    {
        /** @var Role $role */
        $role = Role::updateOrCreate(['name' => RolesEnum::user()->value, 'guard_name' => 'web']);
        $role->givePermissionTo($this->getPermissionNames());
    }
}
