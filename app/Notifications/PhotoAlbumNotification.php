<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

//class PhotoAlbumNotification extends Notification implements ShouldQueue
class PhotoAlbumNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $ccList;
    public $items;
    public $user;
    public $siteUrl;
    public $createdHouseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ccList,$items,$user,$siteUrl,$createdHouseName)
    {
        $this->ccList = $ccList;
        $this->items = $items;
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
            ->subject('New Picture added to ' . $this->createdHouseName . ' ')
//            ->cc($this->ccList) // Add CC recipients
            ->view('emails.new_picture_in_album_email_notification', [
                'items' => $this->items,
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
            'isModal' => 'Photo',
            'isAction' => 'created',
            'house_name' => $this->createdHouseName,
        ];
    }
}
