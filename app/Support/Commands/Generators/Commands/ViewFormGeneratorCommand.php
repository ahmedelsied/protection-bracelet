<?php

namespace App\Support\Commands\Generators\Commands;

use App\Support\Commands\Generators\BaseGeneratorCommand;
use App\Support\Commands\Generators\Traits\GetLastCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class ViewFormGeneratorCommand extends BaseGeneratorCommand
{
    use GetLastCreated;

    protected $signature = 'generate:view-form {domain?} {name?} {--silence=0}';

    protected $description = 'Generate a new view form from model';

    protected string $domain;

    public function handle()
    {
        $this->domain = $this->promptForDomain();
        $name = $this->promptForArgument($this->argument('name'));
        $route = $this->viewPathName($this->domain, $name);
        $fullPath = $this->makeDirectory($name);

        $this->buildClass($route, $fullPath, $name);
        static::$lastCreated = $fullName = str_replace('.', '/', $route.'.form');
        ! $this->isSilence() && $this->info("View $fullName Created Successfully");
    }

    private function promptForArgument($value = null): string
    {
        if (is_string($value) && ! blank($value)) {
            if (! preg_match('/^\pL+$/u', $value)) {
                return $this->promptForArgument($this->ask('Please Enter a valid model name'));
            }

            return Str::of($value)
                      ->singular()
                      ->studly();
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

    private function makeDirectory(string $name)
    {
        $path = $this->viewPath(strtolower($this->domain)).DIRECTORY_SEPARATOR.Str::of($name)
                                                                                  ->snake()
                                                                                  ->pluralStudly();
        if (! File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    private function buildClass(string $route, string $path, string $name)
    {
        $stubForm = Str::of(File::get(__DIR__.'/../Stubs/view.form.stub'))
                       ->replace('{{ route }}', $route)
                       ->replace('{{ name }}', Str::plural($name))
                       ->replace('{{ inputs }}', $this->formInputs($name));

        $form = $path.DIRECTORY_SEPARATOR.'form.blade.php';

        File::put($form, $stubForm);
    }

    private function formInputs(string $name): string
    {
        $model = new ("App\\Domain\\{$this->domain}\\Models\\{$name}");
        $form = '';
        $columns = $this->getFilteredColumns($model);
        foreach ($columns as $column) {
            $generator = match ($column->Type) {
                'json' => $this->generateJsonInput($column->Field, $model),
                'timestamp', 'date', 'datetime' => $this->generateDateInput($column->Field),
                $this->getNumberTypes($column->Type) => $this->generateNumberInput($column->Field),
                default => $this->generateTextInput($column->Field)
            };
            $form .= $generator."\n";
        }

        return $form;
    }

    private function getFilteredColumns(mixed $model): array
    {
        $columns = DB::select(DB::raw('SHOW COLUMNS FROM '.$model->getTable()));

        return array_filter($columns, function ($column) use ($model) {
            $columnsNames = ! in_array($column->Field, [
                $model->getKeyName(),
                'created_at',
                'updated_at',
                'deleted_at',
            ], true);
            $columnsTypes = ! in_array($column->Type, [], true);

            return $columnsNames && $columnsTypes;
        });
    }

    private function generateTextInput($name): string
    {
        $viewName = ucwords(str_replace(['-', '_'], ' ', $name));

        return <<<HTML
            <x-ui::form.input name="$name" :label="__('$viewName')"/>
        HTML;
    }

    private function generateJsonInput($name, $model)
    {
        $isTranslatable = class_uses($model, HasTranslations::class) && in_array($name,
                $model->translatable ?? [], true);
        $viewName = ucwords(str_replace(['-', '_'], ' ', $name));
        $translate = <<<HTML
            <x-ui::locale.input name="$name" :label="__('$viewName')"/>
        HTML;

        $select = <<<HTML
            <x-ui::locale.select class="select2" name="$name" :options="[]" :label="__('$viewName')"/>
        HTML;

        return $isTranslatable ? $translate : $select;
    }

    private function generateDateInput($name)
    {
        $viewName = ucwords(str_replace(['-', '_'], ' ', $name));

        //todo change this to date picker
        return <<<HTML
            <x-ui::form.input name="$name" type="date" :label="__('$viewName')"/>
        HTML;
    }

    private function getNumberTypes($type)
    {
        return Str::of($type)->contains([
            'int', 'smallint', 'bigint', 'float', 'decimal',
        ]) ? $type : false;
    }

    private function generateNumberInput($name): string
    {
        $viewName = ucwords(str_replace(['-', '_'], ' ', $name));

        return <<<HTML
           <x-ui::form.input type="number" min="0" max="100000000" name="$name" :label="__('$viewName')"/>
        HTML;
    }
}
