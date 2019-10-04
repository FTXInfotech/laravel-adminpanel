<?php

namespace App\Providers;

use App\Services\Active\Active;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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
        $instance = app('active');

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
        $this->app->singleton(
            'active',
            function ($app) {
                $instance = new Active($app['router']->getCurrentRequest());
                return $instance;
            }
        );
    }
}
