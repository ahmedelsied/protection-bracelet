<?php

namespace App\Support\Commands\Generators\Traits;

trait GetLastCreated
{
    protected static ?string $lastCreated = null;

    public static function lastCreated(): ?string
    {
        return self::$lastCreated;
    }
}
