<?php

namespace App\Support\Commands\Generators\Commands;

use App\Support\Commands\Generators\BaseGeneratorCommand;
use App\Support\Commands\Generators\Traits\GetLastCreated;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DatatableGeneratorCommand extends BaseGeneratorCommand
{
    use GetLastCreated;

    protected $signature = 'generate:datatable {domain?} {model?} {--silence=0}';

    protected $description = 'Generate a new datatable for model';

    public function handle()
    {
        $modelName = $this->promptForArgument();
        $datatableName = self::$lastCreated;
        $domain = DomainGeneratorCommand::lastCreated();
        $namespace = $this->getNamespace($domain);
        $fullPath = $this->getFullPath($domain, $datatableName);

        $this->buildClass($namespace, $fullPath, $modelName);
        ! $this->isSilence() && $this->info("Datatable $namespace\\{$datatableName} Created Successfully");
    }

    private function promptForArgument(): string
    {
        $this->runCommand(
            ModelGeneratorCommand::class, [
                'name' => $this->argument('model'),
                'domain' => $this->argument('domain'),
                '--silence' => 1,
            ],
            $this->getOutput()
        );
        $modelName = ModelGeneratorCommand::lastCreated();
        static::$lastCreated = $modelName.'Datatable';

        return $modelName;
    }

    private function buildClass(string $namespace, string $path, string $name)
    {
        $modelPath = Str::of($namespace)->replace('Datatables', 'Models')->append('\\'.$name);

        $stub = Str::of(File::get(__DIR__.'/../Stubs/datatable.stub'))
                   ->replace('{{ namespace }}', $namespace)
                   ->replace('{{ model }}', $modelPath)
                   ->replace('{{ modelName }}', $name)
                   ->replace('{{ class }}', self::$lastCreated);

        if (! File::isFile($path)) {
            return File::put($path, $stub);
        }
    }

    private function getNamespace(string $domain)
    {
        return "App\\Domain\\$domain\\Datatables";
    }

    private function getFullPath(string $domain, string $name)
    {
        return $this->makeDirectory($domain).DIRECTORY_SEPARATOR.$name.'.php';
    }

    private function makeDirectory(string $domain)
    {
        $path = $this->domainPath($domain, 'Datatables');
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
