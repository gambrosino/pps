<?php

namespace App;

use App\Document;
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

    public function attachDocument($path)
    {
        $this->documents()->create(['path' => $path]);
    }
}
