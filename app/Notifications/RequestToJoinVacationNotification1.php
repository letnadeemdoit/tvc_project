<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class RequestToJoinVacationNotification1 extends Notification implements ShouldQueue
{
    use Queueable;

    public $vacation_name;
    public $ccList;
    public $createdHouseName;
    public $owner;
    public $startDate;
    public $endDate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vacation_name,$ccList,$house_name,$owner, $startDate, $endDate)
    {
        $this->vacation_name = $vacation_name;
        $this->ccList = $ccList;
        $this->createdHouseName = $house_name;
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
            ->subject('Request to Join ' . $this->vacation_name . ' at ' . $this->createdHouseName . ' ')
            ->cc($this->ccList) // Add CC recipients
            ->view('emails.request_to_join_vacation_notification', [
                'vacation_name' => $this->vacation_name,
                'owner' => $this->owner,
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
            'vacation_name' => $this->vacation_name,
            'owner' => $this->owner,
            'createdHouseName' => $this->house_name,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ];
    }
}
