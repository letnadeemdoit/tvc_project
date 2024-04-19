<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class DeleteVacationNotification extends Notification
{
    use Queueable;

    public $name;
    public $user;
    public $startDatetimeOfVacation;
    public $endDatetimeOfVacation;
    public $isAction;
    public $createdHouseName;
    public $isModel;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name,$user,$startDatetimeOfVacation,$endDatetimeOfVacation,$isAction,$createdHouseName,$isModel)
    {
        $this->name = $name;
        $this->user = $user;
        $this->startDatetimeOfVacation = $startDatetimeOfVacation;
        $this->endDatetimeOfVacation = $endDatetimeOfVacation;
        $this->isAction = $isAction;
        $this->createdHouseName = $createdHouseName;
        $this->isModel = $isModel;
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

            ->subject('Deleted'. ' ' . $this->isModel)
            ->greeting($this->isAction)

            ->line(new HtmlString('A Vacation <strong>' .  $this->name .'</strong>'. ' has been Deleted against ' . '<strong>'. $this->createdHouseName .' '.'House'.'</strong>'))

            ->line(new HtmlString('This change was made by <strong>' . $this->user->first_name. ' ' . $this->user->last_name . '('. $this->user->email . ')' .  '</strong>'))

            ->line(new HtmlString('The duration of the vacation is from <strong>' . $this->startDatetimeOfVacation.'</strong>'. ' to ' . '<strong>'. $this->endDatetimeOfVacation .'</strong>'));

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
            'isAction' => $this->isAction,
            'isModal' => $this->isModel,
            'house_name' => $this->createdHouseName,
        ];
    }
}
