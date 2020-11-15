<?php

namespace App\Observers;

use App\Certificate;
use App\Mail\NewCertificate;
use Illuminate\Support\Facades\Mail;

class CertificateObserver
{
    /**
     * Handle the certificate "created" event.
     *
     * @param  \App\Certificate  $certificate
     * @return void
     */
    public function created(Certificate $certificate)
    {
        $student = $certificate->professionalPractice->solicitude->student;
        $tutor = $certificate->professionalPractice->tutor;

        Mail::to($tutor)->send(new NewCertificate($certificate));
        Mail::to($student)->send(new NewCertificate($certificate));
    }
}
