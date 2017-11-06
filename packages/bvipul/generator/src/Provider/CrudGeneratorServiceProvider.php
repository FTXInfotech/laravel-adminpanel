<?php

namespace Bvipul\Generator\Provider;

use Illuminate\Support\ServiceProvider;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'generator');
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'generator');
        $this->publishes([
            __DIR__.'/../views' => base_path('resources/views/vendor/generator'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/../routes.php';
        require __DIR__.'/../breadcrumbs.php';
        require_once(__DIR__.'/../helpers.php');
        $this->app->make('Bvipul\Generator\Module');
        $this->app->make('Bvipul\Generator\Controllers\Generator');
        $this->app->make('Bvipul\Generator\Controllers\ModuleController');
        $this->app->make('Bvipul\Generator\Repositories\ModuleRepository');
        $this->app->make('Bvipul\Generator\Controllers\ModuleTableController');
    }
}
