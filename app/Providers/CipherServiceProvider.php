<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CipherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
         $this->app->singleton('fourCharCipher', function () {
            return new \App\Services\FourCharCipher();
        });$this->app->singleton('fourCharCipher', function () {
            return new \App\Services\FourCharCipher();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
