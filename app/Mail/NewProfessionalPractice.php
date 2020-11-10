<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewProfessionalPractice extends Mailable
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
        return $this->subject('PPS-UTN-Frro: Nueva Practica Profesional')->view('emails.new-professional-practice')->with([
            'userName' => $this->professionalPractice->solicitude->student->name,
            'tutorName' => $this->professionalPractice->tutor->name,
        ]);
    }
}
