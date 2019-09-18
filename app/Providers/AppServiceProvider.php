<?php

namespace App\Providers;

use App\Revision;
use App\Solicitude;
use App\Observers\RevisionObserver;
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
        Revision::observe(RevisionObserver::class);
    }
}
