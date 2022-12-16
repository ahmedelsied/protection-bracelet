<?php

namespace HsmFawaz\UI\Services\RolesAndPermissions;

use App\Domain\Client\Enums\ClientPermissions;
use App\Domain\Management\Enums\ManagementPermissions;
use HsmFawaz\UI\Services\RolesAndPermissions\Concerns\HasPermissionMap;
use HsmFawaz\UI\Services\RolesAndPermissions\Roles\ManagerRole;
use HsmFawaz\UI\Services\RolesAndPermissions\Roles\SuperAdminRole;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    use HasPermissionMap;

    protected array $roles = [
        SuperAdminRole::class,
        ManagerRole::class,
    ];

    protected array $permissions = [
        ManagementPermissions::class,
    ];

    public function run()
    {
        $this->createPermissions();
        $this->seedRoles();
    }

    private function seedRoles()
    {
        foreach ($this->roles as $role) {
            (new $role())->execute();
        }
    }
}
