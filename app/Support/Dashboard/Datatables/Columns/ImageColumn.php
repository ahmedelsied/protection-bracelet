<?php

namespace App\Support\Dashboard\Datatables\Columns;

class ImageColumn
{
    public static function render($imageSource)
    {
        return <<<HTML
            <img src="$imageSource" width="70px" height="70px" class="rounded border border-2" alt="" />
        HTML;
    }
}
