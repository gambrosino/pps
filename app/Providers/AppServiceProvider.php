<?php

namespace App\Providers;

use App\Solicitude;
use App\Observers\SolicitudeObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Solicitude::observe(SolicitudeObserver::class);
    }
}
