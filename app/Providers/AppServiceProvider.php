<?php

namespace App\Providers;

use App\User;
use App\Solicitude;
use App\ProfessionalPractice;
use App\Revision;
use App\Report;
use App\Observers\UserObserver;
use App\Observers\SolicitudeObserver;
use App\Observers\ProfessionalPracticeObserver;
use App\Observers\RevisionObserver;
use App\Observers\ReportObserver;
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
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(\Laravel\Dusk\DuskServiceProvider::class);
        }

        User::observe(UserObserver::class);
        Solicitude::observe(SolicitudeObserver::class);
        ProfessionalPractice::observe(ProfessionalPracticeObserver::class);
        Revision::observe(RevisionObserver::class);
        Report::observe(ReportObserver::class);
    }
}
