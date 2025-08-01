<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserAccountNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $firstName;
    public $lastName;
    public $userName;
    public $email;
    public $houseName;
    public $siteUrl;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($firstName,$lastName,$userName, $email,$houseName,$siteUrl)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->email = $email;
        $this->houseName = $houseName;
        $this->siteUrl = $siteUrl;
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
            ->subject('Welcome to TheVacationCalendar.com')
            ->view('emails.new_user_account_notification', [
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'userName' => $this->userName,
                'email' => $this->email,
                'houseName' => $this->houseName,
                'siteUrl' => $this->siteUrl
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
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'houseName' => $this->houseName,
            'siteUrl' => $this->siteUrl
        ];
    }
}
