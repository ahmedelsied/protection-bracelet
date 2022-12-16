<?php

namespace App\Support\Commands\Generators\Commands;

use App\Support\Commands\Generators\BaseGeneratorCommand;
use App\Support\Commands\Generators\Traits\GetLastCreated;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ModelGeneratorCommand extends BaseGeneratorCommand
{
    use GetLastCreated;

    protected $signature = 'generate:model {domain?} {name?} {--M|migration} {--silence=0}';

    protected $description = 'Generate a new crud';

    public function handle()
    {
        $domain = $this->promptForDomain();
        $name = $this->promptForArgument($this->argument('name'));
        $namespace = $this->getNamespace($domain);
        $fullPath = $this->getFullPath($domain, $name);

        $this->buildClass($namespace, $fullPath, $name);
        ! $this->isSilence() && $this->info("Model $namespace\\{$name} Created Successfully");
        if ($this->option('migration')) {
            $table = Str::snake(Str::pluralStudly($name));
            $migrationName = "create_{$table}_table";
            $this->callSilent('make:migration', [
                'name' => $migrationName,
                '--create' => $table,
            ]);
            $this->info("Creating(migration)       :   database/migrations/{$migrationName}");
        }
    }

    private function promptForArgument($value = null): string
    {
        if (is_string($value) && ! blank($value)) {
            if (! preg_match('/^\pL+$/u', $value)) {
                return $this->promptForArgument($this->ask('Please Enter a valid model name'));
            }
            $value = Str::of($value)
                        ->singular()
                        ->studly();

            return static::$lastCreated = $value;
        }

        $question = $this->ask('Please enter model name');

        return $this->promptForArgument($question);
    }

    private function promptForDomain()
    {
        $this->runCommand(
            DomainGeneratorCommand::class, ['name' => $this->argument('domain'), '--silence' => 1],
            $this->getOutput()
        );

        return DomainGeneratorCommand::lastCreated();
    }

    private function makeDirectory(string $domain)
    {
        $path = $this->domainPath($domain, 'Models');
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    private function buildClass(string $namespace, string $path, string $name)
    {
        $stub = Str::of(File::get(__DIR__.'/../Stubs/model.stub'))
                   ->replace('{{ namespace }}', $namespace)
                   ->replace('{{ class }}', $name);
        if (! File::isFile($path)) {
            return File::put($path, $stub);
        }
    }

    private function getNamespace(string $domain)
    {
        return "App\\Domain\\$domain\\Models";
    }

    private function getFullPath(string $domain, string $name)
    {
        return $this->makeDirectory($domain).DIRECTORY_SEPARATOR.$name.'.php';
    }
}
