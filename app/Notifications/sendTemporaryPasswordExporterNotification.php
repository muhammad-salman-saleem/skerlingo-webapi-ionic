<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class sendTemporaryPasswordExporterNotification extends Notification
{
    use Queueable;

    private $password = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
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

        $link = url("app/");
        return (new MailMessage)
            ->subject('Welcome to skerlingo')
            ->greeting("Dear " . $notifiable->prenom . ',')
            ->line("Your request to join skerlingo.ma is approved.")
            ->line("You can now start adding your products & services to skerlingo catalog. You can also access the request for quotations published on the website to propose quotations to the international importers.")
            ->line("Your password is : <b>" . $this->password . '</b>')
            ->action('Connect to skerlingo.ma', $link);
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
