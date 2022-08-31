<?php

namespace App\Http\Livewire\Notification;

use Livewire\Component;

class NotificationList extends Component
{
    public $user;

    public function render()
    {



        $data = $this->user->notifications;

        return view('dash.notifications.notification-list',compact('data'));
    }
}
