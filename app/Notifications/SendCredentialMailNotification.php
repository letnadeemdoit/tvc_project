<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class SendCredentialMailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $sendmail;
    public $sendPasswordToMail;
    public $userDetails;
    public $houseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sendmail,$sendPasswordToMail,$userDetails,$houseName)
    {
       $this->sendmail =$sendmail;
       $this->sendPasswordToMail =$sendPasswordToMail;
       $this->userDetails =$userDetails;
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
            ->subject('Access to TheVacationCalendar.com')
            ->view('emails.send_credential_email_notification', [
                'createUser' => $this->userDetails,
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
            'sendPasswordToMail' => $this->sendPasswordToMail,
            'userDetails' => $this->userDetails,
            'houseName' => $this->houseName,
        ];
    }
}
