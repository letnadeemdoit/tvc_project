<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class RequestToJoinVacationMailNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $owner;
    public $startDate;
    public $endDate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($owner, $startDate, $endDate)
    {
        $this->owner = $owner;
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
            ->greeting('Request to Join vacation!')
            ->line(new HtmlString(
                'Reply at : <strong>'.  'NoReply@theVacationCalendar.com' . '</strong>'
            ))
            ->line(new HtmlString(
                'Name : <strong>' . $this->owner->first_name . ' ' . $this->owner->last_name . '</strong>'
            ))
            ->line(new HtmlString(
                'Start Date : <strong>'. $this->startDate . ' </strong>'
            ))
            ->line(new HtmlString(
                'End Date: <strong>'. $this->endDate . ' </strong>'
            ));
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
