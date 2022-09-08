<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class DeleteNotification extends Notification
{
    use Queueable;
    public $name;
    public $deleteType;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name,$deleteType)
    {
        $this->name = $name;
        $this->deleteType = $deleteType;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->subject('Delete ' .$this->deleteType)
            ->greeting($this->deleteType)
            ->line(new HtmlString($this->deleteType. ' ' .'<strong>' . $this->name.'</strong>'.
                '  has been Deleted!  </strong>'));
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
            'deleteType' => $this->deleteType,
        ];
    }
}
