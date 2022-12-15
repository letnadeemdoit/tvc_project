<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class DeleteNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $name;
    public $isAction;
    public $createdHouseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name,$isAction,$createdHouseName)
    {
        $this->name = $name;
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
            ->subject('Delete Blog')
            ->greeting('Blog')
            ->line(new HtmlString(
                '<strong>' . $this->items->Subject . ' </strong>'.
                '<strong>' . $this->name.'</strong> Blog has been <strong>' . $this->isAction . '  </strong> for house <strong>'. $this->createdHouseName .' </strong>'
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
            'house_name' => $this->createdHouseName,
        ];
    }
}
