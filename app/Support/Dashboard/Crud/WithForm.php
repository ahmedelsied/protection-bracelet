<?php

namespace App\Support\Dashboard\Crud;

use Collective\Html\FormFacade;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait WithForm
{
    public function create(): View
    {
        return $this->formPage();
    }

    public function edit($id)
    {
        $model = ($this->model)::findOrFail($id);

        return $this->formPage(model: $model);
    }

    public function formPage(array $data = [], ?Model $model = null): View
    {
        $model && FormFacade::setModel($model);
        $data['model'] = $model;
        $data['route'] = $this->path;
        $data['formName'] = $this->name;
        $data['formBreadCrumbs'] = Str::of($this->path)
                                      ->explode('.')
                                      ->map(fn ($i) => __(Str::studly($i)))
                                      ->push(__($model ? 'Edit' : 'Create'));

        return view("{$this->viewPath()}.form", array_merge($this->formData($model), $data));
    }

    protected function formData(?Model $model = null): array
    {
        return [];
    }
}
