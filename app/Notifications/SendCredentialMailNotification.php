<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class SendCredentialMailNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $sendPasswordToMail;
    public $userDetails;
    public $houseName;
    public $siteUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($sendPasswordToMail,$userDetails,$houseName,$siteUrl)
    {
       $this->sendPasswordToMail =$sendPasswordToMail;
       $this->userDetails =$userDetails;
       $this->houseName =$houseName;
       $this->siteUrl =$siteUrl;
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
            ->subject('Access to TheVacationCalendar.com')
            ->view('emails.send_credential_email_notification', [
                'createUser' => $this->userDetails,
                'sendPasswordToMail' => $this->sendPasswordToMail,
                'houseName' => $this->houseName,
                'siteUrl' => $this->siteUrl,
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
            'Name' => $this->userDetails->first_name . ' ' . $this->userDetails->last_name,
            'isModal' => 'User',
            'isAction' => 'Credentials',
            'house_name' => $this->houseName,
        ];
    }
}
