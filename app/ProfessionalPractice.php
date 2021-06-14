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

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function getAcceptedHoursAttribute()
    {
        return $this->revisions()->where('status','accepted')->get()->reduce(function ($totalHours, $revision) {
            return $totalHours + $revision->documents->last()->hours;
        });
    }

    public function getAcceptedRevisions()
    {
        return $this->revisions()->where(['status'=>'accepted'])->get();
    }

    public function getNonAcceptedRevisions()
    {
        return $this->revisions()->where('status','<>','accepted')->get();
    }

    public function checkTotalHours()
    {
        if($this->getAcceptedHoursAttribute() >= 200 && $this->status == 'active')
        {
            $this->update(['status'=>'hours_completed']);
        }
    }

    public function checkReportStatus()
    {
        if($this->reports()->get()->last()->status == 'accepted')
        {
            $this->update(['status'=>'in_revision']);
        }
    }

    public function complete()
    {
        if($this->status == 'in_revision')
        {
            $this->update(['status'=>'completed']);
        }
    }

    public function canAddNewReport()
    {
        $hoursCompleted = $this->status == 'hours_completed';
        $noReports = $this->reports->count() == 0;
        $inRevision = $this->status == 'in_revision';
        if (!$noReports) {
            $rejectedReport = $this->reports->last()->status == 'rejected';
        }
        return ($hoursCompleted && $noReports) || (($hoursCompleted || $inRevision) && $rejectedReport);
    }
}
