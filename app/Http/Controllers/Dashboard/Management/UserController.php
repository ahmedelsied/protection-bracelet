<?php

namespace App\Http\Controllers\Dashboard\Management;

use App\Domain\Management\Enums\ManagementPermissions;
use App\Domain\Management\Models\User;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Management\UserRequest;
use App\Support\Dashboard\Crud\WithCrud;
use HsmFawaz\UI\Services\RolesAndPermissions\RolesEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class UserController extends DashboardController
{
    use WithCrud;

    protected string $name = 'Users';

    protected string $path = 'dashboard.management.users';

    protected string $model = User::class;

    protected string $formRequest = UserRequest::class;

    protected array $permissions = [ManagementPermissions::class, 'users'];

    protected function formData(?Model $model = null): array
    {
        return [
            'selected' => $model?->getRoleNames(),
            'roles' => toMap(Role::where('guard_name', 'web')
                                    ->whereNotIn('name', RolesEnum::toValues())
                                    ->get(['id', 'name']), 'name'),
        ];
    }

    protected function storeAction(array $validated)
    {
        $roles = Arr::pull($validated, 'roles', []);
        $avatar = Arr::pull($validated, 'avatar');
        $model = User::create($validated);
        $model->syncRoles($roles);
        $avatar && $model->addMedia($avatar)->toMediaCollection();
    }

    protected function updateAction(array $validated, Model $model)
    {
        $roles = Arr::pull($validated, 'roles', []);

        $model->update($validated);
        $model->syncRoles($roles);

        $avatar = Arr::pull($validated, 'avatar');
        if ($avatar instanceof UploadedFile) {
            $model->clearMediaCollection();
            $model->addMedia($avatar)->toMediaCollection();
        }
    }
}
