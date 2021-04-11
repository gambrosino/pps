<?php

namespace App\Providers;

use App\User;
use App\Report;
use App\Revision;
use App\Solicitude;
use App\Certificate;
use App\ProfessionalPractice;
use App\Observers\UserObserver;
use App\Observers\ReportObserver;
use App\Observers\RevisionObserver;
use Illuminate\Pagination\Paginator;
use App\Observers\SolicitudeObserver;
use App\Observers\CertificateObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\ProfessionalPracticeObserver;

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
        Certificate::observe(CertificateObserver::Class);
    }
}
