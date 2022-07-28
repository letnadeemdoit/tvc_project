<?php

namespace App\Listeners;

use App\Events\ModelAudited;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogModelAudit
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
     * @param  \App\Events\ModelAudited  $event
     * @return void
     */
    public function handle(ModelAudited $event)
    {
    }
}
