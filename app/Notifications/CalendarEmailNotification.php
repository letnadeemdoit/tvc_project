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

    public $items;
    public $createdHouseName;
    public $startDate;
    public $endDate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($items,$createdHouseName,$startDate,$endDate)
    {
        $this->items = $items;
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

            ->greeting('Vacation Calendar')

            ->line(new HtmlString('A New Vacation <strong>' . $this->items->VacationName.'</strong>'. ' has been Scheduled against ' . '<strong>'. $this->createdHouseName .' '.'House'.'</strong>'))

            ->line(new HtmlString('The Duration of the vacatioin is from <strong>' . $this->startDate->RealDate.'</strong>'. ' to ' . '<strong>'. $this->endDate->RealDate .' '.'Date'.'</strong>'));

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
            'Name' => $this->items->VacationName,
            'house_name' => $this->createdHouseName,
            'start_date' => $this->startDate->RealDate,
            'end_date' => $this->endDate->RealDate,
        ];
    }
}
