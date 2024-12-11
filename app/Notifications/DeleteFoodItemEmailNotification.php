<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeleteFoodItemEmailNotification extends Notification
{
    use Queueable;
    public $ccList;
    public $isModel;
    public $title;
    public $user;
    public $createdHouseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ccList,$isModel,$title,$user,$createdHouseName)
    {
        $this->ccList = $ccList;
        $this->isModel = $isModel;
        $this->title = $title;
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
            ->subject('' . $this->isModel . ' was deleted from ' . $this->createdHouseName . ' ')
            ->cc($this->ccList) // Add CC recipients
            ->view('emails.food_item_deleted_email_notification', [
                'title' => $this->title,
                'isModel' => $this->isModel,
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
            'title' => $this->title,
            'isModel' => $this->isModel,
            'user' => $this->user,
            'createdHouseName' => $this->createdHouseName,
        ];
    }
}
