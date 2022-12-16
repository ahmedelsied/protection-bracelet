<?php

namespace App\Support\Dashboard\Datatables\Columns;

use Illuminate\Support\Arr;

class UserColumn
{
    public static function render($relation = '')
    {
        return function ($model) use ($relation) {
            $data = filled($relation) ? data_get($model, $relation) : $model;
            $name = $data?->name ?? 'No Client';
            $avatar = $data?->avatar ? "<img src='$data->avatar' alt='$name' class='w-100'>" : strtoupper(mb_substr($name, 0, 1));
            $color = Arr::random(['success', 'info', 'warning', 'danger']);
            $bg = $data?->avatar ? '' : "bg-light-$color text-$color";

            return <<<HTML
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                        <div class="symbol-label fs-3 $bg">
                           $avatar 
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="text-gray-800 text-hover-primary mb-1">$name</span>
                    </div>
                </div>
        HTML;
        };
    }
}
