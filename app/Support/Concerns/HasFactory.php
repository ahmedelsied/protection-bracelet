<?php

namespace App\Support\Concerns;

use Illuminate\Support\Str;

trait HasFactory
{
    /**
     * Get a new factory instance for the model.
     *
     * @param  mixed  $parameters
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function factory(...$parameters)
    {
        $factory = static::newFactory() ?: self::getFactory();

        return $factory
            ->count(is_numeric($parameters[0] ?? null) ? $parameters[0] : null)
            ->state(is_array($parameters[0] ?? null) ? $parameters[0] : ($parameters[1] ?? []));
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        //
    }

    public static function getFactory()
    {
        $namespace = (string) Str::of(static::class)
                        ->replace('App\\Domain', 'Database\\Factories')
                        ->replace('\\Models', '')
                        ->append('Factory');

        return new $namespace();
    }
}
