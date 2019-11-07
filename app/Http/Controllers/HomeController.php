<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        $buttons = [];

        if ($user->role->name == Role::admin()->name) {
            $buttons = collect([
                ['route' => route('solicitude.index'), 'text' => 'Ver Solicitudes'],
                ['route' => route('professional-practices.index'), 'text' => 'PPS'],
                ['route' => '', 'text' => 'Revisiones'],
                ['route' => '', 'text' => 'Alumnos'],
                ['route' => '', 'text' => 'Tutores'],
            ])//->shuffle()
                ->all();
        }

        return view('home', compact('user', 'buttons'));
    }
}
