<?php

namespace App\Listeners;

use App\Events\NewUser;
use App\Mail\NewUserWelcome;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
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
     * @param  NewUser  $event
     * @return void
     */
    public function handle(NewUser $event)
    {
        \Mail::to($event->_user->email)->send(new NewUserWelcome($event));
    }
}
