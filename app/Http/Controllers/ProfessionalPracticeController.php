<?php

namespace App\Http\Controllers;

use App\ProfessionalPractice;
use App\Role;
use App\Solicitude;
use App\User;
use Illuminate\Http\Request;

class ProfessionalPracticeController extends Controller
{
    public function index()
    {
        $professionalPracticesActives = ProfessionalPractice::with(['solicitude.student', 'tutor', 'revisions'])
            ->where([ 'status' => 'active' ])
            ->orWhere([ 'status' => 'hours_completed' ])
            ->get();

        $professionalPracticesInRevision = ProfessionalPractice::with(['solicitude.student', 'tutor', 'revisions'])
        ->where([ 'status' => 'in_revision' ])
        ->get();

        $professionalPracticesCompleted = ProfessionalPractice::with(['solicitude.student', 'tutor', 'revisions'])
        ->where([ 'status' => 'completed' ])
        ->get();

        return view('pps.index', compact('professionalPracticesActives', 'professionalPracticesInRevision', 'professionalPracticesCompleted'));
    }

    public function show(ProfessionalPractice $professionalPractice)
    {
        $professionalPractice->load(['solicitude.student', 'revisions', 'tutor']);

        return view('pps.show', compact('professionalPractice'));
    }

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

        return redirect()->route('home')->with('message','Solicitud Aprobada');
    }
}
