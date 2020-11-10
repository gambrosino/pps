<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewSolicitude extends Mailable
{
    use Queueable, SerializesModels;

    protected $solicitude;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($solicitude)
    {
        $this->solicitude = $solicitude;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('PPS-UTN-Frro: Nueva Solicitud de PPS')->view('emails.new-solicitude')->with([
            'userName' => $this->solicitude->student->name,
        ]);
    }
}
