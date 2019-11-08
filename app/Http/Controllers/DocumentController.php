<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    public function update(Document $document, Request $request)
    {
        $status = $request->validate([
            'status' => 'required|string|in:accepted,rejected'
        ]);

        $document->update($status);

        return redirect()->route('professional-practices.index');
    }
}
