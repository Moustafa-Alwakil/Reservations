<?php

namespace App\Listeners\Dashboard;

use App\Events\Dashboard\ClinicAccepted;
use App\Mail\dashboard\ClinicAccepted as DashboardClinicAccepted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendClinicAcceptanceMail
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
     * @param  ClinicAccepted  $event
     * @return void
     */
    public function handle(ClinicAccepted $event)
    {
        Mail::to($event->clinic->physican->email)->send(new DashboardClinicAccepted($event->clinic));
    }
}
