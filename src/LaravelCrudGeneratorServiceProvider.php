<?php
namespace Mlsg\LaravelCrudGenerator;

use Illuminate\Support\ServiceProvider;
use Mlsg\LaravelCrudGenerator\CrudControllerMakeCommand;

class LaravelCrudGeneratorServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/crud-make.php';

        $publishPath = config_path('crud-make.php');

        $this->publishes([$configPath => $publishPath], 'config');
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__ . '/../config/crud-make.php';
        $this->mergeConfigFrom($configPath, 'crud-make');
        $this->commands([CrudControllerMakeCommand::class]);
    }

}