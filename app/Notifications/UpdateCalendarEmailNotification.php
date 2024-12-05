<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateCalendarEmailNotification extends Notification
{
    use Queueable;


    public $vacName;
    public $currentUser;
    public $originalVacName;
    public $ccList;
    public $user;
    public $createdHouseName;
    public $startDate;
    public $endDate;
    public $originalVacStartDate;
    public $originalVacEndDate;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($currentUser,$vacName,$originalVacName,$ccList,$user, $createdHouseName, $startDate, $endDate,$originalVacStartDate,$originalVacEndDate)
    {
        $this->currentUser = $currentUser;
        $this->vacName = $vacName;
        $this->originalVacName = $originalVacName;
        $this->ccList = $ccList;
        $this->user = $user;
        $this->createdHouseName = $createdHouseName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->originalVacStartDate = $originalVacStartDate;
        $this->originalVacEndDate = $originalVacEndDate;
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
            ->subject('Vacation updated on ' . $this->createdHouseName . ' Calendar')
            ->cc($this->ccList) // Add CC recipients
            ->view('emails.update_calendar_email_notification', [
                'currentUser' => $this->currentUser,
                'vacName' => $this->vacName,
                'originalVacName' => $this->originalVacName,
                'user' => $this->user,
                'createdHouseName' => $this->createdHouseName,
                'startDate' => $this->startDate,
                'endDate' => $this->endDate,
                'originalVacStartDate' => $this->originalVacStartDate,
                'originalVacEndDate' => $this->originalVacEndDate,

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
            'currentUser' => $this->currentUser,
            'vacName' => $this->vacName,
            'originalVacName' => $this->originalVacName,
            'user' => $this->user,
            'createdHouseName' => $this->createdHouseName,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'originalVacStartDate' => $this->originalVacStartDate,
            'originalVacEndDate' => $this->originalVacEndDate,
        ];
    }
}
