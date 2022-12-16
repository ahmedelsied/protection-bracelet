<?php

namespace App\Domain\Management\Datatables;

use App\Domain\Management\Models\User;
use App\Support\Dashboard\Datatables\BaseDatatable;
use App\Support\Dashboard\Datatables\Columns\StatusColumn;
use App\Support\Dashboard\Datatables\Columns\UserColumn;
use HsmFawaz\UI\Services\RolesAndPermissions\RolesEnum;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class UserDatatable extends BaseDatatable
{
    public function query(): Builder
    {
        return User::whereKeyNot(1)->latest();
    }

    protected function columns(): array
    {
        return [
            Column::make('name')->title(__('User')),
            Column::make('phone')->title(__('Phone')),
            Column::computed('roles')->title(__('Roles')),
        ];
    }

    protected function orders(): array
    {
        return [
            'name' => fn ($i, $k) => $i->orderBy('name', $k),
        ];
    }

    protected function filters(): array
    {
        return [
            'name' => fn ($i, $k) => $i->where('name', 'like', "%$k%"),
        ];
    }

    protected function customColumns(): array
    {
        return [
            'name' => UserColumn::render(),
            'roles' => static function ($model) {
                $roles = [];
                foreach ($model->getRoleNames() as $name) {
                    if (in_array($name, RolesEnum::toValues(), true)) {
                        continue;
                    }
                    $roles[] = StatusColumn::render('success', $name);
                }
                if (count($roles) === 0) {
                    $roles[] = StatusColumn::render('secondary', __('No Role'));
                }

                return implode(' ', $roles);
            },
        ];
    }
}
