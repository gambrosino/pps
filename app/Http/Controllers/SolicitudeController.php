<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitude;

class SolicitudeController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitude::whereStatus('pending')->get();

        return view('solicitudes.index', compact('solicitudes'));
    }

    public function show(Solicitude $solicitude)
    {
        $solicitude->load('student');

        return view('solicitudes.show', compact('solicitude'));
    }

    public function create()
    {
        return view('solicitudes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'attachment' => 'required|mimes:pdf|max:20048'
        ]);

        $solicitude = $request->only('description');

        $solicitude['path'] = $request->file('attachment')->store('', ['disk' => 'solicitude']);

        auth()->user()->solicitudes()->create($solicitude);

        return redirect()->route('home');
    }
}
