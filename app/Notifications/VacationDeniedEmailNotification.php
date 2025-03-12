<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VacationDeniedEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $ccList;

    public $name;
    public $email;
    public $vacName;

    public $admin;

    public $houseName;
    public $startDate;
    public $endDate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ccList,$name,$email,$vacName,$admin,$houseName,$startDate,$endDate)
    {
        $this->ccList = $ccList;
        $this->name = $name;
        $this->email = $email;
        $this->vacName = $vacName;
        $this->admin = $admin;
        $this->houseName = $houseName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
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
            ->subject(' ' . $this->vacName . ' at ' . $this->houseName . ' was Denied ')
//            ->cc($this->ccList) // Add CC recipients
            ->view('emails.vacation_denied_email_notification', [
                'vacName' => $this->vacName,
                'name' => $this->name,
                'email' => $this->email,
                'admin' => $this->admin,
                'houseName' => $this->houseName,
                'startDate' => $this->startDate,
                'endDate' => $this->endDate,
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
            'content' => 'A vacation has been denied from',
            'house_name' => $this->houseName,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ];
    }
}
