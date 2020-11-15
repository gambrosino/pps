<?php

namespace App\Observers;

use App\ProfessionalPractice;
use App\User;
use App\Mail\NewProfessionalPractice;
use App\Mail\ProfessionalPracticeUpdated;
use App\Mail\ProfessionalPracticeInRevision;
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

            if($professionalPractice->status == 'in_revision') {
                $admins = User::whereHas('role', function ($q) {
                    $q->where('name', 'admin');
                })->get();
                Mail::to($admins)->send(new ProfessionalPracticeInRevision($professionalPractice));
            }
        }
    }
}
