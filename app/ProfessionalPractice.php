<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionalPractice extends Model
{
    protected $guarded = [];

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function solicitude()
    {
        return $this->belongsTo(Solicitude::class);
    }

    public function revisions()
    {
        return $this->hasMany(Revision::class);
    }
}
