<?php

namespace App\Http\Controllers;

use App\Revision;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
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
