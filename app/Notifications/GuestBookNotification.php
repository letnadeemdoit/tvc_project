<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class GuestBookNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $ccList;
    public $title;
    public $user;
    public $siteUrl;
    public $createdHouseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ccList,$title,$user,$siteUrl,$createdHouseName)
    {
        $this->ccList = $ccList;
        $this->title = $title;
        $this->user = $user;
        $this->siteUrl = $siteUrl;
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
            ->subject('New Guest Book entry added to ' . $this->createdHouseName . ' ')
//            ->cc($this->ccList) // Add CC recipients
            ->view('emails.guest_book_email_notification', [
                'title' => $this->title,
                'siteUrl' => $this->siteUrl,
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
            'Name' => $this->title,
            'isModal' => 'Guest Book',
            'isAction' => 'created',
            'house_name' => $this->createdHouseName,
        ];
    }
}
