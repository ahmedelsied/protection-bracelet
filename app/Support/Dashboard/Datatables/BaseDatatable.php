<?php

namespace App\Support\Dashboard\Datatables;

use HsmFawaz\UI\Services\RolesAndPermissions\PermissionEnum;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

abstract class BaseDatatable extends DataTable
{
    protected ?string $actionable = 'edit|delete';

    protected bool $indexer = true;

    protected ?int $defaultOrder = 0;

    protected string $route = '';

    public ?PermissionEnum $permission = null;

    abstract protected function columns(): array;

    abstract public function query(): Builder;

    protected function customColumns(): array
    {
        return [];
    }

    protected function customColumn(string $name, string $title, $searchable = true): Column
    {
        return Column::make($name)
            ->title($title)
            ->orderable(false)
            ->searchable($searchable)
            ->content('---');
    }

    public function dataTable($query)
    {
        $datatable = datatables()->eloquent($query)->addIndexColumn();
        $customColumns = collect($this->prepareCustomColumns());

        $customColumns->each(fn (\Closure $i, $key) => $datatable->addColumn($key, $i));

        collect($this->filters())
            ->each(fn (\Closure $i, $key) => $datatable->filterColumn($key, $i));

        collect($this->orders())
            ->each(fn (\Closure $i, $key) => $datatable->orderColumn($key, $i));

        return $datatable->rawColumns($customColumns->keys()->all());
    }

    protected function filters(): array
    {
        return [];
    }

    protected function actions($model): array
    {
        return [];
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $url = config('custom.FORCE_HTTPS') ?
            str_replace('http:', 'https:', secure_url(url()->full())) : url()->full();
        $builder = $this->builder()
            ->setTableId('base-datatable-table')
            ->columns($this->prepareColumns())
            ->minifiedAjax($url)
            ->responsive()
            ->buttons(['print'])
            ->dom($this->getDomVariable())
            ->pageLength();
        if ($this->defaultOrder !== null) {
            $builder->orderBy($this->defaultOrder, 'desc');
        }

        return $builder;
    }

    public function getIndex()
    {
        $indexColumn = $this->builder()->config->get('datatables.index_column', 'DT_RowIndex');

        return new Column([
            'data' => $indexColumn,
            'name' => $indexColumn,
            'title' => '#',
            'orderable' => false,
            'searchable' => false,
        ]);
    }

    protected function column(string $name, string $title, $searchable = true): Column
    {
        return Column::make($name)
            ->title($title)
            ->orderable(false)
            ->searchable($searchable)
            ->content('---');
    }

    protected function orders(): array
    {
        return [];
    }

    private function prepareColumns()
    {
        $list = [];

        if ($this->indexer) {
            $list[] = $this->getIndex();
        }

        $list = array_merge($list, $this->columns());

        if ($this->actionable !== '') {
            $list[] = Column::computed('action')
                ->title(__('Actions'))
                ->searchable(false)
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center');
        }

        return $list;
    }

    public static function create(
        string $route,
        array $data = [],
        ?PermissionEnum $permission = null
    ): static
    {
        $instance = new static();
        $instance->route = $route;
        $instance->customData = $data;
        $instance->permission = $permission;

        return $instance;
    }

    private function prepareCustomColumns()
    {
        $customs = $this->customColumns();
        if ($this->actionable !== '') {
            $customs['action'] = function ($model) {
                $customActions = array_map(function ($action) {
                    return $action instanceof Renderable ? $action->render() : $action;
                }, $this->actions($model));
                $allActions = array_merge(
                    $customActions,
                    $this->prepareActionsButtons($model)
                );
                $actions = implode('', $allActions);

                return "<div class='btn-group'>{$actions}</div>";
            };
        }

        return $customs;
    }

    private function prepareActionsButtons($model)
    {
        $currentActions = explode('|', $this->actionable);
        $actions = [];

        if (in_array(
            'show',
            $currentActions
        ) && (! $this->permission || $this->permission->can('show'))) {
            $actions[] = Blade::render(File::get(__DIR__.'/actions/show_button.blade.php'), [
                'route' => route($this->route.'.show', $model),
            ]);
        }

        if (in_array(
            'edit',
            $currentActions
        ) && (! $this->permission || $this->permission->can('update'))) {
            $actions[] = Blade::render(File::get(__DIR__.'/actions/edit_button.blade.php'), [
                'route' => route($this->route.'.edit', $model),
            ]);
        }
        if (in_array(
            'delete',
            $currentActions
        ) && (! $this->permission || $this->permission->can('delete'))) {
            $actions[] = Blade::render(File::get(__DIR__.'/actions/delete_button.blade.php'), [
                'route' => route($this->route.'.destroy', $model),
            ]);
        }

        return $actions;
    }

    private function getDomVariable()
    {
        return <<<'HTML'
        <"d-flex justify-content-between align-items-center"f<"d-flex align-items-center"Bl>>
        rt
        <"d-flex justify-content-between align-items-center"ip>
        HTML;
    }
}
