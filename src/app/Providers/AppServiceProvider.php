<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class,
        );
        $this->app->bind(
            \App\Repositories\NicheSpot\NicheSpotRepositoryInterface::class,
            \App\Repositories\NicheSpot\NicheSpotRepository::class,
        );
        $this->app->bind(
            \App\Repositories\NicheSpotImage\NicheSpotImageRepositoryInterface::class,
            \App\Repositories\NicheSpotImage\NicheSpotImageRepository::class,
        );
    }
}
