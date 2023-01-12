<?php

namespace App\Listeners;

use App\Events\MailToPatient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailToPatient
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MailToPatient  $event
     * @return void
     */
    public function handle(MailToPatient $event)
    {
        Mail::to($event->email)->send(new \App\Mail\SendMailToPatient($event->doctorName, $event->doctorSurname,
            $event->time, $event->date));
    }
}
