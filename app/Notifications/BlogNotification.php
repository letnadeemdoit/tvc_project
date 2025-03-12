<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\HtmlString;

class BlogNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $items;
    public $ccList;
    public $blogUrl;
    public $user;
    public $createdHouseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ccList,$items,$blogUrl,$user,$createdHouseName)
    {
        $this->ccList = $ccList;
        $this->items = $items;
        $this->blogUrl = $blogUrl;
        $this->user = $user;
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
        return (new MailMessage)
            ->subject(' New Blog entry added to ' . $this->createdHouseName . ' ')
//            ->cc($this->ccList) // Add CC recipients
            ->view('emails.blog_email_notification', [
                'items' => $this->items,
                'blogUrl' => $this->blogUrl,
                'user' => $this->user,
                'createdHouseName' => $this->createdHouseName,
            ]);
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
            'isModal' => 'Blog',
            'isAction' => 'created',
            'house_name' => $this->createdHouseName,
        ];
    }
}
