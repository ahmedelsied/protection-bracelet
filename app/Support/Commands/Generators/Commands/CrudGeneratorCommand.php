<?php

namespace App\Support\Commands\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrudGeneratorCommand extends Command
{
    protected $signature = 'generate:crud {--domain=} {--model=} {--M|migration}';

    protected $description = 'Generate a new crud';

    public function handle()
    {
        $controller = $this->getController();
        $datatable = $this->getDatatable();
        $domain = $this->getDomain();
        $model = $this->getModel();
        $view = Str::replace('.', '/', $this->getView($domain, $model));

        $modelName = Str::snake(Str::pluralStudly($model));
        // add new Permission in CorePermissions
//        $this->AddNewPermission($modelName);

        $this->info("Creating(Domain)     :   App\Domain\\{$domain}");
        $this->info("Creating(Model)      :   App\Domain\\{$domain}\Models\\{$model}");
        $this->info("Creating(Datatable)  :   App\Domain\\{$domain}\Datatables\\{$datatable}");
        $this->info("Creating(Controller) :   App\Http\Controllers\Dashboard\\{$domain}\\{$controller}");
        $this->info("Creating(View)       :   views/{$view}");
        if ($this->option('migration')) {
            $table = Str::snake(Str::pluralStudly($model));
            $migrationName = "create_{$table}_table";
            $this->callSilent('make:migration', [
                'name' => $migrationName,
                '--create' => $table,
            ]);
            $this->info("Creating(migration)       :   database/migrations/{$migrationName}");
        }
//        $this->createFormView($domain, $model);
    }

    private function getDomain(): ?string
    {
        return DomainGeneratorCommand::lastCreated();
    }

    private function AddNewPermission($modelName)
    {
        $permissionPath = base_path().'/App/Domain/Core/Enums/CorePermissions.php';
        $search = '/**';
        $line_number = false;

        if ($handle = fopen($permissionPath, 'r')) {
            $count = 0;
            while (($line = fgets($handle, 4096)) !== false and ! $line_number) {
                $count++;
                $line_number = (strpos($line, $search) !== false) ? $count : $line_number;
            }
            fclose($handle);
        }

        $lines = file($permissionPath, FILE_IGNORE_NEW_LINES);

        $newLine = ["* @method static self {$modelName}()"];
        $searchIfExist = array_search("* @method static self {$modelName}()", $lines, true);
        if ($searchIfExist == false) {
            array_splice($lines, $line_number + 1, 0, $newLine);
            file_put_contents($permissionPath, implode("\n", $lines));
        }
    }

    private function getView($domain, $model): ?string
    {
        $this->runCommand(
            ViewGeneratorCommand::class, [
                'domain' => $domain,
                'name' => $model,
                '--silence' => 1,
            ],
            $this->getOutput()
        );

        return ViewGeneratorCommand::lastCreated();
    }

    private function getModel(): ?string
    {
        return ModelGeneratorCommand::lastCreated();
    }

    private function getDatatable(): ?string
    {
        return DatatableGeneratorCommand::lastCreated();
    }

    private function getController(): ?string
    {
        $this->runCommand(
            ControllerGeneratorCommand::class,
            [
                '--silence' => 1,
                '--domain' => $this->option('domain'),
                '--model' => $this->option('model'),
            ],
            $this->getOutput()
        );

        return ControllerGeneratorCommand::lastCreated();
    }

    private function createFormView($domain, $model)
    {
        $this->callSilent(ViewFormGeneratorCommand::class,
            ['domain' => $domain, 'name' => $model, '--silence' => 1]);
    }
}
