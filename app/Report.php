<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $guarded = [];

    public function professionalPractice()
    {
        return $this->belongsTo(ProfessionalPractice::class);
    }

    public function customUpdate($status)
    {
        $this->update($status);

        $this->professionalPractice->checkReportStatus();
    }
}
