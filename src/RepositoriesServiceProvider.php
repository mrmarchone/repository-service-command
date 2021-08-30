<?php

namespace Mrmarchone\Repositories;

use Illuminate\Support\ServiceProvider;
use Mrmarchone\Repositories\Commands\Repository;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            Repository::class
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
