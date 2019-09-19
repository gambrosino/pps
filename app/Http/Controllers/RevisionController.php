<?php

namespace App\Http\Controllers;

use App\ProfessionalPractice;
use App\Revision;
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
            'document' => 'required|mimes:pdf,doc,docx'
        ]);

        $path = $request->file('document')->store('documents');

        $revision->attachDocument($path);

        return redirect('/home');
    }
}
