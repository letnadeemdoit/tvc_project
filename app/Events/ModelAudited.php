<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelAudited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model;
    public $auditor;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($model, $auditor)
    {
        $this->model = $model;
        $this->auditor = $auditor;
    }
}
