<?php

namespace App\Listeners\Website\Doctor\Appointment;

use App\Events\Website\Doctor\Appointment\AppointmentConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\Website\Doctor\Appointment\AppointmentConfirmation;

class SendConfirmMail
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
     * @param  object  $event
     * @return void
     */
    public function handle(AppointmentConfirmed $event)
    {

        Mail::to($event->appointment->user)->send(new AppointmentConfirmation($event->appointment));
    }
}
