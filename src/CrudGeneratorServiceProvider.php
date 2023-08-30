<?php

namespace Aminul\CrudGenerator;

use Illuminate\Support\ServiceProvider;
use Aminul\CrudGenerator\Commands\CrudGenerator;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/resources/stubs', 'CrudGenerator');

        $this->publishes([
            __DIR__.'/resources/stubs' => resource_path('vendor/aminul/stubs'),
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
           CrudGenerator::class,
        ]);
    }
}
