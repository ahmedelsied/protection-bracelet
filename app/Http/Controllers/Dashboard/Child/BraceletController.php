<?php

namespace App\Http\Controllers\Dashboard\Child;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Dashboard\Crud\WithDatatable;
use App\Support\Dashboard\Crud\WithDestroy;
use App\Support\Dashboard\Crud\WithForm;
use App\Support\Dashboard\Crud\WithStore;
use App\Support\Dashboard\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Child\Datatables\BraceletDatatable;
use App\Domain\Child\Enums\ChildPermissions;
use App\Domain\Child\Models\Bracelet;

class BraceletController extends DashboardController
{
    use WithDatatable,  WithForm , WithStore ,WithUpdate , WithDestroy;

    protected string $name = 'Bracelet';
    protected string $path = 'dashboard.child.bracelets';
    protected string $datatable = BraceletDatatable::class;
    protected string $model = Bracelet::class;
    protected array $permissions = [ChildPermissions::class, 'bracelets'];


    public function show()
    {
        
    }

    protected function storeAction(array $validated)
    {
        ($this->model)::create(['user_id'   =>  auth()->id()] + $validated);

        return null;
    }

    protected function rules()
    {
        $rules = [
            'child_name'    =>  'required|string|max:100',
            'code'          =>  'required|string|max:100',
        ];

        if(request()->isMethod('PUT')){
            unset($rules['code']);
        }
        return $rules;
    }
}
