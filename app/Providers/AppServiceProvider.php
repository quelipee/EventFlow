<?php

namespace App\Providers;

use App\EventDomain\contracts\EventContract;
use App\EventDomain\services\EventService;
use App\UserDomain\contracts\UserAccountContract;
use App\UserDomain\services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserAccountContract::class, function ($app) {
            return new UserService();
        });

        $this->app->bind(EventContract::class, function ($app) {
            return new EventService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
