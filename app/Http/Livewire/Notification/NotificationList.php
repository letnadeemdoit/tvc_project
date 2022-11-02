<?php

namespace App\Http\Livewire\Notification;

use Livewire\Component;

class NotificationList extends Component
{
    public $user;

    public function render()
    {

        $data = $this->user->unreadNotifications()->paginate(10);

        return view('dash.notifications.notification-list',compact('data'));
    }
}
