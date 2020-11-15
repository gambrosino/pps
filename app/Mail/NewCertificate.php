<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewCertificate extends Mailable
{
    use Queueable, SerializesModels;

    protected $certificate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('PPS-UTN-Frro: Practica Profesional Completada')->view('emails.new-certificate')->with([
            'userName'  => $this->certificate->professionalPractice->solicitude->student->name,
            'tutor'     => $this->certificate->professionalPractice->tutor->name,
            'number'    => $this->certificate->number,
            'folio'     => $this->certificate->folio,
            'note'      => $this->certificate->note,
        ]);
    }
}
