<?php

namespace App\Providers;

use App\Events\Api\Auth\NewRegistered;
use App\Events\Dashboard\ClinicAccepted;
use App\Events\Dashboard\DoctorAccepted;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\Website\Doctor\Appointment\SendConfirmMail;
use App\Events\Website\Doctor\Appointment\AppointmentConfirmed;
use App\Listeners\Api\Auth\SendCodeMail;
use App\Listeners\Dashboard\SendClinicAcceptanceMail;
use App\Listeners\Dashboard\SendDoctorAcceptanceMail;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            AppointmentConfirmed::class,
            [SendConfirmMail::class, 'handle']
        );

        Event::listen(
            DoctorAccepted::class,
            [SendDoctorAcceptanceMail::class, 'handle']
        );

        Event::listen(
            ClinicAccepted::class,
            [SendClinicAcceptanceMail::class, 'handle']
        );
    
        Event::listen(
            NewRegistered::class,
            [SendCodeMail::class, 'handle']
        );
    }
}
