<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class DeleteVacationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $name;
    public $user;
    public $vacOwner;
    public $ccList;
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
    public function __construct($name,$user,$vac_owner,$ccList,$startDatetimeOfVacation,$endDatetimeOfVacation,$isAction,$createdHouseName,$isModel)
    {
        $this->name = $name;
        $this->user = $user;
        $this->vacOwner = $vac_owner;
        $this->ccList = $ccList;
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
        // When using Notification::route('mail', ...)
        if ($notifiable instanceof AnonymousNotifiable) {
            return ['mail'];
        }
        // For actual User models, send database notifications
        return ['database'];
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
            ->subject('Vacation removed from ' . $this->createdHouseName . ' Calendar')
//            ->cc($this->ccList) // Add CC recipients
            ->view('emails.delete_vacation_notification', [
                'name' => $this->name,
                'user' => $this->user,
                'vacOwner' => $this->vacOwner,
                'createdHouseName' => $this->createdHouseName,
                'startDate' => $this->startDatetimeOfVacation,
                'endDate' => $this->endDatetimeOfVacation,
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
            'content' => 'Vacation deleted from',
            'house_name' => $this->createdHouseName,
            'start_date' => $this->startDatetimeOfVacation,
            'end_date' => $this->endDatetimeOfVacation,
        ];
    }
}
