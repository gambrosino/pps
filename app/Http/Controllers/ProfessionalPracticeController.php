<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfessionalPracticeController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'tutor_id' => 'required',
            'solicitude_id' => 'required',
        ]);

        $tutor = User::findOrFail($request->get('tutor_id'));

        $professionalPractice = $tutor->supervisedPractices()->create($request->all(['solicitude_id']));

        $professionalPractice->solicitude->update(['status' => 'accepted']);

        return redirect('solicitudes');
    }
}
