<?php

namespace HsmFawaz\UI;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UIServiceManager
{
    protected static string $DEFAULT_THEME = 'metronic';

    public static function useTheme(string $name)
    {
        if (! in_array($name, static::themes(), true)) {
            throw new \RuntimeException("Theme $name is not found");
        }
        self::$DEFAULT_THEME = $name;
    }

    public static function themes()
    {
        $path = theme_path('resources/views');

        return array_map(fn ($i) => str_replace($path.'\\', '', $i), File::directories($path));
    }

    public static function getTheme()
    {
        return Str::studly(static::$DEFAULT_THEME);
    }
}
