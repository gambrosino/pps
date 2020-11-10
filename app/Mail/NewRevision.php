<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewRevision extends Mailable
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
        return $this->subject('PPS-UTN-Frro: Nueva Revision subida')->view('emails.new-revision')->with([
            'userName' => $this->revision->professionalPractice->solicitude->student->name,
        ]);
    }
}
