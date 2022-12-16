<?php

use Collective\Html\FormFacade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (! function_exists('dotted_string')) {
    function dotted_string(string $name): string
    {
        if ($name === '') {
            return $name;
        }

        $base = str_replace(['[', ']'], ['.', ''], $name);
        if ($base[strlen($base) - 1] === '.') {
            return substr($base, 0, -1);
        }

        return $base;
    }
}
if (! function_exists('toMap')) {
    function toMap(Traversable $iterator, string $key = 'id', string $value = 'name'): array
    {
        $result = [];
        foreach ($iterator as $item) {
            $result[$item[$key]] = $item[$value];
        }

        return $result;
    }
}
if (! function_exists('theme_path')) {
    function theme_path(string $path): string
    {
        return base_path('packages/HsmFawaz/UI/'.$path);
    }
}
if (! function_exists('locale_field')) {
    function locale_field(string $name, $locale = 'ar'): ?string
    {
        if ($model = FormFacade::getModel()) {
            return $model->getTranslation($name, $locale);
        }

        return null;
    }
}
if (! function_exists('route_group')) {
    function route_group(string|array $prefix, callable $callback): void
    {
        $prefixValue = is_array($prefix) ? $prefix['prefix'] : $prefix;
        $as = Str::of($prefixValue)->snake()->lower()->append('.');
        $namespace = Str::of($prefixValue)->singular()->studly();
        $middleware = [];

        if (is_array($prefix)) {
            $as = $prefix['as'] ?? $as;
            $namespace = $prefix['namespace'] ?? $namespace;
            $middleware = $prefix['middleware'] ?? $middleware;
        }

        Route::group([
            'prefix' => $prefixValue,
            'as' => $as,
            'namespace' => $namespace,
            'middleware' => $middleware,
        ], $callback);
    }
}
