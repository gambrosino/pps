<?php

namespace App\Http\Controllers;

use App\ProfessionalPractice;
use App\Report;
use App\Document;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function create(ProfessionalPractice $professionalPractice)
    {
        return view('reports.create', compact('professionalPractice'));
    }

    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    public function store(Request $request, ProfessionalPractice $professionalPractice)
    {
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
        $status = $request->validate([
            'status'  => 'required|string|in:accepted,rejected',
            'message' => 'required|string|min:20'
        ]);
        $report->customUpdate($status);

        return redirect('/')->with('message','Informe Final Actualizado');;
    }
}
