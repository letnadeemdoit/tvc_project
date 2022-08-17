<?php

namespace App\Listeners;

use OwenIt\Auditing\Events\Audited;

class AuditedListener
{
    /**
     * Create the Audited event listener.
     */
    public function __construct()
    {
        // ...
    }

    /**
     * Handle the Audited event.
     *
     * @param \OwenIt\Auditing\Events\Audited $event
     * @return void
     */
    public function handle(Audited $event)
    {

        if (auth()->check()){
            $event->audit->house_id = $event->audit->user->HouseId;
            $event->audit->save();
        }


    }
}
