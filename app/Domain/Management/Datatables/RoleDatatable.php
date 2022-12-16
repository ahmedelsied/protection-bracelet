<?php

namespace App\Domain\Management\Datatables;

use App\Support\Dashboard\Datatables\BaseDatatable;
use HsmFawaz\UI\Services\RolesAndPermissions\RolesEnum;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Column;

class RoleDatatable extends BaseDatatable
{
    public function query(): Builder
    {
        return Role::whereNotIn('name', RolesEnum::toValues())->latest()->withCount([
            'permissions', 'users',
        ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('name')->title(__('Name')),
            Column::make('permissions_count')->title(__('Permissions Count')),
            Column::make('users_count')->title(__('Users Count')),
        ];
    }
}
