<?php

namespace App\Http\View\Composers\Home;

use Illuminate\View\View;

class AdminComposer
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
        $buttons = collect([
            ['route' => route('solicitude.index'), 'text' => 'Ver Solicitudes'],
            ['route' => route('professional-practices.index'), 'text' => 'Practicas Profesionales'],
//            ['route' => '', 'text' => 'Revisiones'],
//            ['route' => '', 'text' => 'Alumnos'],
//            ['route' => '', 'text' => 'Tutores'],
        ])//->shuffle()
        ->all();

        $view->with('buttons', $buttons);
    }
}
