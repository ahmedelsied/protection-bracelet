<?php

namespace App\Http\Controllers\Dashboard\Management;

use App\Domain\Management\Datatables\RoleDatatable;
use App\Domain\Management\Enums\ManagementPermissions;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Dashboard\Crud\WithCrud;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends DashboardController
{
    use WithCrud;

    protected string $name = 'Roles and Permissions';

    protected string $path = 'dashboard.management.roles';

    protected string $model = Role::class;

    protected string $datatable = RoleDatatable::class;

    protected array $permissions = [ManagementPermissions::class, 'roles'];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'permissions' => 'nullable|array',
        ];
    }

    protected function storeAction(array $validated)
    {
        $permissions = Arr::pull($validated, 'permissions');
        $validated['guard_name'] = 'web';
        $role = Role::create($validated);
        $role->syncPermissions($permissions);
    }

    protected function updateAction(array $validated, Model $model)
    {
        $model->syncPermissions(Arr::pull($validated, 'permissions'));
        $model->update($validated);
    }

    protected function formData(?Model $model = null): array
    {
        $names = Permission::pluck('name')->toArray();
        $default = ['create', 'read', 'update', 'delete'];
        $group = ['other' => []];
        foreach ($names as $name) {
            $added = false;
            foreach ($default as $action) {
                if (Str::startsWith($name, $action.'_')) {
                    $groupName = Str::replaceFirst($action.'_', '', $name);
                    if (! isset($group[$groupName])) {
                        $group[$groupName] = [];
                    }
                    $group[$groupName][] = ['name' => $action, 'value' => $name];
                    $added = true;
                }
            }
            if (! $added) {
                $group['other'][] = ['name' => $name, 'value' => $name];
            }
        }

        return [
            'selectedPermissions' => $model?->permissions->pluck('name')->all() ?? [],
            'permissions' => array_filter($group),
        ];
    }
}
