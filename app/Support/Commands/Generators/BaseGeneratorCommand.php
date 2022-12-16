<?php

namespace App\Support\Commands\Generators;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class BaseGeneratorCommand extends Command
{
    public function handle()
    {
        $this->warn('This command is not implemented yet');
    }

    public function domainPath(?string $domain = null, ?string $path = null): string
    {
        $ds = DIRECTORY_SEPARATOR;

        return app_path('Domain').($domain ? $ds.$domain : '').($path ? $ds.$path : '');
    }

    public function controllerPath(?string $domain = null, ?string $path = null): string
    {
        $ds = DIRECTORY_SEPARATOR;

        return app_path('Http/Controllers/Dashboard').($domain ? $ds.$domain : '').($path ? $ds.$path : '');
    }

    public function viewPath(?string $domain = null, ?string $path = null): string
    {
        $ds = DIRECTORY_SEPARATOR;

        return resource_path('views/dashboard').($domain ? $ds.$domain : '').($path ? $ds.$path : '');
    }

    protected function isSilence()
    {
        return $this->option('silence') > 0;
    }

    protected function viewPathName(string $domain, string $name)
    {
        return 'dashboard.'.Str::kebab($domain).'.'.Str::of($name)
                                                       ->replace('Model', '')
                                                       ->plural()
                                                       ->kebab();
    }
}
