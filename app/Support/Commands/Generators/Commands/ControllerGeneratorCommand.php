<?php

namespace App\Support\Commands\Generators\Commands;

use App\Support\Commands\Generators\BaseGeneratorCommand;
use App\Support\Commands\Generators\Traits\GetLastCreated;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ControllerGeneratorCommand extends BaseGeneratorCommand
{
    use GetLastCreated;

    protected $signature = 'generate:controller {name?} {--domain=} {--model=} {--datatable=} {--empty=} {--silence=0}';

    protected $description = 'Generate a new controller';

    protected string $domain;

    protected string $controller;

    protected string $model;

    protected string $datatable;

    public function handle()
    {
        $this->model = $this->promptForModel();
        $this->domain = $this->promptForDomain();
        $this->datatable = $this->promptForDatatable();
        static::$lastCreated = $this->controller = $this->promptForArgument($this->argument('name'));
        $this->makeDirectory();
        $this->buildClass();

        ! $this->isSilence() && $this->info("Controller {$this->getNamespace()}\\{$this->controller} Created Successfully");
    }

    private function promptForArgument($value = null): string
    {
        if (! $this->option('empty')) {
            return $this->model.'Controller';
        }
        if (is_string($value) && ! blank($value)) {
            if (! preg_match('/^\pL+$/u', $value)) {
                return $this->promptForArgument($this->ask('Please Enter a valid controller name'));
            }

            return Str::of($value)
                      ->singular()
                      ->studly()
                      ->append('Controller');
        }

        $question = $this->ask('Please enter controller name');

        return $this->promptForArgument($question);
    }

    private function promptForDomain()
    {
        return DomainGeneratorCommand::lastCreated();
    }

    private function buildClass()
    {
        $path = $this->getFullPath();
        $stub = $this->option('empty') ? __DIR__.'/../Stubs/controller.stub' : __DIR__.'/../Stubs/controller.crud.stub';
        $pathVariable = $this->viewPathName($this->domain, $this->model);
        $permissionName = last(explode('.', $pathVariable));
        $stub = Str::of(File::get($stub))
                   ->replace('{{ namespace }}', $this->getNamespace())
                   ->replace('{{ model }}', $this->model)
                   ->replace('{{ name }}', Str::headline($this->model))
                   ->replace('{{ domain }}', $this->domain)
                   ->replace('{{ path }}', $pathVariable)
                   ->replace('{{ permissionName }}', $permissionName)
                   ->replace('{{ class }}', $this->controller);

        if (! $this->option('empty')) {
            $stub = $stub->replace('{{ datatable }}', $this->datatable);
        }
        if (! File::isFile($path)) {
            File::put($path, $stub);
        }
    }

    private function getNamespace()
    {
        return "App\\Http\\Controllers\\Dashboard\\$this->domain";
    }

    private function getFullPath()
    {
        return $this->controllerPath($this->domain).DIRECTORY_SEPARATOR.$this->controller.'.php';
    }

    private function promptForModel()
    {
        $this->runCommand(
            ModelGeneratorCommand::class, [
            'name'      => $this->option('model'),
            'domain'    => $this->option('domain'),
            '--silence' => 1,
        ],
            $this->getOutput()
        );

        return ModelGeneratorCommand::lastCreated();
    }

    private function promptForDatatable()
    {
        if ($this->option('empty')) {
            return null;
        }
        $this->runCommand(
            DatatableGeneratorCommand::class, [
            'domain'    => $this->domain,
            'model'     => $this->model,
            '--silence' => 1,
        ],
            $this->getOutput()
        );

        return DatatableGeneratorCommand::lastCreated();
    }

    private function makeDirectory()
    {
        $path = $this->controllerPath($this->domain);
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
