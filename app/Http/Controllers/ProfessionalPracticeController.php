<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Setting;
use App\Solicitude;
use Illuminate\Http\Request;
use App\ProfessionalPractice;
use Illuminate\Support\Facades\Auth;

class ProfessionalPracticeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Auth::user()->role->name == 'student',403);
        if ($request->status == 'active') {
            $professionalPractices = ProfessionalPractice::with(['solicitude.student', 'tutor', 'revisions'])
                ->where([ 'status' => $request->status ])
                ->orWhere([ 'status' => 'hours_completed' ])
                ->get();
        } else {
            $professionalPractices = ProfessionalPractice::with(['solicitude.student', 'tutor', 'revisions'])
            ->where([ 'status' => $request->status ])
            ->get();
        }
        $status = '';
        switch($request->status) {
            case 'active': $status = 'activas';break;
            case 'in_revision': $status = 'en revision';break;
            case 'completed': $status = 'completadas';break;
        }
        $status = ["status" => $status];

        return view('pps.index', compact('professionalPractices', 'status'));
    }

    public function show(ProfessionalPractice $professionalPractice)
    {
        abort_unless(
            Auth::user()->role->name == 'admin' ||
            Auth::user()->id == $professionalPractice->tutor->id ||
            Auth::user()->id == $professionalPractice->solicitude->student->id
            ,403);
        $professionalPractice->load(['solicitude.student', 'revisions', 'tutor']);
        $setting = Setting::find(1);

        return view('pps.show', compact('professionalPractice', 'setting'));
    }

    public function create(Solicitude $solicitude)
    {
        abort_unless(Auth::user()->role->name == 'admin',403);
        $tutors = User::whereHas('role', function ($query) {
            $query->whereName(Role::tutor()->name);
        })->get();

        return view('pps.create', compact('solicitude', 'tutors'));
    }

    public function store(Request $request)
    {
        abort_unless(Auth::user()->role->name == 'admin',403);
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
