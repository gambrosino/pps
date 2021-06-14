<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfessionalPractice;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function create(ProfessionalPractice $professionalPractice)
    {
        abort_unless(Auth::user()->role->name == 'admin' ,403);
        return view('certificate.create', compact('professionalPractice'));
    }

    public function store(Request $request, ProfessionalPractice $professionalPractice)
    {
        abort_unless(Auth::user()->role->name == 'admin' ,403);
        $certificate = $this->validate($request, [
            'number' => 'required|integer',
            'folio' => 'required|integer',
            'note' => 'required|integer'
        ]);
        $professionalPractice->certificates()->create($certificate);
        $professionalPractice->complete();

        return redirect('/')->with('message','Practica Profesional Completada!');
    }
}
