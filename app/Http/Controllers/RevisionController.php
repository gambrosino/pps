<?php

namespace App\Http\Controllers;

use App\ProfessionalPractice;
use App\Revision;
use App\Document;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    public function store(Request $request, ProfessionalPractice $professionalPractice)
    {
        $revision = $this->validate($request, [
            'description' => 'required|string|min:10'
        ]);

        $professionalPractice->revisions()->create($revision);

        return redirect('/home');
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
