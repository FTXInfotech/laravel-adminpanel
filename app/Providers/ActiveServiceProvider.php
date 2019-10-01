<?php

namespace App\Providers;

use App\Services\Active\Active;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ActiveServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        // Update the instances each time a request is resolved and a route is matched
        $instance = new Active(request());

        if (version_compare(Application::VERSION, '5.2.0', '>=')) {
            app('router')->matched(
                function (RouteMatched $event) use ($instance) {
                    $instance->updateInstances($event->route, $event->request);
                }
            );
        } else {
            app('router')->matched(
                function ($route, $request) use ($instance) {
                    $instance->updateInstances($route, $request);
                }
            );
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerActive();
        $this->registerFacade();


        // $this->app->singleton(
        //     'active',
        //     function ($app) {

        //         $instance = new Active($app['router']->getCurrentRequest());

        //         return $instance;
        //     }
        // );
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerActive()
    {
        $this->app->bind('active', function ($app) {
            return new Active($app['router']->getCurrentRequest());
        });
    }

    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade()
    {
        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Active', \App\Services\Access\Facades\Active::class);
        });
    }

}
