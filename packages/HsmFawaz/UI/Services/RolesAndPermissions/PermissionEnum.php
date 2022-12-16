<?php

namespace HsmFawaz\UI\Services\RolesAndPermissions;

use Illuminate\Routing\Controller;
use Spatie\Enum\Laravel\Enum;

class PermissionEnum extends Enum
{
    public function create(): string
    {
        return 'create_'.$this->value;
    }

    public function read(): string
    {
        return 'read_'.$this->value;
    }

    public function update(): string
    {
        return 'update_'.$this->value;
    }

    public function delete(): string
    {
        return 'delete_'.$this->value;
    }

    public function current(): string
    {
        return $this->value;
    }

    public static function names(): array
    {
        $names = [];
        $exclude = static::singlePermissions();
        foreach (static::toValues() as $value) {
            if (in_array($value, $exclude, true)) {
                $names[] = $value;
                continue;
            }
            foreach (['create', 'read', 'update', 'delete'] as $ability) {
                $names[] = $ability.'_'.$value;
            }
        }

        return $names;
    }

    /**
     * @param  string  $ability  ['create', 'read', 'update', 'delete']
     * @param  null  $guard
     *
     * @return bool
     */
    public function can(string $ability = 'current', $guard = null): bool
    {
        return auth($guard)->user()?->can($this->{$ability}()) ?? false;
    }

    /**
     * @param  string  $ability  ['create', 'read', 'update', 'delete']
     * @param  Controller  $controller
     * @param  array  $methods
     */
    public function middleware(string $ability, Controller $controller, array $methods = []): void
    {
        $controller->middleware(['permission:'.$this->{$ability}])->only($methods);
    }

    /**
     * @param  Controller  $controller
     */
    public function resource(Controller $controller): void
    {
        $controller->middleware(['permission:'.$this->create()])->only(['create', 'store']);
        $controller->middleware(['permission:'.$this->read()])->only(['index', 'show']);
        $controller->middleware(['permission:'.$this->update()])->only(['edit', 'update']);
        $controller->middleware(['permission:'.$this->delete()])->only(['destroy']);
    }

    public static function singlePermissions(): array
    {
        return [];
    }
}
