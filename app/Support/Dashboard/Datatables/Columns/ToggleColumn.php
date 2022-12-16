<?php

namespace App\Support\Dashboard\Datatables\Columns;

class ToggleColumn
{
    public static function render($id, $status)
    {
        $checked = $status ? 'checked="checked"' : '';

        return <<<HTML
         <div class="custom-control datatable-switcher custom-switch custom-switch-square custom-control-success mb-2">
            <input type="checkbox" class="custom-control-input" id="s_$id" $checked>
            <label class="custom-control-label" for="s_$id"></label>
         </div>
        HTML;
    }
}
