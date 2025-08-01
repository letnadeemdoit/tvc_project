<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class RequestToJoinVacationNotification2 extends Notification implements ShouldQueue
{
    use Queueable;

    public $vacation_name;
    public $house_name;
    public $owner;
    public $startDate;
    public $endDate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vacation_name,$house_name,$owner, $startDate, $endDate)
    {
        $this->vacation_name = $vacation_name;
        $this->house_name = $house_name;
        $this->owner = $owner;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
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
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Request To Join Vacation')
            ->greeting('Request to Join Your Vacation')
            ->line(new HtmlString('<strong>' . $this->owner['name'] . ' </strong> has requested to join your vacation <strong>'
                . $this->vacation_name . '</strong> from' .
                ' ' . '<strong>' . $this->startDate . '</strong> to ' . '  <strong> ' . $this->endDate . '</strong>' . '.'))
            ->line(new HtmlString(
                'Reply to: <strong>' . $this->owner['email'] . '</strong>'
            ));

//            ->line(new HtmlString(
//                'Name : <strong>' . $this->owner['name'] . '(' . $this->owner['role']  . ') '. '</strong> has requested to join your vacation'
//            ))
//            ->line(new HtmlString(
//                ' <strong>'. $this->startDate . ' </strong>'
//            ))
//            ->line(new HtmlString(
//                'From : <strong>'. $this->startDate . ' </strong>'
//            ))
//            ->line(new HtmlString(
//                'End Date: <strong>'. $this->endDate . ' </strong>'
//            ))


    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
