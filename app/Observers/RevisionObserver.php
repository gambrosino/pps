<?php

namespace App\Observers;

use App\User;
use App\Revision;
use App\Mail\NewRevision;
use App\Mail\RevisionUpdated;
use App\Mail\RevisionCorrected;
use Illuminate\Support\Facades\Mail;

class RevisionObserver
{
    /**
     * Handle the revision "created" event.
     *
     * @param  \App\Revision  $revision
     * @return void
     */
    public function created(Revision $revision)
    {
        $tutor = $revision->professionalPractice->tutor;

        Mail::to($tutor)->send(new NewRevision($revision));
    }

    public function updating(Revision $revision)
    {
        if ($revision->isDirty('status')) {

            //send mail to user when a revision is approved or rejected
            if($revision->status != 'pending') {
                $student = $revision->professionalPractice->solicitude->student;
                Mail::to($student)->send(new RevisionUpdated);
            }
            else { //send mail to tutor/admin when a revision is corrected
                if($revision->professionalPractice->status == 'in-revision') {
                    $receipt = User::whereHas('role', function ($q) {
                        $q->where('name', 'admin');
                    })->get();
                }
                else {
                    $receipt = $revision->professionalPractice->tutor;
                }
                Mail::to($receipt)->send(new RevisionCorrected($revision));
            }
        }
    }
}