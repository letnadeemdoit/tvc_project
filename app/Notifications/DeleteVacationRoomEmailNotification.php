<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeleteVacationRoomEmailNotification extends Notification
{
    use Queueable;

    public $vacationName;
    public $user;
    public $startDatetimeOfRoom;
    public $endDatetimeOfRoom;
    public $createdHouseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($createdHouseName,$vacationName,$user,$startDatetimeOfRoom,$endDatetimeOfRoom)
    {
        $this->vacationName = $vacationName;
        $this->user = $user;
        $this->startDatetimeOfRoom = $startDatetimeOfRoom;
        $this->endDatetimeOfRoom = $endDatetimeOfRoom;
        $this->createdHouseName = $createdHouseName;
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
            ->subject('Vacation Room Removed from ' . $this->createdHouseName . ' Calendar')
            ->view('emails.delete_vacation_room_notification', [
                'vacationName' => $this->vacationName,
                'user' => $this->user,
                'createdHouseName' => $this->createdHouseName,
                'startDate' => $this->startDatetimeOfRoom,
                'endDate' => $this->endDatetimeOfRoom,
            ]);

//            ->subject('Deleted'. ' ' . $this->isModel)
//            ->greeting($this->isAction)
//
//            ->line(new HtmlString('A Vacation <strong>' .  $this->name .'</strong>'. ' has been Deleted against ' . '<strong>'. $this->createdHouseName .' '.'House'.'</strong>'))
//
//            ->line(new HtmlString('This change was made by <strong>' . $this->user->first_name. ' ' . $this->user->last_name . '('. $this->user->email . ')' .  '</strong>'))
//
//            ->line(new HtmlString('The duration of the vacation is from <strong>' . $this->startDatetimeOfVacation.'</strong>'. ' to ' . '<strong>'. $this->endDatetimeOfVacation .'</strong>'));

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
            'vacationName' => $this->vacationName,
            'user' => $this->user,
            'createdHouseName' => $this->createdHouseName,
            'startDate' => $this->startDatetimeOfRoom,
            'endDate' => $this->endDatetimeOfRoom,
        ];
    }
}
