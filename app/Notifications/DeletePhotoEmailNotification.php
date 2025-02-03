<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeletePhotoEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $ccList;
    public $items;
    public $siteUrl;
    public $albumName;
    public $user;
    public $createdHouseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ccList,$siteUrl,$data,$albumName,$user, $createdHouseName)
    {
        $this->ccList = $ccList;
        $this->siteUrl = $siteUrl;
        $this->items = $data;
        $this->albumName = $albumName;
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
            ->subject('Picture was deleted from ' . $this->createdHouseName . ' ')
//            ->cc($this->ccList) // Add CC recipients
            ->view('emails.photo_deleted_email_notification', [
                'items' => $this->items,
                'siteUrl' => $this->siteUrl,
                'albumName' => $this->albumName,
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
            'items' => $this->items,
            'siteUrl' => $this->siteUrl,
            'albumName' => $this->albumName,
            'user' => $this->user,
            'createdHouseName' => $this->createdHouseName,
        ];
    }
}
