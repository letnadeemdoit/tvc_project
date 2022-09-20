<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ContactUsMailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $firstName;
    public $lastName;
    public $subject;
    public $email;
    public $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($firstName,$lastName,$subject,$email,$comment)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->subject = $subject;
        $this->email = $email;
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->greeting('Contact Us!')
                    ->line(new HtmlString(
                       'Subject : <strong>' . $this->subject . '</strong>'
                     ))
                    ->line(new HtmlString(
                       'Name : <strong>' . $this->firstName . ' ' . $this->lastName . '</strong>'
                     ))
                    ->line(new HtmlString(
                        'Email : <strong>'. $this->email . ' </strong>'
                    ))
                    ->line(new HtmlString(
                        'Comment : <strong>'. $this->comment . ' </strong>'
                     ));
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
            'Name' => $this->firstName,
            'Subject' => $this->subject,
            'Comment' => $this->comment,
        ];
    }
}
