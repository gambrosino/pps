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
}
