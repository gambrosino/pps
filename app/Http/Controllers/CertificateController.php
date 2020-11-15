<?php

namespace App\Http\Controllers;

use App\ProfessionalPractice;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function create(ProfessionalPractice $professionalPractice)
    {
        return view('certificate.create', compact('professionalPractice'));
    }

    public function store(Request $request, ProfessionalPractice $professionalPractice)
    {
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
