<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewReport extends Mailable
{
    use Queueable, SerializesModels;

    Protected $report;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report)
    {
        $this->report = $report;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('PPS-UTN-Frro: Nuevo Informe Final')->view('emails.new-report')->with([
            'userName' => $this->report->professionalPractice->solicitude->student->name,
        ]);
    }
}
