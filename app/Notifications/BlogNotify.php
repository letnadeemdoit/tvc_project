<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class BlogNotify extends Notification
{
    use Queueable;
    public $items;
    public $blogUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($items,$blogUrl)
    {
        $this->items = $items;
        $this->blogUrl = $blogUrl;
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
        $url = $this->blogUrl;

        return (new MailMessage)
            ->greeting('Vacation Calendar Blog!')
            ->line('Blog Name'.' '.$this->items->Subject)
            ->action('click to check blog', $url);
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
            'Name' => $this->items->Subject,
            'slug' => $this->blogUrl,
        ];
    }



}
