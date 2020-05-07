<?php

namespace Niomin\B2BrokerTest\Providers;

use Illuminate\Support\ServiceProvider;
use Niomin\B2BrokerTest\Contracts\RepositoryInterface;
use Niomin\B2BrokerTest\Http\Controllers\B2BrokerController;
use Niomin\B2BrokerTest\Repositories\B2BrokerRequestRepository;

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
        $this->app->bind(
            RepositoryInterface::class,
            config('b2broker.repositoryClass', B2BrokerRequestRepository::class)
        );
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
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/');
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
    }
}
