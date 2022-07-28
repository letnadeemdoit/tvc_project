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
        $data = [
            'Audit_user_name' => $event->auditor->user_name,
            'Audit_Role' => $event->auditor->role,
            'Audit_FirstName' => $event->auditor->first_name,
            'Audit_LastName' => $event->auditor->last_name,
            'Audit_Email' => $event->auditor->email,
            'old_password' => $event->auditor->old_password,
        ];

        $event->model->update($data);

        $event->model->fresh();

    }
}
