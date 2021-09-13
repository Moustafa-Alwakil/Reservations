<?php

namespace App\Listeners\Api\Auth;

use App\Events\Api\Auth\NewRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\Api\Auth\SendCodeMail as sendMail;

class SendCodeMail
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
     * @param  NewRegistered  $event
     * @return void
     */
    public function handle(NewRegistered $event)
    {
        Mail::to($event->user->email)->send(new sendMail($event->user));
    }
}
