<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestToApproveVacationEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $vacName;
    public $ccList;
    public $name;
    public $email;
    public $siteUrl;
    public $createdHouseName;
    public $startDate;
    public $endDate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vacName,$siteUrl,$ccList,$name,$email,$createdHouseName,$startDate,$endDate)
    {
        $this->vacName = $vacName;
        $this->siteUrl = $siteUrl;
        $this->ccList = $ccList;
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
            ->subject('Approval Request for ' . $this->vacName . ' at ' . $this->createdHouseName . ' ')
            ->cc($this->ccList) // Add CC recipients
            ->view('emails.request_to_approve_vacation_email_notification', [
                'vacName' => $this->vacName,
                'siteUrl' => $this->siteUrl,
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
            'vacName' => $this->vacName,
            'siteUrl' => $this->siteUrl,
            'name' => $this->name,
            'email' => $this->email,
            'createdHouseName' => $this->createdHouseName,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ];
    }
}
