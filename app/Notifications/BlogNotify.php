<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class BlogNotify extends Notification implements ShouldQueue
{
    use Queueable;
    public $items;
    public $blogUrl;
    public $createdHouseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($items,$blogUrl,$createdHouseName)
    {
        $this->items = $items;
        $this->blogUrl = $blogUrl;
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
        $url = $this->blogUrl;

        return (new MailMessage)
            ->greeting('Blog!')
            ->line(new HtmlString('New Blog <strong>' . $this->items->Subject.'</strong>'. ' has been Created against ' . '<strong>'. $this->createdHouseName .' '.'House'.'</strong>'))
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
            'house_name' => $this->createdHouseName,
            'slug' => $this->blogUrl,
        ];
    }



}
