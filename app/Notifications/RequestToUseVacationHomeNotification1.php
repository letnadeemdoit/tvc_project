<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class RequestToUseVacationHomeNotification1 extends Notification implements ShouldQueue
{
    use Queueable;

    public $name;
    public $email;
    public $createdHouseName;
    public $startDate;
    public $endDate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name,$email,$createdHouseName,$startDate,$endDate)
    {
        $this->name = $name;
        $this->email = $email;
        $this->createdHouseName = $createdHouseName;
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
            ->subject('Request to Use ' . $this->createdHouseName . ' ')
//            ->cc($this->email) // Add CC recipients
            ->view('emails.request_to_use_home_without_vacation_notification', [
                'name' => $this->name,
                'email' => $this->email,
                'createdHouseName' => $this->createdHouseName,
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
            'content' => 'Request to use vacation home from',
            'house_name' => $this->createdHouseName,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ];
    }
}
