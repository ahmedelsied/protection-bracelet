<?php

namespace HsmFawaz\UI\Services\RolesAndPermissions\Concerns;

use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;

trait HasPermissionMap
{
    public function getPermissionNames(): array
    {
        return array_map(function ($permission) {
            return class_exists($permission) && method_exists($permission, 'names')
                ? $permission::names() : $permission;
        }, $this->permissions);
    }

    protected function createPermissions(string $guard = 'web'): void
    {
        foreach (Arr::flatten($this->getPermissionNames()) as $permission) {
            Permission::updateOrCreate(['name' => $permission, 'guard_name' => $guard]);
        }
    }
}
