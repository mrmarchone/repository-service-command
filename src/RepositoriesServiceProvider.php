<?php

namespace Mrmarchone\Repositories;

use Illuminate\Support\ServiceProvider;
use Mrmarchone\Repositories\Console\Commands\Repository;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Console/Commands' => base_path('app/Console/Commands')
        ]);
        $this->commands([
            Repository::class,
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Code Below
    }
}
