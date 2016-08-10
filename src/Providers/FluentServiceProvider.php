<?php

namespace Iluminar\Fluent\Providers;

use Illuminate\Support\ServiceProvider;

class FluentServiceProvider extends ServiceProvider
{
     /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Iluminar\Fluent\Controllers';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            $this->app->router->group(['namespace' => $this->namespace], function() {
                require __DIR__.'/../routes/routes.php';
            });
        }
        $this->publishes([
            __DIR__.'/../config/fluent.php' => config_path('fluent.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../migrations' => database_path('migrations')
        ], 'migrations');
        $this->publishes([
            __DIR__.'/../views/' => base_path('resources/views'),
        ], 'assets');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Iluminar\Fluent\Controllers\FluentAuthController');
    }
}
