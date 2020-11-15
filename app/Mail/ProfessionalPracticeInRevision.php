<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProfessionalPracticeInRevision extends Mailable
{
    use Queueable, SerializesModels;

    protected $professionalPractice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($professionalPractice)
    {
        $this->professionalPractice = $professionalPractice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('PPS-UTN-Frro: Practica Profesional En Revisión')->view('emails.professional-practice-in-revision')->with([
            'userName'  => $this->professionalPractice->solicitude->student->name,
            'tutor'     => $this->professionalPractice->tutor->name,
        ]);
    }
}
