<?php

namespace App\Support\Commands\Generators\Commands;

use App\Support\Commands\Generators\BaseGeneratorCommand;
use App\Support\Commands\Generators\Traits\GetLastCreated;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DomainGeneratorCommand extends BaseGeneratorCommand
{
    use GetLastCreated;

    protected $signature = 'generate:domain {name?} {--silence=}';

    protected $description = 'Generate a new domain';

    public function handle()
    {
        $name = $this->promptForArguments($this->argument('name'));
        $silence = $this->isSilence();
        $this->makeDirectory($name);
        ! $silence && $this->info("Domain $name created Successfully");
    }

    public function exist($name)
    {
        return File::exists($name);
    }

    private function makeDirectory(string $domain)
    {
        $path = $this->domainPath($domain);
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
    }

    private function promptForArguments($value = null)
    {
        if (is_string($value) && ! blank($value)) {
            if (! preg_match('/^\pL+$/u', $value)) {
                return $this->promptForArguments($this->ask('Please Enter a valid domain name'));
            }

            return static::$lastCreated = Str::of($value)->singular()->studly();
        }

        $question = $this->ask('Please Enter Domain name');

        return $this->promptForArguments($question);
    }
}
