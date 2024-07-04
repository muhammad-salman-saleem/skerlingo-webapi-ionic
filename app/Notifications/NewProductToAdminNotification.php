<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewProductToAdminNotification extends Notification
{
    use Queueable;

    private $entreprise = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($entreprise)
    {
        $this->entreprise = $entreprise;
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

        $link = url("app/produits");
        return (new MailMessage)
            ->subject('skerlingo | New Pdt / Service')
            ->greeting("Dear " . $notifiable->prenom . ',')
            ->line("You have a new product / service adding request of the Moroccan Exporter : <b>" . $this->entreprise->label . '</b> to approve.')
            ->line("You can manage the adding request on the following link : ")
            ->action('Go to skerlingo', $link);
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
