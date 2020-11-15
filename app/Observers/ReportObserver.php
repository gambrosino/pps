<?php

namespace App\Observers;

use App\Report;
use App\User;
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
        //send mail to tutor/admin when a revision is corrected
        if($report->professionalPractice->status == 'in_revision') {
            $receipt = User::whereHas('role', function ($q) {
                $q->where('name', 'admin');
            })->get();
        }
        else {
            $receipt = $report->professionalPractice->tutor;
        }
        Mail::to($receipt)->send(new NewReport($report));
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
