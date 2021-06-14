<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function show(Document $document)
    {
        abort_unless(
            Auth::user()->role->name == 'admin' ||
            Auth::user()->id == $document->revision->professionalPractice->tutor->id ||
            Auth::user()->id == $document->revision->professionalPractice->solicitude->student->id
            ,403);

        return view('documents.show', compact('document'));
    }

    public function update(Document $document, Request $request)
    {
        abort_unless(
            Auth::user()->role->name == 'admin' ||
            Auth::user()->id == $document->revision->professionalPractice->tutor->id
            ,403);

        $status = $request->validate([
            'status'  => 'required|string|in:accepted,rejected',
            'message' => 'required|string|min:10'
        ]);
        $document->customUpdate($status);

        return redirect()->route('professional-practices.show',$document->revision->professionalPractice)->with('message','Revision Actualizada');
    }
}
