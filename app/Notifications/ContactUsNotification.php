<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactUsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $contactQuery;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contactQuery)
    {
        $this->contactQuery = $contactQuery;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject($this->contactQuery['subject'])
            ->greeting($this->contactQuery['greeting'])
            ->line($this->contactQuery['body'])
            ->action($this->contactQuery['text'], $this->contactQuery['url']);
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
            'body' => $this->contactQuery['body'],
            'url' => $this->contactQuery['url'],
        ];
    }
}
