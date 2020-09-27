<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $guarded = [];

    public function professionalPractice()
    {
        return $this->belongsTo(ProfessionalPractice::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function attachDocument($document)
    {
        $this->documents()->create($document);
    }

    /*public function getOverallStatus()
    {
        $documents = $this->documents;
        $accepted = $documents->every(function ($document) {
            return $document->status == 'accepted';
        });

        if ($documents->isNotEmpty() && $accepted) {
            return 'accepted';
        } else {
            return $documents->contains(function ($document, $key) {
                return $document->status == 'rejected';
            }) ? 'rejected' : 'in-review';
        }
    }*/
}
