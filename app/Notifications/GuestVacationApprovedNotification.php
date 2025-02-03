<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class GuestVacationApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $name;
    public $email;
    public $isApproved;
    public $ccList;

    public $vacContent;

    public $vacation;

    public $houseName;
    public $startDate;
    public $endDate;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ccList,$vacContent,$name,$email,$isApproved,$vacation,$houseName,$startDate,$endDate)
    {
        $this->ccList = $ccList;
        $this->vacContent = $vacContent;
        $this->name = $name;
        $this->email = $email;
        $this->isApproved = $isApproved;
        $this->vacation = $vacation;
        $this->houseName = $houseName;
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
        return ['mail','database'];
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
            ->subject(' ' . $this->vacation->VacationName . ' at ' . $this->houseName . ' was ' . $this->vacContent . ' ')
//            ->cc($this->ccList) // Add CC recipients
            ->view('emails.guest_vacation_approved_notification', [
                'vacContent' => $this->vacContent,
                'name' => $this->name,
                'email' => $this->email,
                'isApproved' => $this->isApproved,
                'vacation' => $this->vacation,
                'houseName' => $this->houseName,
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
            'vacContent' => $this->vacContent,
            'name' => $this->name,
            'email' => $this->email,
            'isApproved' => $this->isApproved,
            'vacation' => $this->vacation,
            'houseName' => $this->houseName,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ];
    }
}
