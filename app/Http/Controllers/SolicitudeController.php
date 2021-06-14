<?php

namespace App\Http\Controllers;

use App\Solicitude;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudeController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(Auth::user()->role->name == 'admin' ,403);
        $solicitudes = Solicitude::whereStatus($request->status)->get();
        $status = '';
        switch($request->status) {
            case 'accepted': $status = 'aceptadas';break;
            case 'rejected': $status = 'rechazadas';break;
            case 'pending': $status = 'pendientes';break;
        }
        $status = ["status" => $status];

        return view('solicitudes.index', compact('solicitudes','status'));
    }

    public function show(Solicitude $solicitude)
    {
        abort_unless(Auth::user()->role->name == 'admin' || Auth::user()->id == $solicitude->student->id ,403);
        $solicitude->load('student');

        return view('solicitudes.show', compact('solicitude'));
    }

    public function create()
    {
        abort_unless(Auth::user()->id == $solicitude->student->id ,403);
        return view('solicitudes.create');
    }

    public function store(Request $request)
    {
        abort_unless(Auth::user()->id == $solicitude->student->id ,403);
        $this->validate($request, [
            'description' => 'required',
            'attachment' => 'required|mimes:pdf|max:20048'
        ]);
        $solicitude = $request->only('description');
        $solicitude['path'] = $request->file('attachment')->store('', ['disk' => 'solicitude']);
        auth()->user()->solicitudes()->create($solicitude);

        return redirect()->route('home')->with('message','Solicitud Enviada');
    }

    public function update(Request $request, Solicitude $solicitude)
    {
        abort_unless(Auth::user()->role->name == 'admin');
        $fields = $this->validate($request, [
            'message' => 'required|min:20'
        ]);
        $fields['status'] = 'rejected';
        $solicitude->update($fields);

        return redirect()->route('home')->with('message','Solicitud Actualizada');
    }
}
