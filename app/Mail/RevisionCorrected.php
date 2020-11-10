<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RevisionCorrected extends Mailable
{
    use Queueable, SerializesModels;

    protected $revision;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($revision)
    {
        $this->revision = $revision;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('PPS-UTN-Frro: Revisión Corregida')->view('emails.revision-corrected')->with([
            'userName' => $this->revision->professionalPractice->solicitude->student->name,
            'revision' => $this->revision->description,
        ]);
    }
}
