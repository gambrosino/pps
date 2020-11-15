<?php

namespace App\Observers;

use App\Report;
use App\Mail\NewReport;
use App\Mail\ReportUpdated;
use Illuminate\Support\Facades\Mail;

class ReportObserver
{
    /**
     * Handle the report "created" event.
     *
     * @param  \App\Report  $report
     * @return void
     */
    public function created(Report $report)
    {
        $tutor = $report->professionalPractice->tutor;
        Mail::to($tutor)->send(new NewReport($report));
    }

    /**
     * Handle the report "updated" event.
     *
     * @param  \App\Report  $report
     * @return void
     */
    public function updated(Report $report)
    {
        $student = $report->professionalPractice->solicitude->student;
        Mail::to($student)->send(new ReportUpdated($report));
    }
}
