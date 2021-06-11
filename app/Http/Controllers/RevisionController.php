<?php

namespace App\Http\Controllers;

use App\Document;
use App\Revision;
use Illuminate\Http\Request;
use App\ProfessionalPractice;
use Illuminate\Support\Facades\Auth;

class RevisionController extends Controller
{
    public function create(ProfessionalPractice $professionalPractice)
    {
        return view('revisions.create', compact('professionalPractice'));
    }

    public function show(Revision $revision)
    {
        abort_unless(
            Auth::user()->role->name == 'admin' ||
            Auth::user()->id == $revision->professionalPractice->tutor->id ||
            Auth::user()->id == $revision->professionalPractice->solicitude->student->id
            ,403);

        $revision->load('documents');

        return view('revisions.show', compact('revision'));
    }

    public function store(Request $request, ProfessionalPractice $professionalPractice)
    {
        $revision = $this->validate($request, [
            'description' => 'required|string|min:10'
        ]);
        $request->validate([
            'title' => 'required|string|min:5',
            'document' => 'required|mimes:pdf,doc,docx',
            'hours' =>'required|numeric|min:0|max:20'
        ]);

        $path = $request->file('document')->store('', ['disk' => 'documents']);

        $document = Document::make(['title' => request('title'), 'path' => $path, 'hours' => request('hours')] )->toArray();

        $professionalPractice->revisions()->create($revision);

        $professionalPractice->revisions()->get()->last()->attachDocument($document);

        return redirect()->route('professional-practices.show',$professionalPractice)->with('message','Revision Creada');
    }

    public function update(Request $request, Revision $revision)
    {
        abort_unless(
            Auth::user()->role->name == 'admin' ||
            Auth::user()->id == $revision->professionalPractice->tutor->id
            ,403);

        $request->validate([
            'title' => 'required|string|min:5',
            'document' => 'required|mimes:pdf,doc,docx',
            'hours' =>'required|numeric|min:0'
        ]);

        $path = $request->file('document')->store('', ['disk' => 'documents']);

        $document = Document::make(['title' => request('title'), 'path' => $path, 'hours' => request('hours')] )->toArray();

        $revision->attachDocument($document);

        $revision->update(['status'=>'pending']);

        return redirect()->route('professional-practices.show',$revision->professionalPractice)->with('message','Revision Actualizada');
    }
}
