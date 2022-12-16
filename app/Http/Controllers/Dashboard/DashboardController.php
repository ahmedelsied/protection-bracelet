<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class DashboardController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected string $name;

    protected string $path;

    protected string $model;

    protected string $datatable;

    protected string $formRequest;

    protected array $permissions;

    public function __construct()
    {
        if (isset($this->permissions)) {
            $this->permissions[0]::{$this->permissions[1]}()->resource($this);
        }
    }

    /**
     * @description List of rules to validate the incoming requests
     *
     * @return array
     */
    protected function rules()
    {
        return [];
    }

    public function successfulRequest(
        ?string $route = null,
        bool $asJson = false,
        array $params = []
    ): RedirectResponse|JsonResponse {
        if ($asJson || request()->wantsJson()) {
            return response()->json([
                'status' => true,
                'message' => __('Request executed successfully'),
            ]);
        }
        toast(__('Request executed successfully'), 'success');

        return redirect(route($route ?: "{$this->path}.index", $params));
    }

    protected function validationAction(): array
    {
        return isset($this->formRequest) && class_exists($this->formRequest) ?
            app($this->formRequest)->validated() : request()->validate($this->rules());
    }

    protected function queryBuilder(): Builder
    {
        return ($this->model)::query();
    }

    protected function view(string $name, array $data = []): View
    {
        return view($this->viewPath().".$name", $data);
    }

    protected function viewPath()
    {
        return $this->path;
    }
}
