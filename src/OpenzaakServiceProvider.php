<?php

namespace Woweb\Openzaak;

use Illuminate\Support\ServiceProvider;

class OpenzaakServiceProvider extends ServiceProvider
{
    /**
     * Boot the package
     *
     * @return  void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/openzaak.php' => config_path('openzaak.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/openzaak.php', 'openzaak'
        );
    }
}