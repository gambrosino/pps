<?php

namespace App\Http\View\Composers\Home;

use App\ProfessionalPractice;
use App\Solicitude;
use Illuminate\View\View;

class TutorComposer
{

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $professionalPractices = ProfessionalPractice::with(['solicitude.student', 'tutor', 'revisions'])
            ->where(['status' => 'active'])
            ->get();

        $solicitudes = Solicitude::whereStatus('pending')->get();

        $view->with('professionalPractices', $professionalPractices)
            ->with('solicitudes', $solicitudes);
    }
}
