<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CreateUserEmailNotification extends Notification
{
    use Queueable;
    public $createUser;
    public $sendPasswordToMail;
    public $houseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($createUser,$sendPasswordToMail,$houseName)
    {
        $this->createUser =$createUser;
        $this->sendPasswordToMail =$sendPasswordToMail;
        $this->houseName =$houseName;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'mail','database'
        ];
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
            ->subject('Welcome to TheVacationCalendar.com')
            ->view('emails.create_user_email_notification', [
                'createUser' => $this->createUser,
                'sendPasswordToMail' => $this->sendPasswordToMail,
                'houseName' => $this->houseName
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
            'createUser' => $this->createUser,
            'sendPasswordToMail' => $this->sendPasswordToMail,
            'houseName' => $this->houseName,
        ];
    }
}
