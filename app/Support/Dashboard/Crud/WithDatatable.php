<?php

namespace App\Support\Dashboard\Crud;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Dashboard\Datatables\BaseDatatable;
use HsmFawaz\UI\Services\RolesAndPermissions\PermissionEnum;
use Illuminate\Support\Str;

/**@mixin DashboardController * */
trait WithDatatable
{
    public function index()
    {
        return $this->datatablePage($this->getDatatable());
    }

    protected function datatablePage(BaseDatatable $datatable, array $data = [])
    {
        $breadcrumbs = Str::of($this->path)
                          ->explode('.')
                          ->map(fn ($i) => __(Str::studly($i)))
                          ->push(__('Show All'));

        $data = array_merge([
            'route' => $this->path,
            'name' => $this->name,
            'breadcrumbs' => $breadcrumbs,
            'pagePermission' => $datatable->permission,
        ], $data);

        return $datatable->render($this->viewPath().'.index', $data);
    }

    protected function getDatatable($path = null, ?PermissionEnum $permissions = null): BaseDatatable
    {
        $path ??= $this->path;
        if (isset($this->permissions) && ! $permissions) {
            $permissions = $this->permissions[0]::{$this->permissions[1]}();
        }
        if (isset($this->datatable)) {
            return $this->datatable::create($path, [], $permissions);
        }

        $files = Str::of($this->model)
                    ->replaceFirst('Models', 'Datatables')
                    ->explode('\\');
        $class = $files->push($files->pop().'Datatable')->implode('\\');

        return $class::create($path, [], $permissions);
    }
}
