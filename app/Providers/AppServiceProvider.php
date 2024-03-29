<?php

namespace App\Providers;

use App\Support\Dashboard\CustomVite;
use App\Support\Services\APIResponse\JsonResponder;
use HsmFawaz\UI\Providers\UIServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(UIServiceProvider::class);
        $this->app->singleton('api-responder', function () {
            return new JsonResponder();
        });
    }

    public function boot()
    {
        Validator::includeUnvalidatedArrayKeys();
        View::composer('ui::layout.master', static function ($view) {
            $routes = require resource_path('sidebar/sidebar.php');
            $view->with('sidebarRoutes', $routes);
        });
        
        Blade::directive('customvite', function ($arguments) {
            $arguments = '('.$arguments.')';
            $class = CustomVite::class;

            return "<?php echo app('$class'){$arguments}; ?>";
        });
    }
}
