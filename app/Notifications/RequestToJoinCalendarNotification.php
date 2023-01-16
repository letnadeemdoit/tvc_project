<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class RequestToJoinCalendarNotification extends Notification implements ShouldQueue
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

            ->greeting('Request to Use Vacation Home')

            ->line(new HtmlString('<strong>'. $this->name. '</strong>' .' '.'has requested to use <strong>'
                . $this->createdHouseName.'</strong>'.
                ' from ' . '<strong>'. $this->startDate .'</strong>'.' to  <strong> '.$this->endDate .'
                '.'</strong>'. 'date'))

            ->line(new HtmlString('They can be reached at the following email address: <strong>' .
                $this->email.'</strong>'));

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
            'Name' => $this->name,
            'email' => $this->email,
            'house_name' => $this->createdHouseName,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ];
    }
}
