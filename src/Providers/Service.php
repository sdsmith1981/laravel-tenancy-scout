<?php

namespace GeneaLabs\LaravelTenantScout\Providers;

use GeneaLabs\LaravelTenantScout\Console\Import;
use Illuminate\Support\ServiceProvider;

class Service extends ServiceProvider
{
    public function register()
    {
        
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Import::class,
            ]);
        }
    }

    public function provides()
    {
        
    }
}
