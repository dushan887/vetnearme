<?php

namespace App\Listeners;

use App\Clinic;
use App\Events\UserUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClinicUpdateOwner
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
     * @param  UserUpdate  $event
     * @return void
     */
    public function handle(UserUpdate $event)
    {

        $clinic = Clinic::find($event->_clinicID);

        if(!$clinic)
            return false;

        $clinic->owner_id = $event->_user->id;

        $clinic->update();

        return true;
    }
}
