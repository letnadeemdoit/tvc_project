<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class DeleteNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $name;
    public $isAction;
    public $createdHouseName;
    public $isModel;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name,$isAction,$createdHouseName,$isModel)
    {
        $this->name = $name;
        $this->isAction = $isAction;
        $this->createdHouseName = $createdHouseName;
        $this->isModel = $isModel;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // When using Notification::route('mail', ...)
        if ($notifiable instanceof AnonymousNotifiable) {
            return ['mail'];
        }
        // For actual User models, send database notifications
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
//        return (new MailMessage)
//
//            ->subject('Deleted'. ' ' . $this->isModel)
//            ->greeting($this->isAction)
//            ->line(new HtmlString( '<strong>' . $this->name.  '</strong> '
//                . $this->isModel. ' has been Deleted against <span>' .  $this->createdHouseName .  ' </span> House </strong>'));

        return (new MailMessage)
            ->subject('Deleted' . ' ' . $this->isModel)
            ->greeting($this->isAction)
            ->line(new HtmlString(
                '<strong>' . $this->name . '</strong> '
                . $this->isModel . ' has been '
                . ($this->isAction === 'Rejected' ? 'Rejected' : 'Deleted')
                . ' against <span>' . $this->createdHouseName . '</span> House </strong>'
            ));
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'Name' => $this->name,
            'isAction' => $this->isAction,
            'isModal' => $this->isModel,
            'house_name' => $this->createdHouseName,
        ];
    }
}
