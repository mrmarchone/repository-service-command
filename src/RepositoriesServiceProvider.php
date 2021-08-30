<?php

namespace Mrmarchone\Repositories;

use Illuminate\Support\ServiceProvider;
use Mrmarchone\Repositories\Commands\Commands\Repository;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.create.repo', function ($app) {
            return new Commands\Repository;
        });
        $this->commands([
            Commands\Repository::class
        ]);
    }

    public function provides()
    {
        return [
            'command.create.repo'
        ];
    }
}
