<?php

namespace App\Support\Commands\Generators\Commands;

use App\Support\Commands\Generators\BaseGeneratorCommand;
use App\Support\Commands\Generators\Traits\GetLastCreated;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ViewGeneratorCommand extends BaseGeneratorCommand
{
    use GetLastCreated;

    protected $signature = 'generate:view {domain?} {name?} {--silence=0}';

    protected $description = 'Generate a new view';

    public function handle()
    {
        $domain = $this->promptForDomain();
        $name = $this->promptForArgument($this->argument('name'));
        static::$lastCreated = $route = $this->viewPathName($domain, $name);
        $fullPath = $this->makeDirectory($domain, $name);

        $this->buildClass($route, $fullPath, $name);
        ! $this->isSilence() && $this->info("View $route Created Successfully");
    }

    private function promptForArgument($value = null): string
    {
        if (is_string($value) && ! blank($value)) {
            if (! preg_match('/^\pL+$/u', $value)) {
                return $this->promptForArgument($this->ask('Please Enter a valid model name'));
            }

            return Str::of($value)
                      ->singular()
                      ->kebab();
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

    private function makeDirectory(string $domain, string $name)
    {
        $path = $this->viewPath(strtolower($domain)).DIRECTORY_SEPARATOR.Str::of($name)
                                                                            ->snake()
                                                                            ->pluralStudly();
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    private function buildClass(string $route, string $path, string $name)
    {
        $stubIndex = Str::of(File::get(__DIR__.'/../Stubs/view.index.stub'))
                        ->replace('{{ route }}', $route)
                        ->replace('{{ name }}', Str::plural($name));
        $stubForm = Str::of(File::get(__DIR__.'/../Stubs/view.form.stub'))
                       ->replace('{{ route }}', $route)
                       ->replace('{{ name }}', Str::plural($name));
        $index = $path.DIRECTORY_SEPARATOR.'index.blade.php';
        $form = $path.DIRECTORY_SEPARATOR.'form.blade.php';
        if (! File::isFile($index)) {
            File::put($index, $stubIndex);
        }
        if (! File::isFile($form)) {
            File::put($form, $stubForm);
        }
    }
}
