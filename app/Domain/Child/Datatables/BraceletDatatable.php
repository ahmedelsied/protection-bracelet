<?php

namespace App\Domain\Child\Datatables;

use App\Domain\Child\Models\Bracelet;
use App\Support\Dashboard\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class BraceletDatatable extends BaseDatatable
{
    protected ?string $actionable = 'edit|delete|read';

    public function query(): Builder
    {
        return Bracelet::forAuthParent();
    }

    protected function columns(): array
    {
        return [
            $this->column('id',__('ID')),
            $this->column('child_name',__('Child Name')),
            $this->column('code',__('Code')),
        ];
    }
}
