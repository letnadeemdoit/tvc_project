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

    public $vacContent;
    public $adminUser;

    public $vacation;

    public $houseName;
    public $guestName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vacContent,$guestName,$guestContact,$adminUser,$vacation,$houseName)
    {
        $this->vacContent = $vacContent;
        $this->guestUser = $guestContact;
        $this->adminUser = $adminUser;
        $this->vacation = $vacation;
        $this->houseName = $houseName;
        $this->guestName = $guestName;
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
            ->greeting('Vacation ' . $this->vacContent . '!')
            ->line(new HtmlString('<strong>' . $this->guestName.'</strong>'. ' Your Vacation <strong>' . $this->vacation->VacationName.'</strong>'. ' has been ' . $this->vacContent . ' by house Administrator <strong>' . $this->adminUser->first_name . ' ' . $this->adminUser->last_name  .'</strong>'. '   Against   ' . '<strong>'. $this->houseName .' '.'House'.'</strong>'))
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
            'vacContent' => $this->vacContent,
            'guestUser' => $this->guestUser,
            'adminUser' => $this->adminUser,
            'vacation' => $this->vacation ,
            'houseName' => $this->houseName ,
            'guestName' => $this->guestName ,
        ];
    }
}
