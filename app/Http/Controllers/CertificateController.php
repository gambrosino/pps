<?php

namespace App\Http\Controllers;

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
            'certificate_number' => 'required|integer',
            'description' => 'required|string'
        ]);

        $professionalPractice->certificate()->create($certificate);

        return redirect('/');
    }
}
