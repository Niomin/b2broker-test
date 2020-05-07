<?php

namespace Niomin\B2BrokerTest\Providers;

use Illuminate\Support\ServiceProvider;
use Niomin\B2BrokerTest\Http\Controllers\B2BrokerController;

class B2BrokerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $this->app->make(B2BrokerController::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/b2broker.php' => config_path('b2broker.php'),
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/2020_05_06_235228_b2broker_request.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
    }
}
