<?php

namespace App\Observers;

use App\Revision;
use App\Mail\NewRevision;
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

        Mail::to($tutor)->send(new NewRevision);
    }
}
