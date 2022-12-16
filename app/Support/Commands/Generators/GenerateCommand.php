<?php

namespace App\Support\Commands\Generators;

use App\Support\Commands\Generators\Commands\ControllerGeneratorCommand;
use App\Support\Commands\Generators\Commands\CrudGeneratorCommand;
use App\Support\Commands\Generators\Commands\DomainGeneratorCommand;
use App\Support\Commands\Generators\Commands\ModelGeneratorCommand;
use App\Support\Commands\Generators\Commands\ViewFormGeneratorCommand;
use App\Support\Commands\Generators\Commands\ViewGeneratorCommand;
use Illuminate\Console\Command;

class GenerateCommand extends Command
{
    protected $signature = 'generate';

    protected $description = 'Command line ui for generating files';

    public function handle()
    {
        $generators = $this->getGenerators();
        $command = $this->choice(
            'What do you want to generate ?', array_keys($generators), 'crud'
        );
        $this->runCommand($generators[$command], [], $this->getOutput());
    }

    private function getGenerators()
    {
        return [
            'crud' => CrudGeneratorCommand::class,
            'domain' => DomainGeneratorCommand::class,
            'model' => ModelGeneratorCommand::class,
            'view' => ViewGeneratorCommand::class,
            'view-form' => ViewFormGeneratorCommand::class,
            'resource' => BaseGeneratorCommand::class,
            'request' => BaseGeneratorCommand::class,
            'command' => BaseGeneratorCommand::class,
            'controller' => ControllerGeneratorCommand::class,
        ];
    }
}
