<?php

namespace App\Observers;

use App\ProfessionalPractice;
use App\Mail\NewPPS;
use Illuminate\Support\Facades\Mail;

class ProfessionalPracticeObserver
{
    /**
     * Handle the professional practice "created" event.
     *
     * @param  \App\ProfessionalPractice  $professionalPractice
     * @return void
     */
    public function created(ProfessionalPractice $professionalPractice)
    {
        //
    }

    /**
     * Handle the professional practice "updated" event.
     *
     * @param  \App\ProfessionalPractice  $professionalPractice
     * @return void
     */
    public function updated(ProfessionalPractice $professionalPractice)
    {
        if ($professionalPractice->isDirty('status')) {
            $student = $professionalPractice->$solicitude->student;
            Mail::to($student)->send(new ProfessionalPracticeUpdated);
        }
    }
}
