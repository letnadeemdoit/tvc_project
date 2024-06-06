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

    public $guestUser;
    public $adminUser;

    public $vacation;

    public $houseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($guestContact,$adminUser,$vacation,$houseName)
    {
        $this->guestUser = $guestContact;
        $this->adminUser = $adminUser;
        $this->vacation = $vacation;
        $this->houseName = $houseName;
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
            ->greeting('Vacation Approved!')
            ->line(new HtmlString('Your Vacation <strong>' . $this->vacation->VacationName.'</strong>'. ' has been Approved by house Administrator <strong>' . $this->adminUser->first_name . ' ' . $this->adminUser->last_name  .'</strong>'. '   Against   ' . '<strong>'. $this->houseName .' '.'House'.'</strong>'))
            ->line('Thank you for using our application!');
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
            'guestUser' => $this->guestUser,
            'adminUser' => $this->adminUser,
            'vacation' => $this->vacation ,
            'houseName' => $this->houseName ,
        ];
    }
}
