<?php

namespace App\Listeners\Dashboard;

use App\Events\Dashboard\DoctorAccepted;
use App\Mail\dashboard\DoctorAccepted as DashboardDoctorAccepted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendDoctorAcceptanceMail
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
     * @param  DoctorAccepted  $event
     * @return void
     */
    public function handle(DoctorAccepted $event)
    {
        Mail::to($event->doctor->email)->send(new DashboardDoctorAccepted($event->doctor));
    }
}
