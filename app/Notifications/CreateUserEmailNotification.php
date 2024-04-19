<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CreateUserEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $createUser;
    public $sendPasswordToMail;
    public $houseName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($createUser,$sendPasswordToMail,$houseName)
    {
        $this->createUser =$createUser;
        $this->sendPasswordToMail =$sendPasswordToMail;
        $this->houseName =$houseName;
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
            ->subject('User ' .$this->createUser['first_name'] .' '. $this->createUser['last_name'] )
            ->greeting($this->createUser['first_name'] .' '. $this->createUser['last_name'])
            ->line(new HtmlString('<strong>' .'User Name:'.'</strong>' .' ' . $this->createUser['user_name']))
            ->line(new HtmlString('<strong>' .'House Name:'.'</strong>' .' ' . $this->houseName))
            ->line(new HtmlString('<strong>' .'User Email:'.'</strong>' .' ' . $this->createUser['email']))
            ->line(new HtmlString('<strong>' .'User Role:'.'</strong>' .' ' . $this->createUser['role']))
            ->line(new HtmlString('<strong>' .'Password:'.'</strong>' .' ' . $this->sendPasswordToMail));
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
            //
        ];
    }
}
