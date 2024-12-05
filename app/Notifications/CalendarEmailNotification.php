<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CalendarEmailNotification extends Notification
{
    use Queueable;

    public $vacName;
    public $ccList;
    public $user;
    public $createdHouseName;
    public $startDate;
    public $endDate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vacName,$ccList,$user,$createdHouseName,$startDate,$endDate)
    {
        $this->vacName = $vacName;
        $this->ccList = $ccList;
        $this->user = $user;
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
            ->subject('New Vacation added to ' . $this->createdHouseName . ' Calendar')
            ->cc($this->ccList) // Add CC recipients
            ->view('emails.calendar_email_notification', [
                'vacName' => $this->vacName,
                'user' => $this->user,
                'createdHouseName' => $this->createdHouseName,
                'startDate' => $this->startDate,
                'endDate' => $this->endDate,
            ]);

//            ->greeting('Vacation Calendar')
//            ->line(new HtmlString('A New Vacation <strong>' . $this->items->VacationName.'</strong>'. ' has been scheduled for ' . '<strong>'. $this->createdHouseName .' '.'House'.'</strong>'))
//
//            ->line(new HtmlString('This change was made by <strong>' . $this->user->first_name. ' ' . $this->user->last_name . '('. $this->user->email . ')' .  '</strong>'))
//
//            ->line(new HtmlString('The duration of the vacation is from <strong>' . $this->startDate->RealDate.'</strong>'. ' to ' . '<strong>'. $this->endDate->RealDate .'</strong>'))
//
//            ->line(new HtmlString('The duration of the vacation is from <strong>' . $this->startDate->RealDate.'</strong>'. ' to ' . '<strong>'. $this->endDate->RealDate .' '.'Date'.'</strong>'));

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
            'vacName' => $this->vacName,
            'user' => $this->user,
            'createdHouseName' => $this->createdHouseName,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ];
    }
}
