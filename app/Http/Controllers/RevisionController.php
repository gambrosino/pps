<?php

namespace App\Http\Controllers;

use App\ProfessionalPractice;
use App\Revision;
use App\Document;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    public function create(ProfessionalPractice $professionalPractice)
    {
        return view('revisions.create', compact('professionalPractice'));
    }

    public function show(Revision $revision)
    {
        $revision->load('documents');

        return view('revisions.show', compact('revision'));
    }

    public function store(Request $request, ProfessionalPractice $professionalPractice)
    {

        $revision = $this->validate($request, [
            'description' => 'required|string|min:10',
            'hours' =>'required|numeric|min:0'
        ]);

        $professionalPractice->revisions()->create($revision);

        return redirect('/');
    }

    public function update(Request $request, Revision $revision)
    {
        $request->validate([
            'title' => 'required|string|min:5',
            'document' => 'required|mimes:pdf,doc,docx'
        ]);

        $path = $request->file('document')->store('', ['disk' => 'documents']);

        $document = Document::make(['title' => request('title'), 'path' => $path])->toArray();

        $revision->attachDocument($document);

        return redirect('/home');
    }
}
