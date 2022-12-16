<?php

namespace App\Support\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LocalizeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hsm:localize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate locale json file with all words from resource';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $baseFile = resource_path('lang/ar.json');
        $words = ! File::exists($baseFile) ? [] : json_decode(file_get_contents($baseFile), true);
        $files = File::allFiles(resource_path());
        $appFiles = File::allFiles(app_path());
        $configFiles = File::allFiles(config_path());
        $views = File::allFiles(resource_path('views'));
        $files = array_merge($files, $appFiles, $configFiles);
        $newWords = [];
        foreach ($files as $file) {
            if ($file->getFileName() === 'LocalizeCommand.php') {
                continue;
            }
            $underScore = Str::of($file->getContents())
                             ->matchAll("/__\(['\"].*?['\"]\)/");
            $AtDirective = Str::of($file->getContents())
                              ->matchAll("/@lang\(['\"].*?['\"]\)/");
            $handler = static function ($item) use (&$words, &$newWords) {
                $word = (string) Str::of((string) $item)
                                    ->replace("@lang('", '')
                                    ->replace('@lang("', '')
                                    ->replace("__('", '')
                                    ->replace("')", '')
                                    ->replace('__("', '')
                                    ->replace('")', '');

                if (! isset($words[$word])) {
                    $newWords[$word] = $word;
                }
            };
            $underScore->each($handler);
            $AtDirective->each($handler);
        }
        $file = 'hsm_locale_'.time().'.json';
        file_put_contents(resource_path('lang/'.$file), json_encode($newWords));
        echo 'exporting language done successfully '.$file.PHP_EOL;

        return 0;
    }
}
