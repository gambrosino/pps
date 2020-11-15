<?php

namespace App\Observers;

use App\ProfessionalPractice;
use App\Mail\NewProfessionalPractice;
use App\Mail\ProfessionalPracticeUpdated;
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
        $tutor = $professionalPractice->tutor;
        Mail::to($tutor)->send(new NewProfessionalPractice($professionalPractice));
    }

    /**
     * Handle the professional practice "updated" event.
     *
     * @param  \App\ProfessionalPractice  $professionalPractice
     * @return void
     */
    public function updated(ProfessionalPractice $professionalPractice)
    {
        if ($professionalPractice->isDirty('status') && $professionalPractice->revisions->count() > 0) {
            $student = $professionalPractice->solicitude->student;
            Mail::to($student)->send(new ProfessionalPracticeUpdated);
        }
    }
}
