<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PermissionProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
         //
        $this->app->singleton('permissionService', function () {
            return new \App\Services\PermissionService();
        });$this->app->singleton('permissionService', function () {
            return new \App\Services\PermissionService();
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
