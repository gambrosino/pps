<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitude;

class SolicitudeController extends Controller
{
    public function store(Request $request) {

        $solicitude = $this->validate($request, [
            'description' => 'required',
            'status' => ''
        ]);

        auth()->user()->solicitudes()->create($solicitude);

        return redirect('solicitudes');
    }
}
