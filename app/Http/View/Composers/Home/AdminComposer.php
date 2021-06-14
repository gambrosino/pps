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
            ['route' => route('users.create'), 'text' => 'Añadir Usuario'],
            ['route' => route('solicitude.index').'?status=pending', 'text' => 'Ver Solicitudes Pendientes'],
            ['route' => route('professional-practices.index').'?status=in_revision', 'text' => 'Practicas Profesionales en Revisión'],
//            ['route' => '', 'text' => 'Alumnos'],
//            ['route' => '', 'text' => 'Tutores'],
        ])//->shuffle()
        ->all();

        $view->with('buttons', $buttons);
    }
}
