<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NotificationProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton('notificationRepo', function () {
            return new \App\Services\NotificationRepo();
        });$this->app->singleton('notificationRepo', function () {
            return new \App\Services\NotificationRepo();
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
