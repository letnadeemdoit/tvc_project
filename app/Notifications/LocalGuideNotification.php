<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class LocalGuideNotification extends Notification
{
    use Queueable;
    public $items;
    public $isAction;
    public $createdHouseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($items,$isAction,$createdHouseName)
    {
        $this->items = $items;
        $this->isAction = $isAction;
        $this->createdHouseName = $createdHouseName;
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
            ->greeting('Local Guide')
            ->line(new HtmlString(
                '<strong>' . $this->items->title . ' </strong>'.
                ' Local Guide has been <strong>' . $this->isAction . '  </strong> for house <strong>'. $this->createdHouseName .' </strong>'
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
            'Name' => $this->items->title,
            'isAction' => $this->isAction,
            'isModal' => 'Local Guide',
            'house_name' => $this->createdHouseName,
        ];
    }
}
