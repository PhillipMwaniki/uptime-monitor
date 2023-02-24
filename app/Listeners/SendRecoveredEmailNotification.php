<?php

namespace App\Listeners;

use App\Notifications\EndpointDownNotification;
use App\Notifications\EndpointRecoveredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendRecoveredEmailNotification
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
    public function handle($event)
    {
        \Log::info('sending email');
        collect($event->check->endpoint->site->notification_emails)->each(static function($email) use ($event) {
            \Log::info('email: '. $email);
            Notification::route('mail', $email)
                        ->notify(new EndpointRecoveredNotification($event->check->endpoint));
        });
    }
}
