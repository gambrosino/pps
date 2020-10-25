<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $guarded = [];

    public function professionalPractice()
    {
        return $this->belongsTo(ProfessionalPractice::class);
    }
}
