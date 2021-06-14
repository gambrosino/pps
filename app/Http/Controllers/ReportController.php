<?php

namespace App\Http\Controllers;

use App\Report;
use App\Document;
use Illuminate\Http\Request;
use App\ProfessionalPractice;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function create(ProfessionalPractice $professionalPractice)
    {
        abort_unless(Auth::user()->id == $professionalPractice->solicitude->student->id,403);
        return view('reports.create', compact('professionalPractice'));
    }

    public function show(Report $report)
    {
        abort_unless(
            Auth::user()->role->name == 'admin' ||
            Auth::user()->id == $report->professionalPractice->tutor->id ||
            Auth::user()->id == $report->professionalPractice->solicitude->student->id
            ,403);

        return view('reports.show', compact('report'));
    }

    public function store(Request $request, ProfessionalPractice $professionalPractice)
    {
        abort_unless(Auth::user()->id == $professionalPractice->solicitude->student->id,403);
        $report = $this->validate($request, [
            'title' => 'required|string|min:5'
        ]);
        $request->validate([
            'document' => 'required|mimes:pdf,doc,docx'
        ]);
        $report['path'] = $request->file('document')->store('', ['disk' => 'documents']);
        $professionalPractice->reports()->create($report);

        return redirect()->route('professional-practices.show',$professionalPractice)->with('message','Informe Final Creado');
    }

    public function update(Request $request, Report $report)
    {
        abort_unless(
            Auth::user()->role->name == 'admin' ||
            Auth::user()->id == $report->professionalPractice->tutor->id
            ,403);
        $status = $request->validate([
            'status'  => 'required|string|in:accepted,rejected',
            'message' => 'required|string|min:10'
        ]);
        $report->customUpdate($status);

        return redirect()->route('professional-practices.show',$report->professionalPractice)->with('message','Informe Final Actualizado');;
    }
}
