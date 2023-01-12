<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailToPatient extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $doctorName;
    public $doctorSurname;
    public $date;
    public $time;

    public function __construct($doctorName, $doctorSurname, $date, $time)
    {
        $this->doctorName = $doctorName;
        $this->doctorSurname = $doctorSurname;
        $this->date = $date;
        $this->time = $time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.patientMail');
    }
}
