<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class RequestToJoinVacationCreatorMailNotification extends Notification implements ShouldQueue
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
            ->greeting('Confirmation of Your Request to Join A Vacation')
            ->line(new HtmlString('<strong>' . $this->owner['name'] . ' </strong> has requested to join vacation <strong>'
                . $this->vacation_name . '</strong> from' .
                ' ' . '<strong>' . $this->startDate . '</strong> to ' . '  <strong> ' . $this->endDate . '
                ' . '</strong>' . '.'));

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
