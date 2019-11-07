<?php

namespace App\Http\Controllers;

use App\Role;
use App\Solicitude;
use App\User;
use Illuminate\Http\Request;

class ProfessionalPracticeController extends Controller
{
    public function create(Solicitude $solicitude)
    {
        $tutors = User::whereHas('role', function ($query) {
            $query->whereName(Role::tutor()->name);
        })->get();

        return view('pps.create', compact('solicitude', 'tutors'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tutor_id' => 'required|exists:users,id',
            'solicitude_id' => 'required|exists:solicitudes,id',
        ]);

        $tutor = User::findOrFail($request->get('tutor_id'));

        $professionalPractice = $tutor->supervisedPractices()->create($request->all(['solicitude_id']));

        $professionalPractice->solicitude->update(['status' => 'accepted']);

        return redirect()->route('home');
    }
}
