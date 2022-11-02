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

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sendmail,$sendPasswordToMail,$userDetails)
    {
       $this->sendmail =$sendmail;
       $this->sendPasswordToMail =$sendPasswordToMail;
       $this->userDetails =$userDetails;
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
            ->subject('User '.' '. $this->userDetails['user_name'] )
            ->line(new HtmlString('<strong>' .'User Name:'.'</strong>' .' ' . $this->userDetails['user_name']))
            ->line(new HtmlString('<strong>' .'your Password is:'.'</strong>' .' ' . $this->sendPasswordToMail));
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
            //
        ];
    }
}
