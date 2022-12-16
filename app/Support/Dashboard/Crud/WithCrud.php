<?php

namespace App\Support\Dashboard\Crud;

trait WithCrud
{
    use WithDatatable;
    use WithForm;
    use WithStore;
    use WithUpdate;
    use WithDestroy;
}
